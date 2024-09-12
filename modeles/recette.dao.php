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

    public function findAllWithDetail(): array{
        //requete
        $sql = "SELECT R.id, R.nom, R.description, R.image, C.id AS categorie_id,  C.nom AS categorie_nom, C.image AS categorie_image
         FROM " . PREFIXE_TABLE ."recette R
        INNER JOIN " . PREFIXE_TABLE ."categorie C ON R.id_categorie=C.id";
        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->execute();
        $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);
        $tableau = $pdoStatement->fetchAll();
        $recettes = $this->hydrateMany($tableau);
        return $recettes;
        

    }

    public function findByCategorie(int $idCategorie): array{
        //requette
        $sql = "SELECT * FROM " . PREFIXE_TABLE ."recette WHERE id_categorie = :id_categorie";
        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->execute(array(':id_categorie' => $idCategorie));
        $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);
        $tableau = $pdoStatement->fetchAll();
        $recettes = $this->hydrateMany($tableau);
        return $recettes;

    }

    public function hydrate(array $tableauAssoc): Recette{
        $recette = new Recette();
        $recette->setId($tableauAssoc['id']);
        $recette->setNom($tableauAssoc['nom']);
        $recette->setDescription($tableauAssoc['description']);
        $recette->setImage($tableauAssoc['image']);

        if (isset($tableauAssoc['categorie_id'])){
            $categorie = new Categorie($tableauAssoc['categorie_id'], $tableauAssoc['categorie_nom'], $tableauAssoc['categorie_image']);
           
            $recette->setCategorie($categorie);
        }
        return $recette;
    }


    public function hydrateMany(array $tableau): array{
        $listeRecettes = [];
        foreach($tableau as $tableauAssoc){
            $listeRecettes[] = $this->hydrate($tableauAssoc);
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