<?php
error_reporting(E_ALL); ini_set('display_errors', 'on');

require_once '../controller/PublicController.php';

$Controller = new PublicController;
$Controller->chapterPage($_GET['id']);