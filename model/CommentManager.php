<?php

require_once '../model/class/Comment.php';

class CommentManager {
    /**
     * Fonction permettant de récupérer les chapitres d'un chapitre via son id
     * Retourne untableau d'objets commentaires
     * @public
     * @return {Array} Un tableau d'objets commentaires
     */
    public function get ($id) {
        $bdd = $this->_dbConnect();
        $req = $bdd->prepare("SELECT * FROM comments WHERE com_chapitre_id=:id");
        $req->bindValue(":id", $id);
        $req->execute();
        $aComments = [];
        while($oComment = $req->fetch()) {
            $oNewComment = $this->_constructComment($oComment['com_id'], $oComment['com_author'], $oComment['com_content'], $oComment['com_flag'], $oComment['com_date']);
            array_push($aComments, $oNewComment);
        }
        return $aComments;
    }
    /**
     * Fonction permettant de construire un objet Chapitre
     * @private
     * @return {Object} Le commentaire créé
     */
    private function _constructComment ($id, $author, $content, $flag, $date) {
        $oComment = new Comment;

        $oComment->setId($id);
        $oComment->setAuthor($author);
        $oComment->setContent($content);
        $oComment->setFlag($flag);
        $oComment->setDate($date);

        return $oComment;
    }

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