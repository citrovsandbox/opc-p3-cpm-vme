<?php
require('../../utils/functions.php');

class Chapitre {
    /**
     * @public
     * Fonction permettant de d'aller chercher tous les chapitres dans la base
     * @returns unfetched Chapitres
     */
    public function get () {
        $bdd = quickConnect();
        $req = $bdd->prepare("SELECT * FROM chapitres ORDER BY ch_id DESC");
        $req->execute();
        return $req;
    }
    /**
     * @public
     * Fonction permettant d'aller chercher un chapitre en fonction de son id
     * dans la base de données
     * @returns {Object} $result L'objet correspondant au chapitre trouvé
     */
    public function getSpecific ($id) {
        $bdd = quickConnect();
        $req = $bdd->prepare("SELECT * FROM chapitres WHERE ch_id=:id");
        $req->bindValue(":id", $id);
        $req->execute();
        $result = $req->fetch();
        return $result;
    }
}