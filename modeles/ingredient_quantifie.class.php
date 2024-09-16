<?php

class IngredientQuantifie{
    private ?Ingredient $ingredient;
    private ?string $quantite;

    public function __construct(?Ingredient $ingredient = null, ?string $quantite = null){
        $this->ingredient = $ingredient;
        $this->quantite = $quantite;
    }

    

    /**
     * Get the value of ingredient
     */ 
    public function getIngredient(): ?Ingredient
    {
        return $this->ingredient;
    }

    /**
     * Set the value of ingredient
     *
     */ 
    public function setIngredient(?Ingredient $ingredient): void
    {
        $this->ingredient = $ingredient;

    }

    /**
     * Get the value of quantite
     */ 
    public function getQuantite(): ?string
    {
        return $this->quantite;
    }

    /**
     * Set the value of quantite
     *

     */ 
    public function setQuantite(?string $quantite): void
    {
        $this->quantite = $quantite;


    }
}