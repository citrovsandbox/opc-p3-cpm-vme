

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
    // displayTheRightView();
    Compass.start('detailsContentContainer', [
        {
            name:'Gestion des commentaires',
            componentId : 'manageCommentsContainer',
            pattern:'/comments'
        },
        {
            name:'Accueil',
            componentId : 'welcomeContainer',
            pattern:'/welcome'
        },
        {
            name:'Gestion des chapitres',
            componentId : 'manageChaptersContainer',
            pattern:'/chapters'
        }
    ]);
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
        Compass.navigate('/chapters');
    });

    oCommentsBtn.click(function() {
        Compass.navigate('/comments');
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


