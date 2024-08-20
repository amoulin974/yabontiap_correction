<?php

//Ajout du code commun à toutes les pages
require_once 'include.php';



//Récupération de la recette  grace à l'id transmis dans le GET
//ATTENTION Cette méthode de travail n'est pas sécurisée. LA bonne méthode sera abordée ultérieurement

$id_recette = isset($_GET['id_recette'])?$_GET['id_recette']:null;




//Construction de la requête
$sql = "SELECT R.*, RI.*, I.nom as ingredient_nom FROM " . PREFIXE_TABLE . "recette R
INNER JOIN " . PREFIXE_TABLE . "recette_ingredient RI ON R.id=RI.id_recette
INNER JOIN " . PREFIXE_TABLE . "ingredient I ON RI.id_ingredient=I.id 
WHERE R.id=:id_recette";

$pdoStatement = $pdo->prepare($sql);
$pdoStatement->execute(array(':id_recette' => $id_recette));
$recette = $pdoStatement->fetchall(PDO::FETCH_ASSOC);

$template = $twig->load('recette.html.twig');

echo $template->render(array(
    'recette' => $recette,
    'menu' => 'recettes'
));

