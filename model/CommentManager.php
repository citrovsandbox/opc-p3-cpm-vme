<?php

require_once '../model/class/Comment.php';

class CommentManager {
    /**
     * Fonction permettant de récupérer les chapitres d'un chapitre via son id
     * Retourne untableau d'objets commentaires
     * @public
     * @return {Array} Un tableau d'objets commentaires
     */
    public function get ($chapterId) {
        $bdd = $this->_dbConnect();
        $req = $bdd->prepare("SELECT * FROM comments WHERE com_chapitre_id=:chapterid");
        $req->bindValue(":chapterid", $chapterId);
        $req->execute();
        $aComments = [];
        while($oComment = $req->fetch()) {
            $oNewComment = $this->_constructComment($oComment['com_id'], $oComment['com_author'], $oComment['com_content'], $oComment['com_flag'], $oComment['com_date']);
            array_push($aComments, $oNewComment);
        }
        return $aComments;
    }
    /**
     * Méthode peremttant d'obtenir tous les commentaires
     * @public
     * @return {Array} Un tableau d'objets commentaires
     */
    public function getAll () {
        $bdd = $this->_dbConnect();
        $req = $bdd->prepare("SELECT * FROM comments ORDER BY com_id DESC");
        $req->execute();
        $aComments = [];
        while($oComment = $req->fetch()) {
            $oNewComment = $this->_constructComment($oComment['com_id'], $oComment['com_author'], $oComment['com_content'], $oComment['com_flag'], $oComment['com_date']);
            array_push($aComments, $oNewComment);
        }
        return $aComments;
    }
    /**
     * Méthode peremttant de flag un commentaire
     * @public
     * @return {Array} Un tableau d'objets commentaires
     */
    public function flag ($commentId) {
        error_log('triggered', 3, 'C:\Users\Citrov\Documents\tmp_php.txt');
        $bdd = $this->_dbConnect();
        $req = $bdd->prepare("UPDATE comments SET com_flag=1 WHERE com_id=:commentid");
        $req->bindValue(":commentid", $commentId);
        $req->execute();
        // error_log('triggered', 3, 'C:\Users\Citrov\Documents\tmp_php.txt');
        $req1 = $bdd->prepare("SELECT * FROM comments WHERE com_id=:commentid");
        $req1->bindValue(":commentid", $commentId);
        $req1->execute();
        $oComment = $req1->fetch();
        $oNewComment = $this->_constructComment($oComment['com_id'], $oComment['com_author'], $oComment['com_content'], $oComment['com_flag'], $oComment['com_date']);
        return $oNewComment;
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