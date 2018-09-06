<?php
/**
 * @private
 * Fonction qui permet de se connecter à la base de données
 * @return {Object} $bdd Un Objet PDO, la base de données
 */
function quickConnect () {
    try
    {
        return $bdd = new PDO('mysql:host=localhost;dbname=sandbox;charset=utf8', 'root', 'root');
    }
    catch (Exception $e)
    {
        return die('Erreur : ' . $e->getMessage());
    }
}
/**
 * @private
 * Fonction qui permet de se protéger une page
 * si l'utilisateur n'est pas connecté 
 * @return {void}
 */
function protect () {
    if(!isset($_SESSION['username'])) {
        header('Location: ../index.php');
    }
}
/**
 * @private
 * Fonction qui permet de se protéger une page
 * si l'utilisateur n'est pas connecté 
 * @return {void}
 */
function redirectToDashboardIfLoggedIn () {
    if(isset($_SESSION['username'])) {
        header('Location: ../dashboard');
    }
}