<?php 

class ControllerRecette extends Controller{
    public function __construct(\Twig\Environment $twig, \Twig\Loader\FilesystemLoader $loader) {
        parent::__construct($twig, $loader);
    }

    public function afficher(){
        echo "afficher recette";
    }

    public function lister(){
        
        $idCategorie = isset($_GET['id_categorie']) ? $_GET['id_categorie'] : null;


        

        //Récupération des recettes
        $managerRecette = new RecetteDao($this->getPdo());

        if ($idCategorie == null) {
            $recettes = $managerRecette->findAll();
        } else {
            $recettes = $managerRecette->findByCategorieWithDetail($idCategorie);
        }

        //Génère la vue
        $template = $this->getTwig()->load('recettes.html.twig');
                
        echo $template->render(array(
            'recettes' => $recettes, 
            'menu' => 'recettes'
        ));
    }
}