<?php
/**
 * -----------------------------------------------------
 * -
 * -
 * -
 * -          CLASSE COMMENTAIRE
 * -
 * -
 * -
 * ------------------------------------------------------
 */
class Comment {

    private $_id;
    private $_author;
    private $_content;
    private $_reported;
    private $_flag;
    private $_date;

    public function setId ($id) {
        $this->_id = $id;
        return $this;
    }
    public function getId () {
        return $this->_id;
    }
    public function setAuthor ($author){
        $this->_author = $author;
        return $this;
    }
    public function getAuthor () {
        return $this->_author;
    }
    public function setContent ($content) {
        $this->_content = $content;
        return $this;
    }
    public function getContent () {
        return $this->_content;
    }
    public function setFlag ($flag) {
        if($flag == 0) {
            $this->_reported = false;
        } else {
            $this->_reported = true;
        }
        $this->_flag = $flag;
        return $this;
    }
    public function getFlag (){
        return $this->_flag;
    }
    public function getReportedStatus (){
        return $this->_reported;
    }
    public function setDate ($date) {
        $this->_date = $date;
        return $this;
    }
    public function getDate() {
        return $this->_date;
    }
}