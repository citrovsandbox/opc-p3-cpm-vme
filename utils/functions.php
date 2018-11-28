<?php

function redirectToDashboardIfLoggedIn () {
    if(isset($_SESSION['username'])) {
        echo "<script>window.location.href = '../dashboard';</script>";
    }
}
function quickConnect () {
    try
    {
        return $bdd = new PDO('mysql:host=your_host;dbname=your_db_name;charset=utf8', 'your_db_user', 'your_db_user_pass');
    }
    catch (Exception $e)
    {
        return die('Erreur : ' . $e->getMessage());
    }
}
function protect () {
    if(!isset($_SESSION['username'])) {
        echo "<script>alert('Vous n\'êtes pas connecté. Vous allez être redirigé.');
        window.location.href = '../index.php';</script>";
    }
}