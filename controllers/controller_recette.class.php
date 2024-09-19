<?php 

class ControllerRecette extends Controller{
    public function __construct(\Twig\Environment $twig, \Twig\Loader\FilesystemLoader $loader) {
        parent::__construct($twig, $loader);
    }

    public function afficher(){
        $id_recette = isset($_GET['id_recette'])?$_GET['id_recette']:null;



        //Recupere les recettes à l'aide de la méthode findWithDetail() de RecetteDao
        $managerRecette = new RecetteDao($this->getPdo());
        $recette = $managerRecette->findWithDetail($id_recette);

        //Génération de la vue
        $template = $this->getTwig()->load('recette.html.twig');

        echo $template->render(array(
            'recette' => $recette,
            'menu' => 'recettes'
        ));
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

    public function listerTableau(){
        $managerRecette = new RecetteDao($this->getPdo());
        $recettes = $managerRecette->findAllWithDetail();




        //Générer la vue
        $template = $this->getTwig()->load('recettes_tableau.html.twig');

        echo $template->render(array(
            'recettes' => $recettes,
            'menu' => 'recettes_tableau'

        ));
    }
}