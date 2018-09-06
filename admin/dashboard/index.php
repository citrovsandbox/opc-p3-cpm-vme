<?php
require '../../utils/functions.php';
require '../../class/Autoloader.php';
Autoloader::register();
?>
<?php
// require '../../utils/functions.php';
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
    <link rel="stylesheet" href="dashboard.css">
    <script src="../../lib/js/jquery.js"></script>
    <script src="../../lib/js/bootstrap.js"></script>
    <script src="../../lib/js/bootstrap.bundle.js"></script>
    <script src="dashboard.js"></script>
</head>
<body>
<div id="pageContainer">
    <section>
        <p>Dashboard</p>
        <a href="../lock.php">Déconnexion</a>
    </section>
</div>
</body>
</html>