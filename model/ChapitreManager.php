<?php

require_once '../model/class/Chapitre.php';

class ChapitreManager {
    /**
     * Méthode permettant d'obtenir un chapitre en particulier
     * @return {Object} Le chapitre recherché sous forme d'objet
     */
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
     * Méthode peremttant d'obtenir tous les chapitres
     */
    public function getAll () {
        $bdd = $this->_dbConnect();
        $req = $bdd->prepare("SELECT * FROM chapitres ORDER BY ch_id DESC");
        $req->execute();
        // error_log(serialize(print_r($req)), 3, 'C:\Users\Citrov\Documents\tmp_php.txt');
        $aChapitres = [];
        while($oChapter = $req->fetch()) {
            $oNewChapter = $this->_constructChapitre($oChapter['ch_id'], $oChapter['ch_title'], $oChapter['ch_content'], $oChapter['ch_date']);
            array_push($aChapitres, $oNewChapter);
        }
        return $aChapitres;
    }
    /**
     * Méthode permettant d'effectuer une recherche
     */
    public function search($searchVal) {
        $bdd = $this->_dbConnect();
        $req = $bdd->prepare("SELECT * FROM chapitres WHERE ch_title LIKE :title");
        $req->bindValue(':title', '%' . $searchVal . '%');
        $req->execute();
        $aChapitres = [];
        while($oChapter = $req->fetch()) {
            $oNewChapter = $this->_constructChapitre($oChapter['ch_id'], $oChapter['ch_title'], $oChapter['ch_content'], $oChapter['ch_date']);
            array_push($aChapitres, $oNewChapter);
        }
        return $aChapitres;
    }
    /**
     * Méthode permettant de poster un chapitre
     * @return {Object} Le nouveau chapitre créé
     */
    public function post($title, $content) {
        $bdd = $this->_dbConnect();
        $req = $bdd->prepare("INSERT INTO chapitres VALUES (default, :title, :content, NOW())");
        $req->bindValue(":title", $title);
        $req->bindValue(":content", $content);
        $req->execute();
        // Afin de pouvoir retourner les valeurs du chapitre au client, on retourne chercher les données
        $req1 = $bdd->prepare("SELECT * FROM chapitres WHERE ch_title=:title");
        $req1->bindValue(":title", $title);
        $req1->execute();
        $oChapter = $req1->fetch();
        $oNewChapter = $this->_constructChapitre($oChapter['ch_id'], $oChapter['ch_title'], $oChapter['ch_content'], $oChapter['ch_date']);
        return $oNewChapter;
    }
    /**
     * Méthode permettant de mettre à jour un chapitre
     * @return {Object} Le chapitre mis à jour
     */
    public function update($id, $title, $content) {
        error_log('triggered', 3, 'C:\Users\Citrov\Documents\tmp_php.txt');
        $bdd = $this->_dbConnect();
        $req = $bdd->prepare("UPDATE chapitres SET ch_title=:title, ch_content=:content WHERE ch_id=:id");
        $req->bindValue(":id", $id);
        $req->bindValue(":title", $title);
        $req->bindValue(":content", $content);
        $req->execute();
        // error_log('triggered', 3, 'C:\Users\Citrov\Documents\tmp_php.txt');
        $req1 = $bdd->prepare("SELECT * FROM chapitres WHERE ch_id=:id");
        $req1->bindValue(":id", $id);
        $req1->execute();
        $oChapter = $req1->fetch();
        $oNewChapter = $this->_constructChapitre($oChapter['ch_id'], $oChapter['ch_title'], $oChapter['ch_content'], $oChapter['ch_date']);
        return $oNewChapter;
    }
    /**
     * Méthode permettant de supprimer un chapitre
     * @return {Object} Le chapitre supprimé
     */
    public function delete($id) {
        $bdd = $this->_dbConnect();
        $req = $bdd->prepare("SELECT * FROM chapitres WHERE ch_id=:id");
        $req->bindValue(":id", $id);
        $req->execute();
        $oChapter = $req->fetch();
        $oNewChapter = $this->_constructChapitre($oChapter['ch_id'], $oChapter['ch_title'], $oChapter['ch_content'], $oChapter['ch_date']);

        $req1 = $bdd->prepare("DELETE FROM chapitres WHERE ch_id=:id");
        $req1->bindValue(":id", $id);
        $req1->execute();

        return $oNewChapter;
    }
    /**
     * Méthode permettant de construire un objet Chapitre
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
     * Méthode permettant de se connecter à la base de données
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