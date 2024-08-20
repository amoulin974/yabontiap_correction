<?php

//ajout de l’autoload de composer
require_once 'vendor/autoload.php';

//ajout de la classe IntlExtension et creation de l’alias IntlExtension
use Twig\Extra\Intl\IntlExtension;

//initialisation twig : chargement du dossier contenant les templates
$loader = new Twig\Loader\FilesystemLoader('templates');

//Paramétrage de l'environnement twig
$twig = new Twig\Environment($loader, [
    /*passe en mode debug à enlever en environnement de prod : permet d'utiliser dans un templates {{dump
    (variable)}} pour afficher le contenu d'une variable. Nécessite l'utilisation de l'extension debug*/
    'debug' => true,
    // Il est possible de définir d'autre variable d'environnement
    //...
]);

//Définition de la timezone pour que les filtres date tiennent compte du fuseau horaire français.
$twig->getExtension(\Twig\Extension\CoreExtension::class)->setTimezone('Europe/Paris');

//Ajouter l'extension debug
$twig->addExtension(new \Twig\Extension\DebugExtension());

//Ajout de l'extension d'internationalisation qui permet d'utiliser les filtres de date dans twig
$twig->addExtension(new IntlExtension());



//Récupération de la recette  grace à l'id transmis dans le GET
//ATTENTION Cette méthode de travail n'est pas sécurisée. LA bonne méthode sera abordée ultérieurement

$id_recette = isset($_GET['id_recette'])?$_GET['id_recette']:null;



//Connexion à la base de données en pdo
$pdo = new PDO('mysql:host=localhost;dbname=yabontiap_bd', 'root', '');

//Construction de la requête
$sql = "SELECT R.*, RI.*, I.nom as ingredient_nom FROM yabontiap_recette R
INNER JOIN yabontiap_recette_ingredient RI ON R.id=RI.id_recette
INNER JOIN yabontiap_ingredient I ON RI.id_ingredient=I.id 
WHERE R.id=:id_recette";

$pdoStatement = $pdo->prepare($sql);
$pdoStatement->execute(array(':id_recette' => $id_recette));
$recette = $pdoStatement->fetchall(PDO::FETCH_ASSOC);

$template = $twig->load('recette.html.twig');

echo $template->render(array(
    'recette' => $recette,
    'menu' => 'recettes'
));

