<?php 

  require_once "/home/ann2/ferrierl/public_html/Projet-PHP/lib/File.php";
    $model_path_array = array('model/ModelCommande.php');
    require_once File::build_Path($model_path_array); 

class ControllerCommande {

    public static function readAll(){
        $tab_commandes = ModelCommande::getAllCommandes();     //affichage des commandes pour un admin
        $controller='commande';
        $view='list';
        $pagetitle='Liste des commandes';
        $filepath = File::build_path(array("view",$controller, "view.php"));
        require ($filepath);
    }

    public static function readAllUtil(){
        $tab_commandes = ModelCommande::getAllCommandesByUtil($_SESSION['login']);     //affichage des commandes d'un util
        if(empty($tab_commandes)){
            $controller='commande';
            $view='error';
            $pagetitle='Liste des commandes';
            $filepath = File::build_path(array("view",$controller, "view.php"));
            require ($filepath);
        }
        else{
            $controller='commande';
            $view='list';
            $pagetitle='Liste des commandes';
            $filepath = File::build_path(array("view",$controller, "view.php"));
            require ($filepath);
        }
    }

    public static function read(){
        $commande = ModelCommande::getAllCommandesByNum($_GET['numCommande']);     //affichage des détails d'une commande d'un util
        $controller='commande';
        $view='detail';
        $pagetitle='Détail de la commande';
        $filepath = File::build_path(array("view",$controller, "view.php"));
        require ($filepath);

    }
}
?>