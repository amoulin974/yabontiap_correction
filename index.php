<?php

//Ajout du code commun à toutes les pages
require_once 'include.php';

//Récupération des catégories en base de données
$sql = "SELECT * 
FROM " . PREFIXE_TABLE . "categorie";
$pdoStatement = $pdo->prepare($sql);
$pdoStatement->execute();
$categories = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        
$template = $twig->load('index.html.twig');

echo $template->render(array(
    'categories' => $categories,
    'menu' => 'categories'
));
