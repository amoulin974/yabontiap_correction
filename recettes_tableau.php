<?php 

//Ajout du code commun à toutes les pages
require_once 'include.php';

 //Connexion à la base de données en pdo
 $pdo = new PDO('mysql:host=localhost;dbname=yabontiap_bd', 'root', '');

 //Construction de la requête

 $sql = "SELECT R.id as 'recette_id', R.nom as 'recette_nom', C.nom as 'categorie_nom', R.image  as 'recette_image' 
 FROM yabontiap_recette R 
 INNER JOIN yabontiap_categorie C ON R.id_categorie = C.id";

 $pdoStatement = $pdo->prepare($sql);
 $pdoStatement->execute();
 $recettes = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

 $template = $twig->load('recettes_tableau.html.twig');

 echo $template->render(array(
    'recettes' => $recettes,
    'menu' => 'recettes_tableau'

));
