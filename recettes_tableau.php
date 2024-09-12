<?php 

//Ajout du code commun à toutes les pages
require_once 'include.php';

//connexion à la base de données
$pdo = Bd::getInstance()->getConnexion();

//Récupération des recettes à l'aide de la méthode findAllWithDetail() de RecetteDao
$managerRecette = new RecetteDao($pdo);
$recettes = $managerRecette->findAllWithDetail();




//Générer la vue
 $template = $twig->load('recettes_tableau.html.twig');

 echo $template->render(array(
    'recettes' => $recettes,
    'menu' => 'recettes_tableau'

));

 