<?php

class Recette{

    private null|int $id;
    private null|string $nom;
    private null|string $description;
    private null|string $image;
    private null|Categorie $categorie;

    public function __construct(?int $id = null, ?string $nom = null, ?string $description = null, ?string $image = null, ?Categorie $categorie = null){
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->image = $image;
        $this->categorie = $categorie;
    }

    

    /**
     * Get the value of id
     */ 
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     */ 
    public function setId(?int $id):void
    {
        $this->id = $id;

    }

    /**
     * Get the value of nom
     */ 
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     */ 
    public function setNom(?string $nom):void
    {
        $this->nom = $nom;

    }

    /**
     * Get the value of description
     */ 
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     */ 
    public function setDescription(?string $description):void
    {
        $this->description = $description;

    }

    /**
     * Get the value of image
     */ 
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage(?string $image): void
    {
        $this->image = $image;

    }

    /**
     * Get the value of categorie
     */ 
    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    /**
     * Set the value of categorie
     *
     */ 
    public function setCategorie(?Categorie $categorie): void
    {
        $this->categorie = $categorie;

    }
}