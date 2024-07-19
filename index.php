<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' href='style.css'>
    <title>Yabon ! - Les catégories de recettes</title>
</head>
<body>
    <header>
        <nav>
            <h1><a href="index.php">Yabon v0 !</a></h1>
            <ul>
                <li>
                    <a class="menu-active" href="index.php">Catégories</a>
                </li>
                <li>
                    <a href="recettes.php">Recettes</a>
                </li>
                <li>
                    <a href="recettes_tableau.php">Recettes tableau</a>
                </li>
            </ul>
        </nav>
    </header>


    <main>
        <h1>Les catégories de recettes</h1>
        <?php
        //Connexion à la base de données en pdo
        $pdo = new PDO('mysql:host=localhost;dbname=yabontiap_bd', 'root', '');

        $sql = "SELECT * FROM yabontiap_categorie";
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute();
        $categories = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <div id="zone_cartes">

            <?php
            foreach ($categories as $categorie) {
                ?>

                <!--Les cartes-->
                <div class="cartes">
                    <a href="recettes.php?id_categorie=<?= $categorie['id'] ?>">
                        <img src='<?= "image/" . $categorie['image'] ?>' width="100" height="auto" alt="">
                        <div>
                            <h5><?= $categorie['nom'] ?></h5>
                        </div>
                    </a>
                </div>


            <?php } ?>

        </div>
    </main>
    <footer>
            <p>Ce site est un contre exemple. Il montre ce qu'il ne faut pas faire </p>
            <p><a href="licence.php">Les licences des images</a></p>
    </footer>
</body>
</html>



