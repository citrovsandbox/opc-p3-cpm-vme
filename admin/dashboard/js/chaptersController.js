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
     * -         onInit METHODS
     * -
     * -
     * -
     * -----------------------------------------
     */
    refreshChapters('');
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
        console.log("triggered");
        console.log(WriteChapterModal);
        WriteChapterModal.open();
    });

    oWriteChapterModalHeader.click(function() {
        Custombox.modal.close('writeChapter');
    });

    oWriteChapterSubmitBtn.click(function() {
        var sTitle = oWriteChapterModalTitleInput.val();
        var sContent = oWriteChapterModalContentInput.val();

        var oData = {title:sTitle, content:sContent};
        console.log(oData);

        $.ajax({
            url : '../../api/postChapter.php',
            type : 'POST',
            data: oData,
            success : function(res){ // success est toujours en place, bien sûr !
                var oResponse = JSON.parse(res);
                console.log("Succès AXIOS postChapter");
                console.log(res);
                alert(oResponse.details);
                refreshChapters(oChapterViewModel.filter);
                Custombox.modal.close('writeChapter');
            },
     
            error : function(err){
                console.log("Erreur AXIOS postChapter");
                console.log(err);
            }
     
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
    chapters:[]
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
    console.log(sTitle);
    var sUrl = '../../api/getChapters.php?title=' + sTitle;
    console.log("L'url");
    console.log(sUrl);  
    axios.get(sUrl).then(function(res) {
        console.log(res);
        oChapterViewModel.chapters = res.data;
        renderChapters();
    }).catch(function(err) {
        console.log('Erreur lors de la recherche des chapitres.');
        console.log(err);
    });
}
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
function createNoChapterText () {
    return $('<tr class="dataTableRowClassic"><td><strong class="pastel-red">Aucun chapitre avec le titre donné</strong></td></tr>');
}
function createChapterRow (oChapter) {
    return $('<tr class="dataTableRow" data-chapter-id=' + oChapter.ch_id + '><td>' + oChapter.ch_title + '</td></tr>');
}