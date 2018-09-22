<?php

require_once './model/class/Chapitre.php';

class ChapitreManager {
    /**
     * A chaque requete le ChapitreManager va générer des objets chapitre
     */
    public function getAll () {
        $bdd = $this->_dbConnect();
        $req = $bdd->prepare("SELECT * FROM chapitres ORDER BY ch_id DESC");
        $req->execute();
        $aChapitres = []; // Le tableau des chapitres sous forme d'objet
        // $req->fetchAll();
        // Transformer ça en objets à l'aide de la classe _construct
        while($oChapter = $req->fetch()) {
            // echo $oChapter['ch_title'];
            // array_push($aChapitres, $this->_constructChapitre($oChapter['ch_id'], $oChapter['ch_title'], $oChapter['ch_content'], $oChapter['ch_date']));
            $oNewChapter = $this->_constructChapitre($oChapter['ch_id'], $oChapter['ch_title'], $oChapter['ch_content']);
            echo $oNewChapter->getId();
        }
        return $aChapitres;
    }
    /**
     * Fonction permettant de construire un objet Chapitre
     * @private
     * @return {Object} Le chapitre créé
     */
    private function _constructChapitre ($id, $title, $content) {
        $oChapitre = new Chapitre;

        $oChapitre->setId($id);
        echo
        $oChapitre->setTitle($title);
        $oChapitre->setContent($content);
        // $oChapitre->setDate($date);

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