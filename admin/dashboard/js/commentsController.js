$(function() {
    /**
     * ----------------------------------------
     * -
     * -
     * -
     * -         DOM Elements
     * -
     * -
     * -
     * -----------------------------------------
     */
    var oCommentSearchInput = $('#commentSearchInput');
    var oCommentSearchButton = $('#commentsSearchButton');
    var oCommentsModeSwitch = $('#commentsModeSwitch');
    var oRefreshManageCommentsTableBtn = $('#refreshManageCommentsTableBtn');
    var oRefreshCommentsIcon = $('#refreshCommentsIcon');
    
    /**
     * ----------------------------------------
     * -
     * -
     * -
     * -         onInit METHODS
     * -
     * -
     * -
     * -----------------------------------------
     */
    refreshComments();
    /**
     * ----------------------------------------
     * -
     * -
     * -
     * -         H A N D L E R S
     * -
     * -
     * -
     * -----------------------------------------
     */
    oRefreshManageCommentsTableBtn.click(function() {
        refreshComments();
    });

    function refreshActionBtnHandlersForComments () {
        $('.comment-watch-btn').click(function () {
            var iContext = $(this).parent().parent().data('commentid');
            oCommentViewModel.state.currentCommentId = iContext;
            var oComment = getCommentFromContext(iContext);
            var ShowModal = $('#showCommentModal');
            ShowModal.modal('toggle');
            // On met à jour l'intérieur de la popup
            $('#contextCommentDate').html(beautifyDate(oComment.datetime));
            $('#contextCommentAuthor').html(oComment.author);
            $('#contextCommentContent').html(oComment.content);
            if(oComment.reported) {
                $('#onValidateComment').css('display', 'block');
            } else {
                $('#onValidateComment').css('display', 'none');
            }
            refreshWatchCommentBtnHandler();
        });
        $('.comment-edit-btn').click(() => {
            alert("Handler d'édition");
        });
        $('.comment-delete-btn').click(function () {
            var iContext = $(this).parent().parent().data('commentid');
            oCommentViewModel.state.currentCommentId = iContext;
            var DeleteModal = $('#deleteCommentModal');
            DeleteModal.modal('toggle');
            refreshDeleteCommentBtnHandler();
        });
        $('.comment-approve-btn').click(() => {
            alert("Handler d'unflag");
        });
    }
    oCommentsModeSwitch.click((e) => {
        setMode();
        renderComments();
    });
    /**
     * --------------------------------------------
     * -
     * -
     * -              M O D E L
     * -       {Object} oCommentViewModel
     * -   Un tout petit Modèle pour la zone commentaire
     * -
     * -
     * ---------------------------------------------
     */
    var oCommentViewModel = {
        state : {
            mode : 'all', // supported : all OR reported
            currentCommentId:null
        },
        comments:[],
        reportedComments:[]
    };
    /**
     * ---------------------------------------------
     * -
     * -
     * -
     * -         F U N C T I O N S
     * -
     * -
     * ---------------------------------------------
     */
    /**
     * 
     * @param {Object} oData La valeur du filtre sur le chapitre {title:''}
     * 
     */
    function refreshComments () {
        oRefreshCommentsIcon.addClass('rotating');
        var oData = {zone:'commentaire', action:'get'};

        Hermes.get('../../api', oData).then(function(oResponse) {
            oCommentViewModel.comments = oResponse.data;
            oCommentViewModel.reportedComments = fetchReportedComments();
            console.log(oResponse);
            oRefreshCommentsIcon.removeClass('rotating');
            renderComments();
        });
    }
    /**
     * Fonction permettant de rendre dans le DOM
     * les lignes de chapitres en se basant sur les données 
     * contenues dans oChapterViewModel.
     * @return {void}
     */
    function renderComments () {
        var MODE = oCommentViewModel.state.mode;
        var oTBody = $('#commentsDataTableBody');
        oTBody.html('');

        if(MODE === 'all') {
            var aCommments = oCommentViewModel.comments;

            if(aCommments.length < 1) {
                oTBody.append(createNoCommentText());
            } else {
                for(var i = 0; i < aCommments.length; i++) {
                    oTBody.append(createCommentRow(aCommments[i]));
                }
            }
        } else {
            var aCommments = oCommentViewModel.reportedComments;
            if(aCommments.length < 1) {
                oTBody.append(createNoCommentText());
            } else {
                for(var i = 0; i < aCommments.length; i++) {
                    oTBody.append(createCommentRow(aCommments[i]));
                }
            }
        }
        refreshActionBtnHandlersForComments();
    }
    /**
     * Fonction permettant de créer une ligne s'il n 'y a pas de chapitre
     * @return {void}
     */
    function createNoCommentText () {
        return $('<tr class="dataTableRowClassic"><td></td><td><strong class="pastel-red">Aucun commentaire</strong></td><td></td></tr>');
    }
    function createCommentRow (oComment) {
        var bIsReported = oComment.reported;
        if(bIsReported) {
            return $('<tr class="dataTableRow pastel-orange-bg" data-commentid=' + oComment.id + '><td>' + oComment.author + '</td><td>' + beautifyDate(oComment.datetime) + '</td><td style="display:flex; align-items:center;"><div class="action-btn comment-watch-btn" title="Voir le commentaire"><i class="fas fa-eye"></i></div><div class="action-btn comment-edit-btn"><i class="far fa-edit"></i></div><div class="action-btn comment-delete-btn" title="Supprimer ce commentaire"><i class="far fa-trash-alt"></i></div><div class="action-btn comment-approve-btn"><i class="fas fa-check"></i></div></td></tr>');
        } else {
            return $('<tr class="dataTableRow" data-commentid=' + oComment.id + '><td>' + oComment.author + '</td><td>' + beautifyDate(oComment.datetime) + '</td><td style="display:flex; align-items:center;"><div class="action-btn comment-watch-btn" title="Voir le commentaire"><i class="fas fa-eye"></i></div><div class="action-btn comment-edit-btn"><i class="far fa-edit"></i></div><div class="action-btn comment-delete-btn" title="Supprimer ce commentaire"><i class="far fa-trash-alt"></i></div><div class="action-btn comment-approve-btn"><i class="fas fa-check"></i></div></td></tr>');
        }
        
    }
    function setMode () {
        var oCommentSubtitle = $('#CommentSubtitle');
        var sCurrentMode = oCommentViewModel.state.mode;
        if(sCurrentMode === 'all') {
            oCommentSubtitle.html('<strong style="text-decoration:underline;">Commentaires reportés</strong>');
            oCommentSubtitle.removeClass('pastel-green').addClass('pastel-orange');
            oCommentViewModel.state.mode = 'reported';
        } else {
            oCommentSubtitle.html('Tous les commentaires');
            oCommentSubtitle.removeClass('pastel-orange').addClass('pastel-green');
            oCommentViewModel.state.mode = 'all';
        }
    }

    function fetchReportedComments () {
        var aAllComments = oCommentViewModel.comments;
        var aReportedComments = [];
        for(var i = 0; i < aAllComments.length ; i++) {
            if(aAllComments[i].reported) {
                aReportedComments.push(aAllComments[i]);
            }
        }
        return aReportedComments;
    }
    function refreshDeleteCommentBtnHandler () {
        $('#deleteCommentBtn').off();
        $('#deleteCommentBtn').click(function() {
            // alert("L'utilisateur a demandé une suppression");
            var DeleteModal = $('#deleteCommentModal');
            var iDeleteCommentId = oCommentViewModel.state.currentCommentId;
            var oData = {zone:'commentaire', action:'delete', commentId:iDeleteCommentId};
            Hermes.get('../../api', oData).then(function(oResponse) {
                displayInfo(oResponse.details);
                DeleteModal.modal('toggle');
                refreshComments();
            }).catch(function(err) {
                console.log(err);
                displayInfo('Erreur lors de la suppression du commentaire');
            });
        });
    }
    function getCommentFromContext (iContext) {
        var aComments = oCommentViewModel.comments;
        for(var i = 0; i < aComments.length ; i++) {
            if(aComments[i].id === iContext) {
                return aComments[i];
            }
        }
    }
    function refreshWatchCommentBtnHandler () {
        $('#onValidateComment').off();
        $('#onValidateComment').click(function() {
            var ShowModal = $('#showCommentModal');
            var iCurrentCommentId = oCommentViewModel.state.currentCommentId;
            var oData = {zone:'commentaire', action:'unflag', commentId:iCurrentCommentId};
            Hermes.get('../../api', oData).then(function(oResponse) {
                displayInfo(oResponse.details);
                ShowModal.modal('toggle');
                refreshComments();
            }).catch(function(err) {
                console.log(err);
                displayInfo('Erreur lors de la suppression du commentaire');
            });
        });

        $('#onDeleteComment').click(function() {
            var DeleteModal = $('#deleteCommentModal');
            var ShowModal = $('#showCommentModal');
            ShowModal.modal('toggle');
            DeleteModal.modal('toggle');
            refreshDeleteCommentBtnHandler();
        });
    }
    function beautifyDate (sDate) {
        return sDate.substring(8,10) + '/' + sDate.substring(5,7) + '/' + sDate.substring(0,4);
    }
    /**
     * Fonction permettant d'afficher un message d'information
     * @param {String} sDetails Le texte qui nous revient tout droit du serveur
     */
    function displayInfo (sDetails) {
        $('#infoRes').html(sDetails);
        $('#informationModal').modal('toggle');
    }
})
