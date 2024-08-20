<?php

//Ajout du code commun à toutes les pages
require_once 'include.php';


//Récupération de la catégorie de recette dans le Get
//ATTENTION Cette méthode de travail n'est pas sécurisée. LA bonne méthode sera abordée ultérieurement

$idCategorie = isset($_GET['id_categorie']) ? $_GET['id_categorie'] : null;


//Construction de la requête
$sql = "SELECT * FROM " . PREFIXE_TABLE . "recette R";
if (isset($idCategorie)) {
    $sql .= " WHERE R.id_categorie=:id_categorie";
}


$pdoStatement = $pdo->prepare($sql);

if (isset($idCategorie)) {
    $pdoStatement->execute(array(':id_categorie' => $idCategorie));
}else{
    $pdoStatement->execute();
}

$recettes = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);


$template = $twig->load('recettes.html.twig');
           
echo $template->render(array(
    'recettes' => $recettes, 
    'menu' => 'recettes'
));
           
       



