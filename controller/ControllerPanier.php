<?php
  require_once "/home/ann2/ferrierl/public_html/Projet-PHP/lib/File.php";
    $model_path_array = array('model/ModelPanier.php');
    require_once File::build_Path($model_path_array); 
    $model_path_array = array('model/ModelProduit.php');
    require_once File::build_Path($model_path_array); 
    $model_path_array = array('model/ModelCommande.php');
    require_once File::build_Path($model_path_array); 

    // chargement du modèle
class ControllerPanier {

     public static function readAll() {
        $tab_v = ModelPanier::getAllProduitsPanier();     //appel au modèle pour gerer la BD
        $controller='panier';
        $view='list';
        $pagetitle='Liste des produits du panier';
        $filepath = File::build_path(array("view",$controller, "view.php"));
        require ($filepath);  //"redirige" vers la vue

    }

    public static function supprimer(){
        ModelPanier::viderPanier();
        ControllerProduit::readAll();
    }
   
    public static function supprimerArticle(){
        $idArticle = $_GET['idArticle'];
        ModelPanier::viderArticle($idArticle);
        self::readAll();    
    }
 

    public static function ajouterAuPanier(){
        $tab_v = ModelProduit::getAllProduits();  
        $id = $_GET['id'];
        $produit = ModelProduit::getProduitBynum($id);
        $prix = $produit->getPrix();
        ModelPanier::ajouterArticle($id, $prix);
        $controller = 'panier';
        $view = 'list';
        $pagetitle = 'Liste des produits';    
        $filepath = File::build_path(array("view",$controller, "view.php"));
        // echo '<pre>';
        // var_dump($_SESSION);
        // die();

        //require ($filepath);  //"redirige" vers la vue
        header("Location:../controller/index.php?action=readAll");
    }

    public static function commander(){
        
        ModelPanier::commanderPanier();
        if(isset($_SESSION['login']) && isset($_SESSION['Panier'])){
            $idPanier = ModelPanier::getId();
            $mt = ModelPanier::getmontantTotal();
           
            ModelCommande::ajouterAHistorique((int)$idPanier[0][0],$mt);
            // echo 'caca';

        }
        $controller = 'panier';
        $view = 'facture';
        $pagetitle = 'Liste des produits';    
        $filepath = File::build_path(array("view",$controller, "view.php"));
        require($filepath);
    }
}
?>