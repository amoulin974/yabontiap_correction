<?php

class RecetteDao{
    private ?PDO $pdo;

    public function __construct(?PDO $pdo=null){
        $this->pdo = $pdo;
    }

    public function findAll(): array{
        //requete
        $sql = "SELECT * FROM " . PREFIXE_TABLE ."recette";
        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->execute();
        $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);
        $tableau = $pdoStatement->fetchAll();
        $recettes = $this->hydrateMany($tableau);
        return $recettes;
        

    }

    public function findWithDetail(int $idRecette): Recette{
        //requete
        $sql = "SELECT R.id, R.nom, R.description, R.image, C.id AS categorie_id,  C.nom AS categorie_nom, C.image AS categorie_image,
        I.id AS ingredient_id, I.nom AS ingredient_nom, I.image AS ingredient_image, RI.quantite AS recette_ingredient_quantite
         FROM " . PREFIXE_TABLE ."recette R
        INNER JOIN " . PREFIXE_TABLE ."categorie C ON R.id_categorie=C.id
        INNER JOIN " . PREFIXE_TABLE ."recette_ingredient RI ON R.id=RI.id_recette
        INNER JOIN " . PREFIXE_TABLE ."ingredient I ON RI.id_ingredient=I.id
        WHERE R.id=:id_recette";
        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->execute(array(':id_recette' => $idRecette));
        $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);
        $tableau = $pdoStatement->fetchAll();
        $recettes = $this->hydrate($tableau);
        return $recettes;
        

    }


    public function findAllWithDetail(): array{
        //requete
        $sql = "SELECT R.id, R.nom, R.description, R.image, C.id AS categorie_id,  C.nom AS categorie_nom, C.image AS categorie_image,
        I.id AS ingredient_id, I.nom AS ingredient_nom, I.image AS ingredient_image, RI.quantite AS recette_ingredient_quantite
         FROM " . PREFIXE_TABLE ."recette R
        INNER JOIN " . PREFIXE_TABLE ."categorie C ON R.id_categorie=C.id
        INNER JOIN " . PREFIXE_TABLE ."recette_ingredient RI ON R.id=RI.id_recette
        INNER JOIN " . PREFIXE_TABLE ."ingredient I ON RI.id_ingredient=I.id
        ";
        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->execute();
        $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);
        $tableau = $pdoStatement->fetchAll();
        $recettes = $this->hydrateMany($tableau);
        return $recettes;
        

    }

    public function findByCategorieWithDetail(int $idCategorie): array{
        //requette
        $sql = "SELECT R.id, R.nom, R.description, R.image, C.id AS categorie_id,  C.nom AS categorie_nom, C.image AS categorie_image,
        I.id AS ingredient_id, I.nom AS ingredient_nom, I.image AS ingredient_image, RI.quantite AS recette_ingredient_quantite 
        FROM " . PREFIXE_TABLE ."recette R
        INNER JOIN " . PREFIXE_TABLE ."categorie C ON R.id_categorie=C.id
        INNER JOIN " . PREFIXE_TABLE ."recette_ingredient RI ON R.id=RI.id_recette
        INNER JOIN " . PREFIXE_TABLE ."ingredient I ON RI.id_ingredient=I.id
        WHERE id_categorie = :id_categorie";
        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->execute(array(':id_categorie' => $idCategorie));
        $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);
        $tableau = $pdoStatement->fetchAll();
        $recettes = $this->hydrateMany($tableau);
        return $recettes;

    }

    public function hydrate(array $tableau): Recette{
        $recette = new Recette();
        $recette->setId($tableau[0]['id']);
        $recette->setNom($tableau[0]['nom']);
        $recette->setDescription($tableau[0]['description']);
        $recette->setImage($tableau[0]['image']);

        if (isset($tableau[0]['categorie_id'])){
            $categorie = new Categorie($tableau[0]['categorie_id'], $tableau[0]['categorie_nom'], $tableau[0]['categorie_image']);
           
            $recette->setCategorie($categorie);
        }

        if (isset($tableau[0]['ingredient_id'])){
            $listeIngredientQuantifie = [];
            foreach($tableau as $tableauAssoc){
                $ingredient = new Ingredient($tableauAssoc['ingredient_id'], $tableauAssoc['ingredient_nom'], $tableauAssoc['ingredient_image']);
                $ingredientQuantifie = new IngredientQuantifie($ingredient, $tableauAssoc['recette_ingredient_quantite']);
                $listeIngredientQuantifie[] = $ingredientQuantifie;
            }
            $recette->setIngredientQuantifies($listeIngredientQuantifie);

           
        }
        
        return $recette;
    }


    public function hydrateMany(array $tableau): array{
        $listeRecettes = [];
        $recette = [];
        foreach($tableau as $key=>$tableauAssoc){
            $recette[]=$tableauAssoc;
            if(!isset($tableau[$key+1]) || $tableauAssoc['id'] != $tableau[$key+1]['id']){
                $listeRecettes[] = $this->hydrate($recette);
                $recette = [];
            }
        }

        return $listeRecettes;
    }

    

    /**
     * Get the value of pdo
     */ 
    public function getPdo(): ?PDO
    {
        return $this->pdo;
    }

    /**
     * Set the value of pdo
     *
     */ 
    public function setPdo(?PDO $pdo): void
    {
        $this->pdo = $pdo;

    }
}