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
    var ThankYouWriteChapterModal = new Custombox.modal({
        content: {
        effect: 'slip',
        target: '#thankYouWriteChapterModal',
        id: 'thankYouWriteChapter'
        }
    });
    // Inside write modal
    var oWriteChapterModalHeader = $('#writeChapterModalHeader');
    var oWriteChapterModalTitleInput = $('#writeChapterModalTitleInput');
    var oWriteChapterModalContentInput = $('#writeChapterModalContentInput');
    var oWriteChapterSubmitBtn = $('#writeChapterSubmitBtn');
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
        tinymce.remove('#writeChapterModalContentInput');
        Custombox.modal.close('writeChapter');
         
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
            Custombox.modal.close('writeChapter');
            console.log("Objet retournée > ");
            console.log(oResponse);
        }).catch(function(err) {
            console.log("Erreur lors du post du chapitre.");
            console.log(err);
        });
    });

    
})
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
    state : {
        isWriteChapterEditorEnabled:false
    }
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
    });
}
/**
 * Fonction permettant de rendre dans le DOM
 * les lignes de chapitres en se basant sur les données 
 * contenues dans oChapterViewModel.
 * @return {void}
 */
function renderChapters () {
    // Reset du body
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
}
/**
 * Fonction permettant de créer une ligne s'il n 'y a pas de chapitre
 * @return {void}
 */
function createNoChapterText () {
    return $('<tr class="dataTableRowClassic"><td><strong class="pastel-red">Aucun chapitre avec le titre donné</strong></td></tr>');
}
function createChapterRow (oChapter) {
    return $('<tr class="dataTableRow" data-chapter-id=' + oChapter.id + '><td>' + oChapter.title + '</td><td style="display:flex; align-items:center;"><div class="action-btn edit-btn"><i class="far fa-edit"></i></div><div class="action-btn delete-btn"><i class="far fa-trash-alt"></i></div></td></tr>');
}
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
function init () {
    refreshChapters('');
}
function RemoveTinymce()
   {
      if( tinymce.editors.length > 0 )
      {
         for( i = 0; i < tinymce.editors.length; i++ )
         {
            tinyMCE.editors[ i ].remove();
         }
      }
   }