<?php
require_once ('../model/ModelProduit.php'); // chargement du modèle
class ControllerProduit {
    public static function readAll() {
        $tab_v = ModelProduit::getAllProduits();     //appel au modèle pour gerer la BD
        $controller='produit';
        $view='list';
        $pagetitle='Liste des produits';
        $filepath = File::build_path(array("view",$controller, "view.php"));
        require ($filepath);  //"redirige" vers la vue

    }

    
    public static function read(){
    	$numProduit = $_GET['numProduit'];
    	$v = ModelProduit::getProduitBynum($numProduit);//appel au modèle pour gerer la BD
        $controller='produit';
    	if($v == false){
            $view = 'error';
            $pagetitle = 'Produit inconnu';
    		require ('../view/produit/view.php');//redirige vers la vue de produit non reconnu 
    	}else{
            $view = 'detail';
            $pagetitle = 'Détail du Produit';    
            $filepath = File::build_path(array("view",$controller, "view.php"));
            require ($filepath);  //"redirige" vers la vue
    	}
    } 
    public static function create(){
        $view = 'create';
        $pagetitle  = 'Creation dun produit';
        $controller = 'produit';
        $filepath = File::build_path(array("view",$controller, "view.php"));
        require ($filepath);  //"redirige" vers la vue
    }
    //à faire pour la prochaine fois
    public static function created(){
    	$numProduit = $_POST['numProduit'];
    	$nomProduit = $_POST['nomProduit'];
    	$idCategorie = $_POST['idCategorie'];
    	$prix = $_POST['prix'];
    	$description = $_POST['description'];
    	$produit = new ModelProduit($numProduit,$nomProduit,$idCategorie,$prix,$description);
    	$produit->save();
    	ControllerProduit::readAll();
        require_once '../view/produit/created.php';//il faudrait en théorie utiliser la méthode File::build_path() mais j'ai la flemme 
        require_once '../view/produit/list.php';
    }
}
?>
   