$(function() {
    
    $('#menuToggle').click(function(){
        if(oViewModel.fullComments) {
            hideComments();
        } else {
            showComments();
        }
    });

    $('.comment-flag').click(function(){
        var iId = $(this).data('flag');
        var sState = $(this).data('state');
        console.log(sState);
        if(sState === "unreported") {
            // On contacte le serveur pour upload le flag
            // Si la requete passe alors on appeller changeFlag
            // on met à jour data.state vu que la fonction changeflag est à sens unique
            changeFlag(this);
            $(this).data('state', 'reported');
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
    fullComments:false
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
    $('#commentsContainer').css('height', '0%');
    $('#menuToggle').css('transform', 'rotate(180deg)');
    oViewModel.fullComments = true;
}
function hideComments () {
    $('#commentsContainer').css('height', 'auto');
    $('#menuToggle').css('transform', 'rotate(0deg)');
    oViewModel.fullComments = false;
}
function changeFlag (DOMObject) {
    $(DOMObject).html('<i class="fas fa-flag"></i>');
    $(DOMObject).css('color', 'orange');
}