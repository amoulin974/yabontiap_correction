<?php

class Ingredient{

    private int|null $id;
    private string|null $nom;
    private string|null $image;

    public function __construct(?int $id=null, ?string $nom=null, ?string $image=null){
        $this->id = $id;
        $this->nom = $nom;
        $this->image = $image;
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
    public function setId($id): void
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
    public function setNom($nom): void
    {
        $this->nom = $nom;
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
     */ 
    public function setImage($image): void
    {
        $this->image = $image;
    }
}