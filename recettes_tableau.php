<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="CSS/styles.css">
    <link rel="stylesheet" type="text/css" href="node_modules/datatables.net-bs5/css/dataTables.bootstrap5.css">
    <!-- <link rel='stylesheet' type='text/css' href='style.css'> -->
    <title>Yabon ! - Les recettes sous forme de tableau</title>
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
                <a class="nav-link" href="recettes.php">Recettes</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active" href="recettes_tableau.php">Recette_tableau</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="categories_tableau.php">Catégories tableau</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>
    </header>


    <main>
        <h1>Les recettes</h1>
        <table id="matable" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Nom</th>
                    <th>Catégorie</th>

                </tr>
            </thead>
            <tbody>



        <?php
        //Récupération de la catégorie de recette dans le Get
        //ATTENTION Cette méthode de travail n'est pas sécurisée. LA bonne méthode sera abordée ultérieurement




        //Connexion à la base de données en pdo
        $pdo = new PDO('mysql:host=localhost;dbname=yabontiap_bd', 'root', '');

        //Construction de la requête

        $sql = "SELECT R.id as 'recette_id', R.nom as 'recette_nom', C.nom as 'categorie_nom', R.image  as 'recette_image' 
        FROM yabontiap_recette R 
        INNER JOIN yabontiap_categorie C ON R.id_categorie = C.id";

        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute();
        $recettes = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

                foreach ($recettes as $recette) {
                    ?>

                    <!--Les cartes-->
                    <tr>
                        <td><img src='<?= "image/" . $recette['recette_image'] ?>' alt=""></td>
                        <td><a href="recette.php?id_recette=<?=$recette['recette_id']?>"><?= $recette['recette_nom'] ?></a></td>
                        <td><?= $recette['categorie_nom'] ?></td>

                    </tr>



                <?php } ?>
            </tbody>
        </table>
    </main>

    <footer >
        <p>Ce site est un contre exemple. Il montre ce qu'il ne faut pas faire </p>
        <p><a href="licence.php">Les licences des images</a></p>
    </footer>

    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
    <script src="node_modules/jquery/dist/jquery.js"></script>
    <script src="node_modules/datatables.net/js/dataTables.js"></script>
    <script src="node_modules/datatables.net-bs5/js/dataTables.bootstrap5.js"></script>
    <script src="JS/messcript.js"></script>
</body>
</html>



