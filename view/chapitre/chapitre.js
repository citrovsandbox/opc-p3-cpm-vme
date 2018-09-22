$(function() {
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
            $.ajax({
                type: "POST",  
                url: "../../api/flagComment.php",
                data: {commentId : iId}, 
                success: function(res){  
                    alert("Succès");
                },
                error: function(err) { 
                    console.log("Erreur : " + err);
                }       
            });
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
    commentsHeight:'0px',
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