<?php
// require('../../utils/functions.php');

class Comment {
    /**
     * @public
     * Fonction permettant de d'aller chercher tous les chapitres dans la base
     * @param {Integer} $id L'id du chapitre
     * @returns unfetched Chapitres
     */
    public function get ($id) {
        $bdd = quickConnect();
        $req = $bdd->prepare("SELECT * FROM comments WHERE com_chapitre_id=:id");
        $req->bindValue(":id", $id);
        $req->execute();
        return $req;
    }
}