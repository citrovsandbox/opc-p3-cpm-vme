<?php
/**
 * -----------------------------------------------------
 * -
 * -
 * -
 * -          CLASSE CHAPITRE
 * -
 * -
 * -
 * ------------------------------------------------------
 */
class Chapitre {

    private $_id;
    private $_title;
    private $_content;
    private $_isDeleted;
    private $_date;
    private $_nbComments;
    /**
     * Fonction permettant de redéfinir l'id du chapitre
     * @public
     * @param {String} Le nouvel id pour le chapitre
     * @return {Object} L'Objet Chapitre
     */
    public function setId ($id)  {
        $this->_id = $id;
        return $this;
    }
    /**
     * Fonction permettant d'obtenir l'id du chapitre
     * @public
     * @return {String} L'id du chapitre
     */
    public function getId() {
        return $this->_id;
    }
    /**
     * Fonction permettant de redéfinir le titre du chapitre
     * @public
     * @param {String} Le nouveau titre pour le chapitre
     * @return {Object} L'Objet Chapitre
     */
    public function setTitle($title) {
        $this->_title = $title;
        return $this;
    }
    /**
     * Fonction permettant d'obtenir le titre du chapitre
     * @public
     * @return {String} Le titre du chapitre
     */
    public function getTitle() {
        return $this->_title;
    }
    /**
     * Fonction permettant de redéfinir le contenu du chapitre
     * @public
     * @param {String} Le nouveau contenu pour le chapitre
     * @return {Object} L'Objet Chapitre
     */
    public function setContent($content) {
        $this->_content = $content;
        return $this;
    }
    /**
     * Fonction permettant d'obtenir le contenu du chapitre
     * @public
     * @return {String} Le contenu du chapitre
     */
    public function getContent() {
        return $this->_content;
    }
    // /**
    //  * Fonction permettant de redéfinir le statut du chapitre
    //  * @public
    //  * @param {Integer} Le nouveau statut pour le chapitre
    //  * @return {Object} L'Objet Chapitre
    //  */
    // public function setIsDeleted($isDeleted) {
    //     $this->_isDeleted = $isDeleted;
    //     return $this;
    // }
    // /**
    //  * Fonction permettant d'obtenir le statut du chapitre
    //  * @public
    //  * @return {Integer} Le statut du chapitre (0 ou 1)
    //  */
    // public function getIsDeleted() {
    //     return $this->_isDeleted;
    // }
    /**
     * Fonction permettant de redéfinir la date du chapitre
     * @public
     * @param {String} La nouvelle date pour le chapitre
     * @return {Object} L'Objet Chapitre
     */
    public function setDate($date) {
        $this->_date = $date;
        return $this;
    }
    /**
     * Fonction permettant d'obtenir la date de publication du chapitre
     * @public
     * @return {Datetime} La date de publication du chapitre
     */
    public function getDate() {
        return $this->_date;
    }
    /**
     * Fonction permettant de redéfinir le nombre de commentaires afférents au chapitre
     * @public
     * @param {Integer} Le nouveau nombre de commentaires
     * @return {Object} L'Objet Chapitre
     */
    public function setNbComments($nbComments) {
        $this->_nbComments = $nbComments;
        return $this;
    }
    /**
     * Fonction permettant d'obtenir le nombre de commentaires afférents au chapitre
     * @public
     * @return {Integer} Le nouveau nombre de commentaires
     */
    public function getNbComments() {
        return $this->_nbComments;
    }
}