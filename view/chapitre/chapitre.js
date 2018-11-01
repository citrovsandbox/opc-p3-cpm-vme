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
    var SubmitForm = $('#formContainer');
    var UsernameInput = $('#usernameInput');
    var CommentTextarea = $('#commentTextarea');

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
    getChapterId();
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
    SubmitForm.submit((e) => {
        e.preventDefault();
        var sUsername = UsernameInput.val();
        var sContent = CommentTextarea.val();
        var oOptions = {
            zone:'commentaire',
            action:'post',
            chapterId:oViewModel.chapterId,
            commentAuthor:sUsername,
            commentContent:sContent
        }
        if(sUsername === '' || sContent === '') {
            alert('Merci de renseigner tous les champs avant de poster un commentaire.');
        } else {
            Hermes.get('../../api', oOptions).then(function(oResponse) {
                var code = oResponse.code;
                alert(oResponse.details);
                if(code === 200) {
                    document.location.reload();
                }
            }).catch(function(err) {
                console.error(err);
            });
        }

    });

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
                type: "GET",  
                url: "../../api",
                data: {zone:'commentaire', action:'flag', commentId : iId}, 
                success: function(res){  
                    alert(JSON.parse(res).details);
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
    fullComments:false,
    chapterId:null
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
function getChapterId () {
    var iChapterId = parseInt(window.location.href.split('id=')[1], 10);
    oViewModel.chapterId = iChapterId;
    console.log(oViewModel.chapterId);
}