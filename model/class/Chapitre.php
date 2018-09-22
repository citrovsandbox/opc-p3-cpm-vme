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
    private $_date;
    /**
     * Fonction permettant de redéfinir l'id du chapitre
     * @public
     * @param {String} Le nouvel id pour le chapitre
     * @return {void}
     */
    public function setId ($id)  {
        $this->$_id = $id;
    }
    /**
     * Fonction permettant d'obtenir l'id du chapitre
     * @public
     * @return {String} L'id du chapitre
     */
    public function getId() {
        return $this->$_id;
    }
    /**
     * Fonction permettant de redéfinir le titre du chapitre
     * @public
     * @param {String} Le nouveau titre pour le chapitre
     * @return {void}
     */
    public function setTitle($title) {
        $this->$_title = $title;
    }
    /**
     * Fonction permettant d'obtenir le titre du chapitre
     * @public
     * @return {String} Le titre du chapitre
     */
    public function getTitle() {
        return $this->$_title;
    }
    /**
     * Fonction permettant de redéfinir le contenu du chapitre
     * @public
     * @param {String} Le nouveau contenu pour le chapitre
     * @return {void}
     */
    public function setContent($content) {
        $this->$_content = $content;
    }
    /**
     * Fonction permettant d'obtenir le contenu du chapitre
     * @public
     * @return {String} Le contenu du chapitre
     */
    public function getContent() {
        return $this->$_content;
    }
    /**
     * Fonction permettant de redéfinir la date du chapitre
     * @public
     * @param {String} La nouvelle date pour le chapitre
     * @return {void}
     */
    public function setDate($date) {
        $this->$_date = $date;
    }
    /**
     * Fonction permettant d'obtenir la date de publication du chapitre
     * @public
     * @return {Datetime} La date de publication du chapitre
     */
    public function getDate() {
        return $this->$_date;
    }
}