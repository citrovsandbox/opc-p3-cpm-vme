<?php
require_once '../model/Chapitre.php';
require_once '../model/Comment.php';

class PublicController {
    /**
     * Fonction permettant de générer la page /accueil.php
     * @public
     * @return {void}
     */
    public function aboutPage () {
        $Chapitre = new Chapitre;
        $aChapters = $Chapitre->get();
        require_once '../view/about/index.html';
    }
    /**
     * Fonction permettant de générer la page /chapitre.php
     * @public
     * @return {void}
     */
    public function chapitrePage() {

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
    public function livrePage () {
        $CHAPITRE = new Chapitre;
        $COMMENT = new Comment;
        $aChapters = [];
        $aTmpChapters = $CHAPITRE->get();
        foreach ($aTmpChapters as $aChapter){
            $aChapter['nb_comments'] = $COMMENT->forChapter($aChapter['ch_id']);
            $oChapter = $aChapter;
            array_push($aChapters, $aChapter);
        }
        require_once '../view/livre/index.php';
    }
    
}