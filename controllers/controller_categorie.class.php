<?php 

class ControllerCategorie extends Controller{
    public function __construct(\Twig\Environment $twig, \Twig\Loader\FilesystemLoader $loader) {
        parent::__construct($twig, $loader);
    }

    public function afficher(){
        echo "afficher categorie";
    }

    public function lister(){
        echo "lister categorie";
    }
}