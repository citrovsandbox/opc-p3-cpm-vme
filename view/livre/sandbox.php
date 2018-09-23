<?php

require './model/ChapitreManager.php';

$ChapitreManager = new ChapitreManager;
$aChapitres = $ChapitreManager->getAll();

foreach($aChapitres as $oChapitre) {
    echo $oChapitre->getTitle();
}


