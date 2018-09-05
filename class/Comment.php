<?php

class Comment {
    /**
     * @public
     * Fonction permettant de d'aller chercher tous les chapitres dans la base
     * @param {Integer} $id L'id du chapitre
     * @return unfetched Chapitres
     */
    public function get ($id) {
        $bdd = quickConnect();
        $req = $bdd->prepare("SELECT * FROM comments WHERE com_chapitre_id=:id");
        $req->bindValue(":id", $id);
        $req->execute();
        return $req;
    }
    /**
     * @public
     * Fonction permettant de poster un commentaire
     * @param {Integer} $chapitreid l'id du chapitre
     * @param {String} $author L'auteur du commentaire
     * @param {String} $content Le contenu du commentaire
     * @return {void}
     */
    public function post ($chapitreid, $author, $content) {
        $bdd = quickConnect();
        $req = $bdd->prepare("INSERT into comments VALUES (0, :chapitreid, :author, :content, 0, CURRENT_DATE())");
        $req->bindValue(":chapitreid", $chapitreid);
        $req->bindValue(":author", $author);
        $req->bindValue(":content", $content);
        $req->execute();

    }
}