<?php

require_once __DIR__ . '/../model/class/Comment.php';


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
        $bdd = $this->_dbConnect();
        $req = $bdd->prepare("UPDATE comments SET com_flag=1 WHERE com_id=:commentid");
        $req->bindValue(":commentid", $commentId);
        $req->execute();
        $req1 = $bdd->prepare("SELECT * FROM comments WHERE com_id=:commentid");
        $req1->bindValue(":commentid", $commentId);
        $req1->execute();
        $oComment = $req1->fetch();
        $oNewComment = $this->_constructComment($oComment['com_id'], $oComment['com_author'], $oComment['com_content'], $oComment['com_flag'], $oComment['com_date']);
        return $oNewComment;
    }
    /**
     * Méthode permettant de unflag un commentaire
     * @public
     * @return {Array} Un tableau d'objets commentaires
     */
    public function unflag ($commentId) {
        $bdd = $this->_dbConnect();
        $req = $bdd->prepare("UPDATE comments SET com_flag=0 WHERE com_id=:commentid");
        $req->bindValue(":commentid", $commentId);
        $req->execute();
        $req1 = $bdd->prepare("SELECT * FROM comments WHERE com_id=:commentid");
        $req1->bindValue(":commentid", $commentId);
        $req1->execute();
        $oComment = $req1->fetch();
        $oNewComment = $this->_constructComment($oComment['com_id'], $oComment['com_author'], $oComment['com_content'], $oComment['com_flag'], $oComment['com_date']);
        return $oNewComment;
    }
    public function post($chapterId, $author, $content) {
        $bdd = $this->_dbConnect();
        $req = $bdd->prepare("INSERT INTO comments VALUES (default, :chapterid, :author, :content, 0,  NOW())");
        $req->bindValue(":chapterid", $chapterId);
        $req->bindValue(":author", $author);
        $req->bindValue(":content", $content);
        $req->execute();
        // Afin de pouvoir retourner les valeurs du chapitre au client, on retourne chercher les données
        $req1 = $bdd->prepare("SELECT * FROM comments WHERE com_content=:content");
        $req1->bindValue(":content", $content);
        $req1->execute();
        $oComment = $req1->fetch();
        $oNewComment = $this->_constructComment($oComment['com_id'], $oComment['com_author'], $oComment['com_content'], $oComment['com_flag'], $oComment['com_date']);
        return $oNewComment;
    }
    /**
     * Méthode permettant de supprimer un commentaire
     * @return {Object} Le commentaire supprimé
     */
    public function delete($id) {
        $bdd = $this->_dbConnect();
        $req = $bdd->prepare("SELECT * FROM comments WHERE com_id=:id");
        $req->bindValue(":id", $id);
        $req->execute();
        $oComment = $req->fetch();
        $oNewComment = $this->_constructComment($oComment['com_id'], $oComment['com_author'], $oComment['com_content'], $oComment['com_flag'], $oComment['com_date']);

        $req1 = $bdd->prepare("DELETE FROM comments WHERE com_id=:id");
        $req1->bindValue(":id", $id);
        $req1->execute();

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