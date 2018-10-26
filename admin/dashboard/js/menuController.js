

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
        // Buttons
        var oChaptersBtn = $('#toChaptersButton');
        var oCommentsBtn = $('#toCommentsButton');
        var oLogoutBtn = $('#toLogoutButton');

        // Views
        var oChaptersView = $('#manageChaptersContainer');
        var oCommentsView = $('#manageCommentsContainer');
        var oWelcomeView = $('#welcomeContainer');
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
    displayTheRightView();
    Compass.run();
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
    oChaptersBtn.click(function() {
        oViewModel.mode = 'chapters';
        displayTheRightView();
    });

    oCommentsBtn.click(function() {
        oViewModel.mode = 'comments';
        displayTheRightView();
    });

    oLogoutBtn.click(function() {
        navTo('../lock.php');
    });
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
    function displayTheRightView() {
        var sCurrentMode = oViewModel.mode;
        console.log(sCurrentMode);
        switch(sCurrentMode) {
            case 'welcome':
            oWelcomeView.css('display', 'block');
            oChaptersView.css('display', 'none');
            oCommentsView.css('display', 'none');
            break;
            case 'chapters':
            oChaptersView.css('display', 'block');
            oWelcomeView.css('display', 'none');
            oCommentsView.css('display', 'none');
            break;
            case 'comments':
            oCommentsView.css('display', 'block');
            oWelcomeView.css('display', 'none');
            oChaptersView.css('display', 'none');
            break;
        }
    }
    
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
var oMenuModel = {

};


