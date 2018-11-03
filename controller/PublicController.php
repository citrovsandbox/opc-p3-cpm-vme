<?php
require_once '../model/ChapitreManager.php';
require_once '../model/CommentManager.php';

class PublicController {
    /**
     * Fonction permettant de générer la page /about.php
     * @public
     * @return {void}
     */
    public function aboutPage () {
        require_once '../view/about/index.html';
    }
    /**
     * Fonction permettant de générer la page /chapitre.php
     * @public
     * @param {Integer} $id L'id du chapitre nécessaire à générer la page du chapitre
     * @return {void}
     */
    public function chapterPage() {
        $ChapitreManager = new ChapitreManager;
        $CommentManager = new CommentManager;
        if(isset($_GET['id']) && $oChapter = $ChapitreManager->get($_GET['id'])) {
            $aComments = $CommentManager->get($_GET['id']);
            require_once '../view/chapitre/index.php';
        } else {
            require_once '../errors/404.php';
        }
    }
    /**
     * Fonction permettant de générer /contact.php
     * @public
     * @return {void}
     */
    public function contactPage () {
        require_once '../view/contact/index.html';
    }
    /**
     * Fonction permettant de générer /livre.php
     * @public
     * @return {void}
     */
    public function chaptersPage () {
        $ChapitreManager = new ChapitreManager;
        $aChapitres = $ChapitreManager->getAll();
        require_once '../view/livre/index.php';
    }
    
}