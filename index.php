<?php
// Si l'administrateur est connecté on redirige vers l'espace d'administration
if(isset($_SESSION['user'])) {
    header('Location: ./admin');
// Sinon on redirige vers public
} else {
    header('Location: ./blog');
}