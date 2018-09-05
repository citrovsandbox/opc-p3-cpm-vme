$(function() {
    
    $("#menuToggle").click(function(){
        if(oViewModel.fullComments) {
            hideComments();
        } else {
            showComments();
        }
    });

    $("#submitButton").click(function() {
        var sAuthor = $("#usernameInput").val();
        var sContent = $("#commentTextarea").val();
        
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