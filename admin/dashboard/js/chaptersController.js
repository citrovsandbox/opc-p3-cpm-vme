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
    var oChapterSearchInput = $('#chapterSearchInput');
    var oChapterWriteNew = $('#chaptersSearchButton');
    var WriteChapterModal = new Custombox.modal({
        content: {
        effect: 'slip',
        target: '#writeChapterModal',
        id: 'writeChapter'
        }
    });
    var EditChapterModal = new Custombox.modal({
        content: {
        effect: 'slip',
        target: '#editChapterModal',
        id: 'editChapter'
        }
    });
    // Inside write modal
    var oWriteChapterModalHeader = $('#writeChapterModalHeader');
    var oWriteChapterModalTitleInput = $('#writeChapterModalTitleInput');
    var oWriteChapterModalContentInput = $('#writeChapterModalContentInput');
    var oWriteChapterSubmitBtn = $('#writeChapterSubmitBtn');

    // Inside Edit modal
    var oEditChapterModalHeader = $('#editChapterModalHeader');
    var oEditChapterModalTitleInput = $('#editChapterModalTitleInput');
    var oEditChapterModalContentInput = $('#editChapterModalContentInput');
    var oEditChapterSubmitBtn = $('#editChapterSubmitBtn');
    // Inside delete modal
    var oDeleteChapterBtn = $('#deleteChapterBtn');
    // Inside table
    var oDeleteChapterBtn = $('.delete-btn');
    /**
     * ----------------------------------------
     * -
     * -
     * -
     * -         Init METHODS
     * -
     * -
     * -
     * -----------------------------------------
     */
    init();
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
    refreshActionBtnHandlers();

    oChapterSearchInput.keyup(function(oEvent) { 
        var sVal = $(this).val();
        var sTitle = sVal;
        oChapterViewModel.filter = sTitle;
        refreshChapters(sTitle);
    });

    oChapterWriteNew.click(function() {
        WriteChapterModal.open();
        // Permet de fixer le probleme du tinymce, c'est horrible mais ça marche va savoir...
        setTimeout(() => {
            initWriteChapterTextArea();
        }, 1);
        
    });

    oWriteChapterModalHeader.click(function() {
        closeWriteChapter();
    });

    oWriteChapterSubmitBtn.click(function() {
        var sTitle = oWriteChapterModalTitleInput.val();
        var sContent = tinyMCE.activeEditor.getContent();
        // var sSerialized = tinymce.util.JSON.serialize(sContent);
        var oData = {zone:'chapitre', action:'post', title:sTitle, content:sContent};
        console.log(oData);
        Hermes.get('../../api', oData).then(function(oResponse) {
            alert(oResponse.details);
            refreshChapters(oChapterViewModel.filter);
            closeWriteChapter();
            console.log("Objet retournée > ");
            console.log(oResponse);
        }).catch(function(err) {
            console.log("Erreur lors du post du chapitre.");
            console.log(err);
        });
    });

    oDeleteChapterBtn.click(function() {
        alert("triggered");
    });

    oEditChapterModalHeader.click(function() {
        closeEditChapter();
    });

    oEditChapterSubmitBtn.click(function() {
        var chapterId = oChapterViewModel.toEditSelection.id;
        var sTitle = oEditChapterModalTitleInput.val();
        var sContent = tinyMCE.activeEditor.getContent();
        var oData = {zone:'chapitre', action:'update', chapterId: chapterId, title:sTitle, content:sContent};
        console.log(oData);
        Hermes.get('../../api', oData).then(function(oResponse) {
            alert(oResponse.details);
            refreshChapters(oChapterViewModel.filter);
            closeEditChapter();
            console.log("Objet retournée > ");
            console.log(oResponse);
        }).catch(function(err) {
            console.log("Erreur lors du post du chapitre.");
            console.log(err);
        });
    });


    /**
     * --------------------------------------------
     * -
     * -
     * -              M O D E L
     * -       {Object} oChapterViewModel
     * -   Un tout petit Modèle pour la zone chapitre
     * -
     * -
     * ---------------------------------------------
     */
    var oChapterViewModel = {
        filter:'',
        chapters:[],
        toDeleteSelection:{},
        toEditSelection:{}
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
    function refreshChapters (sTitle) {
        var oData = {zone:'chapitre', action:'search', searchVal:sTitle};

        Hermes.get('../../api', oData).then(function(oResponse) {
            oChapterViewModel.chapters = oResponse.data;
            renderChapters();
        }).catch(function(err) {
            console.log('Erreur lors de la recherche des chapitres.');
            console.log(err);
            fnReject(err);
        });
    }
    /**
     * Fonction permettant de rendre dans le DOM
     * les lignes de chapitres en se basant sur les données 
     * contenues dans oChapterViewModel.
     * @return {void}
     */
    function renderChapters () {
        var oTBody = $('#chaptersDataTableBody');
        oTBody.html('');

        var aChapters = oChapterViewModel.chapters;
        console.log(aChapters);

        if(aChapters.length < 1) {
            oTBody.append(createNoChapterText());
        } else {
            for(var i = 0; i < aChapters.length; i++) {
                oTBody.append(createChapterRow(aChapters[i]));
            }
        }
        refreshActionBtnHandlers();
    }
    /**
     * Fonction permettant de créer une ligne s'il n 'y a pas de chapitre
     * @return {void}
     */
    function createNoChapterText () {
        return $('<tr class="dataTableRowClassic"><td><strong class="pastel-red">Aucun chapitre</strong></td></tr>');
    }
    function createChapterRow (oChapter) {
        return $('<tr class="dataTableRow" data-chapter-id=' + oChapter.id + '><td>' + oChapter.title + '</td><td style="display:flex; align-items:center;"><div class="action-btn edit-btn"><i class="far fa-edit"></i></div><div class="action-btn delete-btn"><i class="far fa-trash-alt"></i></div></td></tr>');
    }
    /**
     * Fonction permettant d'initialiser la popup d'écriture de chapitre
     */
    function initWriteChapterTextArea () {
        
        tinyMCE.init({
            selector: '#writeChapterModalContentInput',
            height: 300,
            menubar: true,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor textcolor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table contextmenu paste code help wordcount'
            ],
            toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tinymce.com/css/codepen.min.css']
        });
    }
    /**
     * Fonction permettant d'initialiser la popup d'édition de chapitre
     */
    function initEditChapterTextArea () {
        
        tinyMCE.init({
            selector: '#editChapterModalContentInput',
            height: 300,
            menubar: true,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor textcolor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table contextmenu paste code help wordcount'
            ],
            toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tinymce.com/css/codepen.min.css']
        });
    }
    /**
     * Hook
     * Fonction d'initialisation
     * @return {void}
     */
    function init () {
        refreshChapters('');
    }
    /**
     * Fonction permettant de réinstantier les handlers des boutons d'action
     * Le DOM étant rechargé à chaque keydown
     * @return {void}
     */
    function refreshActionBtnHandlers () {
        $('.delete-btn').click(function() {
            var DeleteModal = $('#deleteModal');
            var WillBeDeletedTitle = $('#willBeDeletedTitle');
            var iContext = $(this).parent().parent().data('chapter-id');
            oChapterViewModel.toDeleteSelection = getChapterFromContext(iContext);
            var sTitle = oChapterViewModel.toDeleteSelection.title;
            WillBeDeletedTitle.html(sTitle);
            DeleteModal.modal('toggle');
            refreshDeleteBtnHandler();
        });

        $('.edit-btn').click(function() {
            var context = $(this).parent().parent().data('chapter-id');
            oChapterViewModel.toEditSelection = getChapterFromContext(context);
            var oChapter = oChapterViewModel.toEditSelection;
            oEditChapterModalTitleInput.val(oChapter.title);
            EditChapterModal.open();
            setTimeout(() => {
                initEditChapterTextArea();
                setTimeout(()=> {
                    tinyMCE.activeEditor.setContent(oChapter.content);
                }, 1000);
            }, 1);
        });
    }
    /**
     * Fonction permettant de réinstantier le handler du boutons supprimer
     * La dialog faisant bug le handler
     * @return {void}
     */
    function refreshDeleteBtnHandler () {
        $('#deleteChapterBtn').click(function() {
            var DeleteModal = $('#deleteModal');
            var sCurrentFilter = oChapterViewModel.filter;
            var sDeleteChapterId = oChapterViewModel.toDeleteSelection.id;
            var oData = {zone:'chapitre', action:'delete', chapterId:sDeleteChapterId};
            Hermes.get('../../api', oData).then(function() {
                alert("Chapitre supprimé !");
                DeleteModal.modal('toggle');
                refreshChapters(sCurrentFilter);
            }).catch(function(err) {
                console.log(err);
                alert('Erreur lors de la suppression');
            });
            
        });
    }
    /**
     * Permet de récupérer le chapitre lié au contexte
     * sans requêter à nouveau le serveur puisque nous avons déjà 
     * les chapitres en cache
     * @param {Context} context Le contexte (ici, id de notre chapitre)
     * @return {Object} L'objet de notre chapitre
     */
    function getChapterFromContext (context) {
        var oModel = oChapterViewModel;
        var aChapters = oModel.chapters;

        for(var i = 0; i < aChapters.length; i++) {
            if(aChapters[i].id === context) {
                return aChapters[i];
            }
        }
    }
    /**
     * Fonction permettant de fermer proprement la popup d'edition
     * d'un chapitre
     */
    function closeEditChapter () {
        tinymce.remove('#editChapterModalContentInput');
        Custombox.modal.close('editChapter');
    }
    function closeWriteChapter () {
        tinymce.remove('#writeChapterModalContentInput');
        Custombox.modal.close('writeChapter');
    }





})
