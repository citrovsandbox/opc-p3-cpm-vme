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
    <link rel="stylesheet" href="css/details.css">
    <link rel="stylesheet" href="css/manageChapters.css">
    <script src="../../lib/js/jquery.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="../../lib/js/bootstrap.js"></script>
    <script src="../../lib/js/bootstrap.bundle.js"></script>
    <script src="dashboard.js"></script>
    <script src="./js/menuController.js"></script>
    <script src="./js/chaptersController.js"></script>
</head>
<body>
<div id="pageContainer">
    <!-- Master  -->
    <?php include('./fragments/master.html') ?>

    <!-- Details -->
    <section id="detailsContainer">
        <!-- Bloc de contenu qui chargera les différents container en f((x) des actions -->
        <div id="detailsContentContainer">

            <!-- Page de gestion des chapitres -->
            <div id="manageChaptersContainer">
                <!-- titre -->
                <h3 class="pastel-blue">Gestion des chapitres</h3>
                <!-- Sous-titre -->
                <p class="pastel-blue">Saisir pour filtrer</p>
                <!-- search bar -->
                <div class="searchBarContainer">
                    <div class="searchBarInputContainer">
                        <input id="chapterSearchInput" type="text" class="searchBarInput">
                    </div>
                    <div id="chaptersSearchButton" class="iconSearchBarContainer pastel-green-bg">
                        <i class="fas fa-edit pastel-deepblue searchIcon"></i>
                    </div>
                </div>
                <!-- Titre d'info de table -->
                <p class="pastel-blue m-t-15">Cliquer sur le contenu pour l'éditer</p>
                <!-- Table -->
                <div class="dataTableContainer">
                    <table id="chaptersTable" class="dataTable">
                        <!-- En-tête de table -->
                        <thead class="dataTableHead">
                            <tr>
                                <th>Titre du chapitre</th>
                            </tr>
                        </thead>
                        <!-- Corps de table -->
                        <tbody id="chaptersDataTableBody" class="dataTableBody">
                            <!-- ligne unitaire -->
                            <!-- <tr class="dataTableRow">
                                <td>Titre</td>
                            </tr> -->
                        </tbody>
                        
                    </table>
                </div>
            </div>

        </div>
    </section>
</div>

<!-- CHAPTER MODAL -->

</body>
</html>