<?php
//Récupération de la recette  grace à l'id transmis dans le GET
//ATTENTION Cette méthode de travail n'est pas sécurisée. LA bonne méthode sera abordée ultérieurement

$id_categorie = isset($_GET['id_categorie'])?$_GET['id_categorie']:null;



//Connexion à la base de données en pdo
$pdo = new PDO('mysql:host=localhost;dbname=yabontiap_bd', 'root', '');

//Construction de la requête
$sql = "SELECT * FROM yabontiap_categorie C WHERE C.id=:id_categorie";

$pdoStatement = $pdo->prepare($sql);
$pdoStatement->execute(array(':id_categorie' => $id_categorie));
$categorie = $pdoStatement->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="CSS/styles.css">
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
    <!-- <link rel='stylesheet' type='text/css' href='style.css'> -->
    <title>Yabontiap ! - <?= $categorie['nom']?></title>
</head>
<body class="container">
    

    
    <header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Yabontiap v1</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link " aria-current="page" href="index.php">Catégories</a>
                </li>
                <li class="nav-item">
                <a class="nav-link " href="recettes.php">Recettes</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="recettes_tableau.php">Recette_tableau</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active" href="categories_tableau.php">Catégories tableau</a>
                </li>
  
            </ul>
            </div>
        </div>
    </nav>
    </header>


    <main>
        <h1>La catégorie : <?= $categorie['nom'] ?></h1>
<!--                Affichage de la description de la recette et de l'image-->
        <div class="row">
            <div class="col-md-9">
                <img src="image/<?= $categorie['image'] ?>"  alt="">



            </div>
           
        </div>
        
    </main>

    <footer>
            <p>Ce site est un contre exemple. Il montre ce qu'il ne faut pas faire </p>
            <p><a href="licence.php">Les licences des images</a></p>
    </footer>


</body>
</html>



<?php
