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
    initInfoBox();
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
    $("#submitButton").click(function(){
        var oData = {
            username:$("#usernameInput").val(),
            password:$("#passwordInput").val()
        };
        $.ajax({
            type: "POST",  
            url: "../unlock.php",
            data: oData, 
            success: function(sResponse){  
                var oResponse = JSON.parse(sResponse);
                console.log(oResponse);
                if(oResponse.code === 200) {
                    navTo("../dashboard");
                } else {
                    displayError(oResponse);
                    // renderInfoBox(oResponse);
                }
            },
            error: function(err) { 
                console.log("Erreur : " + err);
            }       
        });
        // navTo('./auth.css');

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
    infoBoxVisible:false
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
function initInfoBox () {
    if(!oViewModel._infoBox) {
        oViewModel._infoBox = $('<div id="info" class="alert alert-danger" role="alert"></div>');
    }
}
function navTo(sUrl) {
    window.location.href = sUrl;
}
function displayError(oData) {
    if(oViewModel._infoBox && oViewModel.infoBoxVisible) {
        hideInfoBox().then(function(){
            var oInfoBox = oViewModel._infoBox;
            $("#info").html(oData.details);
            $("#info").fadeIn();
        });
    } else {
        renderInfoBox(oData);
    }
}
function renderInfoBox (oData) {
    console.log("triggered");
    var oInfoBox = oViewModel._infoBox;
    $(oInfoBox).html(oData.details);
    $("#authFormContainer").append($(oInfoBox));
    oViewModel.infoBoxVisible = true;
}
function hideInfoBox () {
    return new Promise(function(fnResolve, fnReject){
        $("#info").fadeOut();
        setTimeout(fnResolve, 500);
    });
}
 //<div id="info" class="alert alert-danger" role="alert"></div>