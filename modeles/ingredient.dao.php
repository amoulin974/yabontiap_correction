<?php

class IngredientDao{

    private ?PDO $pdo;

    public function __construct(PDO $pdo=null){
        $this->pdo = $pdo;
    }

    public function find(int $id): Ingredient{
        $sql = "SELECT * FROM " . PREFIXE_TABLE ."ingredient WHERE id = :id";
        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->execute(array(':id' => $id));
        $pdoStatement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Ingredient');
        $ingredient = $pdoStatement->fetch();
        return $ingredient;
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
    public function setPdo($pdo): void
    {
        $this->pdo = $pdo;
    }
}