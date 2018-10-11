<?php
require '../../utils/functions.php';
session_start();
protect();
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../lib/css/bootstrap.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="../../src/css/common-admin.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/master.css">
    <script src="../../lib/js/jquery.js"></script>
    <script src="../../lib/js/bootstrap.js"></script>
    <script src="../../lib/js/bootstrap.bundle.js"></script>
    <script src="dashboard.js"></script>
    <script src="./js/menuController.js"></script>
</head>
<body>
<div id="pageContainer">
    <!-- Master  -->
    <?php include('./fragments/master.html') ?>

    <!-- Details -->
    <section id="detailsContainer">
        <!-- Bloc de contenu qui chargera les différents container en f((x) des actions -->
        <div id="detailsContentContainer">
            <div>
        </div>
    </section>
</div>
</body>
</html>