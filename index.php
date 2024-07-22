<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="CSS/styles.css">
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
    <!-- <link rel='stylesheet' type='text/css' href='style.css'> -->
    <title>Yabon ! - Les catégories de recettes</title>
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
                <a class="nav-link active" aria-current="page" href="index.php">Catégories</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="recettes.php">Recettes</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="recettes_tableau.php">Recette_tableau</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active" href="categories_tableau.php">RCatégories tableau</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>
    </header>


    <main>
        <h1 class="mycolor">Les catégories de recettes</h1>
        <?php
        //Connexion à la base de données en pdo
        $pdo = new PDO('mysql:host=localhost;dbname=yabontiap_bd', 'root', '');

        $sql = "SELECT * FROM yabontiap_categorie";
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute();
        $categories = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <div id="zone_cartes" class="row row-cols-3">

            <?php
            foreach ($categories as $categorie) {
                ?>

                <!--Les cartes-->
                <a href="recettes.php?id_categorie=<?= $categorie['id'] ?>" class="col mb-3">
                    <div class="card" style="width: 18rem;">
                        <img src="<?= "image/" . $categorie['image'] ?>" class="card-img-top" alt="">
                        <div class="card-body bg-primary">
                            <h5><?= $categorie['nom'] ?></h5>
                        </div>
                    </div>
                </a>                

            <?php } ?>

        </div>
    </main>
    <footer class="text-body-secondary py-5">
            <p class="mb-1">Ce site est un contre exemple. Il montre ce qu'il ne faut pas faire </p>
            <p><a href="licence.php">Les licences des images</a></p>
    </footer>

</body>
</html>



