<?php

require_once __DIR__ . '/../model/class/Chapitre.php';

class ChapitreManager {
    /**
     * Méthode permettant d'obtenir un chapitre en particulier
     * @return {Object} Le chapitre recherché sous forme d'objet
     */
    public function get ($id) {
        $bdd = $this->_dbConnect();
        $req = $bdd->prepare("SELECT * FROM chapitres WHERE ch_id=:id AND ch_deleted=0");
        $req->bindValue(':id', $id);
        $req->execute();
        if($oChapter = $req->fetch()) {
            $oNewChapter = $this->_constructChapitre($oChapter['ch_id'], $oChapter['ch_title'], $oChapter['ch_content'], $oChapter['ch_deleted'], $oChapter['ch_date']);
        } else {
            return false;
        }
        return $oNewChapter;
    }
    /**
     * Méthode peremttant d'obtenir tous les chapitres
     */
    public function getAll () {
        $bdd = $this->_dbConnect();
        $req = $bdd->prepare("SELECT * FROM chapitres WHERE ch_deleted=0 ORDER BY ch_id DESC");
        $req->execute();
        // error_log(serialize(print_r($req)), 3, 'C:\Users\Citrov\Documents\tmp_php.txt');
        $aChapitres = [];
        while($oChapter = $req->fetch()) {
            $oNewChapter = $this->_constructChapitre($oChapter['ch_id'], $oChapter['ch_title'], $oChapter['ch_content'], $oChapter['ch_deleted'], $oChapter['ch_date']);
            array_push($aChapitres, $oNewChapter);
        }
        return $aChapitres;
    }
    /**
     * Méthode permettant d'effectuer une recherche
     */
    public function search($searchVal) {
        $bdd = $this->_dbConnect();
        $req = $bdd->prepare("SELECT * FROM chapitres WHERE ch_title LIKE :title AND ch_deleted=0");
        $req->bindValue(':title', '%' . $searchVal . '%');
        $req->execute();
        $aChapitres = [];
        while($oChapter = $req->fetch()) {
            $oNewChapter = $this->_constructChapitre($oChapter['ch_id'], $oChapter['ch_title'], $oChapter['ch_content'], $oChapter['ch_deleted'], $oChapter['ch_date']);
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
        $req = $bdd->prepare("INSERT INTO chapitres VALUES (default, :title, :content, 0, NOW())");
        $req->bindValue(":title", $title);
        $req->bindValue(":content", $content);
        $req->execute();
        // Afin de pouvoir retourner les valeurs du chapitre au client, on retourne chercher les données
        $req1 = $bdd->prepare("SELECT * FROM chapitres WHERE ch_title=:title");
        $req1->bindValue(":title", $title);
        $req1->execute();
        $oChapter = $req1->fetch();
        $oNewChapter = $this->_constructChapitre($oChapter['ch_id'], $oChapter['ch_title'], $oChapter['ch_content'], $oChapter['ch_deleted'], $oChapter['ch_date']);
        return $oNewChapter;
    }
    /**
     * Méthode permettant de mettre à jour un chapitre
     * @return {Object} Le chapitre mis à jour
     */
    public function update($id, $title, $content) {
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
        $oNewChapter = $this->_constructChapitre($oChapter['ch_id'], $oChapter['ch_title'], $oChapter['ch_content'], $oChapter['ch_deleted'], $oChapter['ch_date']);
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
        $oNewChapter = $this->_constructChapitre($oChapter['ch_id'], $oChapter['ch_title'], $oChapter['ch_content'], $oChapter['ch_deleted'], $oChapter['ch_date']);

        // $req1 = $bdd->prepare("DELETE FROM chapitres WHERE ch_id=:id");
        $req1 = $bdd->prepare("UPDATE chapitres SET ch_deleted=1 WHERE ch_id=:id");
        $req1->bindValue(":id", $id);
        $req1->execute();

        return $oNewChapter;
    }
    /**
     * Méthode permettant de construire un objet Chapitre
     * @private
     * @return {Object} Le chapitre créé
     */
    private function _constructChapitre ($id, $title, $content, $isDeleted, $date) {
        $oChapitre = new Chapitre;

        $oChapitre->setId($id);
        $oChapitre->setTitle($title);
        $oChapitre->setContent($content);
        // $oChapitre->setIsDeleted($isDeleted);
        $oChapitre->setDate($date);

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
            return $bdd = new PDO('mysql:host=your_host;dbname=your_db_name;charset=utf8', 'your_db_user', 'your_db_user_pass');
        }
        catch (Exception $e)
        {
            return die('Erreur : ' . $e->getMessage());
        }
    }
}