<?php
require '../../utils/functions.php';
session_start();
redirectToDashboardIfLoggedIn();
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Authentification</title>
    <link rel="stylesheet" href="../../lib/css/bootstrap.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="../../src/css/common-blog.css">
    <link rel="stylesheet" href="auth.css">
    <script src="../../lib/js/jquery.js"></script>
    <script src="../../lib/js/bootstrap.js"></script>
    <script src="../../lib/js/bootstrap.bundle.js"></script>
    <script src="auth.js"></script>
</head>
<body>
<div id="pageContainer">
    <!-- Form container -->
    <div id="authFormContainer">
        <h4>Connexion à l'espace d'administration</h4>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Nom d'utilisateur</span>
            </div>
            <input id="usernameInput" type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Mot de passe</span>
            </div>
            <input id="passwordInput" type="password" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
        </div>
        <button id="submitButton" class="btn btn-info iced">Connexion</button>
        <!-- Info -->
        <!-- <div id="info" class="alert alert-danger" role="alert"></div> -->
    </div>
</div>
</body>
</html>