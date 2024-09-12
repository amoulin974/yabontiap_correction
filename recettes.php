<?php

//Ajout du code commun à toutes les pages
require_once 'include.php';


//Récupération de la catégorie de recette dans le Get
//ATTENTION Cette méthode de travail n'est pas sécurisée. LA bonne méthode sera abordée ultérieurement

$idCategorie = isset($_GET['id_categorie']) ? $_GET['id_categorie'] : null;


//Connexion à la base de données
$db= Bd::getInstance();
$pdo=$db->getConnexion();

//Récupération des recettes
$managerRecette = new RecetteDao($pdo);

if ($idCategorie == null) {
    $recettes = $managerRecette->findAll();
} else {
    $recettes = $managerRecette->findByCategorie($idCategorie);
}

//Génère la vue
$template = $twig->load('recettes.html.twig');
           
echo $template->render(array(
    'recettes' => $recettes, 
    'menu' => 'recettes'
));





           
       



