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
})
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
    var oData = {zone:'commentaire', action:'get'};

    Hermes.get('../../api', oData).then(function(oResponse) {
        oCommentViewModel.comments = oResponse.data;
        console.log(oResponse);
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
    var oTBody = $('#commentsDataTableBody');
    oTBody.html('');

    var aCommments = oCommentViewModel.comments;

    if(aCommments.length < 1) {
        oTBody.append(createNoCommentText());
    } else {
        for(var i = 0; i < aCommments.length; i++) {
            oTBody.append(createCommentRow(aCommments[i]));
        }
    }
    refreshActionBtnHandlers();
}
/**
 * Fonction permettant de créer une ligne s'il n 'y a pas de chapitre
 * @return {void}
 */
function createNoCommentText () {
    return $('<tr class="dataTableRowClassic"><td><strong class="pastel-red">Aucun commentaire</strong></td><td></td></tr>');
}
function createCommentRow (oComment) {
    return $('<tr class="dataTableRow" data-comment-id=' + oComment.id + '><td>' + oComment.author + '</td><td>' + oComment.datetime + '</td><td style="display:flex; align-items:center;"><div class="action-btn edit-btn"><i class="far fa-edit"></i></div><div class="action-btn delete-btn"><i class="far fa-trash-alt"></i></div></td></tr>');
}