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
    var SubmitForm = $('#formContainer');
    var UsernameInput = $('#usernameInput');
    var CommentTextarea = $('#commentTextarea');

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
    initCommentsHeight();
    renderCommentsFlag();
    getChapterId();
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
    $('#teleporter').click(function() {
        window.scroll({
            top: $('#headerContainer').height() + $('#banniereContainer').height(), 
            left: 0, 
            behavior: 'smooth' 
        });
    });
    SubmitForm.submit((e) => {
        e.preventDefault();
        var sUsername = UsernameInput.val();
        var sContent = CommentTextarea.val();
        var oOptions = {
            zone:'commentaire',
            action:'post',
            chapterId:oViewModel.chapterId,
            commentAuthor:sUsername,
            commentContent:sContent
        }
        if(sUsername === '' || sContent === '') {
            $('#informationModal').off('hidden.bs.modal');
            $('#infoRes').html("Merci de remplir tous les champs.");
            $('#informationModal').modal('toggle');
        } else {
            Hermes.get('../../api', oOptions).then(function(oResponse) {
                var code = oResponse.code;
                $('#informationModal').on('hidden.bs.modal', function () {
                    document.location.reload();
                });
                $('#infoRes').html(oResponse.details);
                $('#informationModal').modal('toggle');
            }).catch(function(err) {
                console.error(err);
            });
        }
    });

    $('#menuToggle').click(function(){
        if(oViewModel.fullComments) {
            hideComments();
        } else {
            showComments();
        }
    });

    $('.comment-flag').click(function(){
        var self = this;
        var iId = $(this).data('flag');
        var sState = $(this).data('state');
        console.log(sState);
        if(sState === "unreported") {
            showAttentionModal().then(function() {
                $('#reportBtn').off('click');
                $('#reportBtn').on('click', function() {
                    reportThatShit(iId).then(function(sDetails) {
                    // Si la requete passe alors on appeller changeFlag
                    // on met à jour data.state vu que la fonction changeflag est à sens unique
                    $('#informationModal').off('hidden.bs.modal');
                    $('#informationModal').on('hidden.bs.modal', function () {
                        changeFlag(self);
                        $(self).data('state', 'reported');
                    });
                    $('#infoRes').html(sDetails);
                    $('#informationModal').modal('toggle');

                    });
                })
            })
        }
    });
})
/**
 * --------------------------------------------
 * -
 * -
 * -              M O D E L
 * -       {Object} ViewModel
 * -   Un tout petit Modèle pour la vue
 * -
 * -
 * ---------------------------------------------
 */
var oViewModel = {
    commentsHeight:'0px',
    fullComments:false,
    chapterId:null
}
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
function showComments () {
    $('#commentsContainer').css('height', '0px');
    $('#menuToggle').css('transform', 'rotate(180deg)');
    oViewModel.fullComments = true;
}
function hideComments () {
    $('#commentsContainer').css('height', oViewModel.commentsHeight);
    $('#menuToggle').css('transform', 'rotate(0deg)');
    oViewModel.fullComments = false;
}
function changeFlag (DOMObject) {
    $(DOMObject).html('<i class="fas fa-flag"></i>');
    $(DOMObject).css('color', 'orange').css('cursor', 'default');
}
function renderCommentsFlag () {
    var aCommentsFlags = $('.comment-flag').toArray();
    aCommentsFlags.forEach((oCommentFlag) => {
        var sState = $(oCommentFlag).data('state');
        if(sState === 'reported') {
            changeFlag(oCommentFlag);
        }
    });
}
/**
 * @public
 * Petit hack permettant de conserver height:auto
 * mais d'avoir également l'animation fluide lorsque l'utilisateur
 * masque les commentaires
 * @returns {void}
 */
function initCommentsHeight () {
    oViewModel.commentsHeight = $("#commentsContainer").height() + 'px';
    $("#commentsContainer").css('height', oViewModel.commentsHeight);
}
function getChapterId () {
    var iChapterId = parseInt(window.location.href.split('id=')[1], 10);
    oViewModel.chapterId = iChapterId;
    console.log(oViewModel.chapterId);
}

function reportThatShit (iId) {
    return new Promise(function(fnResolve, fnReject) {
        $.ajax({
            type: "GET",  
            url: "../../api",
            data: {zone:'commentaire', action:'flag', commentId : iId}, 
            success: function(res){  
                fnResolve(JSON.parse(res).details);
            },
            error: function(err) { 
                fnReject("Erreur : " + err);
            }       
        });
    })
    
}

function showAttentionModal () {
    return new Promise(function(fnResolve, fnReject) {
        $('#attentionModal').modal('toggle');
        fnResolve();
    });
}