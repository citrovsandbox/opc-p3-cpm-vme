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
    var oChapterSearchButton = $('#chaptersSearchButton');
    
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
        refreshChapters(sTitle);
    });

    oChapterSearchButton.click(function() {

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