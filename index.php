<?php
session_start();
// Si l'administrateur est connecté on redirige vers l'espace d'administration
if(isset($_SESSION['username'])) {
    header('Location: ./admin');
// Sinon on redirige vers public
} else {
    header('Location: ./blog/livre');
}