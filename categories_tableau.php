<?php

//Ajout du code commun à toutes les pages
require_once 'include.php';




 //Construction de la requête

 $sql = "SELECT C.id as 'categorie_id', C.nom as 'categorie_nom', C.image  as 'categorie_image' 
 FROM " . PREFIXE_TABLE . "categorie C ";


 $pdoStatement = $pdo->prepare($sql);
 $pdoStatement->execute();
 $categories = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);


 $template = $twig->load('categories_tableau.html.twig');
 echo $template->render(array(
        'categories' => $categories,
        'menu' => 'categories_tableau'
    ));