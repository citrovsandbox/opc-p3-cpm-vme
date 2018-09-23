<?php

require_once '../model/class/Chapitre.php';

class ChapitreManager {
    /**
     * A chaque requete le ChapitreManager va générer des objets chapitre
     */
    public function getAll () {
        $bdd = $this->_dbConnect();
        $req = $bdd->prepare("SELECT * FROM chapitres ORDER BY ch_id DESC");
        $req->execute();
        $aChapitres = [];
        while($oChapter = $req->fetch()) {
            // $nbComments = $this->_getNbOfComments($oChapter['ch_id']);
            $oNewChapter = $this->_constructChapitre($oChapter['ch_id'], $oChapter['ch_title'], $oChapter['ch_content'], $oChapter['ch_date']);
            array_push($aChapitres, $oNewChapter);
        }
        return $aChapitres;
    }
    public function get ($id) {
        $bdd = $this->_dbConnect();
        $req = $bdd->prepare("SELECT * FROM chapitres WHERE ch_id=:id");
        $req->bindValue(':id', $id);
        $req->execute();
        $oChapter = $req->fetch();
        $oNewChapter = $this->_constructChapitre($oChapter['ch_id'], $oChapter['ch_title'], $oChapter['ch_content'], $oChapter['ch_date']);
        return $oNewChapter;
    }
    /**
     * Fonction permettant de construire un objet Chapitre
     * @private
     * @return {Object} Le chapitre créé
     */
    private function _constructChapitre ($id, $title, $content, $date) {
        $oChapitre = new Chapitre;

        $oChapitre->setId($id);
        $oChapitre->setTitle($title);
        $oChapitre->setContent($content);
        $oChapitre->setDate($date);
        // $oChapitre->setNbComments($nbComments);
        return $oChapitre;
    }
    /** 
     * @private
     * Fonction permettant de se connecter à la base de données
     * @return {Object} PDO - L'objet de la connexion à la BDD
     */
    private function _dbConnect () {
        try
        {
            return $bdd = new PDO('mysql:host=localhost;dbname=sandbox;charset=utf8', 'root', 'root');
        }
        catch (Exception $e)
        {
            return die('Erreur : ' . $e->getMessage());
        }
    }
}