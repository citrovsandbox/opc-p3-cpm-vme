<?php

require './model/class/Chapitre.php';

$Chapitre = new Chapitre;

$Chapitre->setId(4);

$Chapitre->setContent('Merci Stéphane');

echo $Chapitre->getId(); // affiche 'Merci Stéphane'


