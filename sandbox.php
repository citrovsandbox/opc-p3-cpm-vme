<?php
// require './model/ChapitreManager.php';
require './model/class/Chapitre.php';


// $ChapitreManager = new ChapitreManager;

// $aChapter = $ChapitreManager->getAll();

// // foreach($aChapter as $oChapter) {
// //     echo $oChapter->getContent();
// // }
// print_r($aChapter[0]->getContent());

$Chapitre = new Chapitre;
$Chapitre->setId(4);
$Chapitre->setContent('zefzefzefzefz');
echo $Chapitre->getId();


