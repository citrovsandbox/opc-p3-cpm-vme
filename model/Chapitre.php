<?php

class Chapitre {
    /**
     * @public
     * Fonction permettant de d'aller chercher tous les chapitres dans la base
     * @returns {Array} Les chapitres
     */
    public function get () {
        $bdd = $this->_dbConnect();
        $req = $bdd->prepare("SELECT * FROM chapitres ORDER BY ch_id DESC");
        $req->execute();
        return $req->fetchAll();
    }
    /**
     * @public
     * Fonction permettant d'aller chercher un chapitre en fonction de son id
     * dans la base de données
     * @returns {Object} $result L'objet correspondant au chapitre trouvé
     */
    public function getSpecific ($id) {
        $bdd = $this->_dbConnect();
        $req = $bdd->prepare("SELECT * FROM chapitres WHERE ch_id=:id");
        $req->bindValue(":id", $id);
        $req->execute();
        $result = $req->fetch();
        return $result;
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