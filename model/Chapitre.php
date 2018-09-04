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
}