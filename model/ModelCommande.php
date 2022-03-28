<?php

class ModelCommande {


    private $numCommande;
    private $montantCommande;
    private $idUtil;
    private $idPanier;

    //getters
    public static function getnumCommande() {
        return $this->numCommande;
    }
    public static function getmontantCommande() {
        return $this->montantCommande;
    }
    public static function getidUtil() {
        return $this->idUtil;
    }
    public static function getidPanier() {
        return $this->idPanier;
    }

    // un constructeur
    public function __construct($num = NULL, $mt = NULL , $id = NULL , $idP = NULL) {
        if(!is_null($num)&& !is_null($mt) && !is_null($id)&&!is_null($idP)){
            $this->numCommande = $num;
            $this->montantCommande= $mt;
            $this->idUtil = $id;
            $this->idPanier = $idP;
        }
    }

    public static function ajouterAHistorique($idPanier,$mt){
        $idUtil = $_SESSION['login'];
        $sql = "INSERT INTO p_Commande(montantCommande, login, idPanier) VALUES({$mt},'{$idUtil}',{$idPanier})";
        // Préparation de la requête
        try{
            $req_prep = Model::getPDO()->prepare($sql);
            $req_prep->execute();
        }catch(PDOException $e){
            echo $e->getMessage();
        }

    }

    public static function getAllCommandes(){//méthode pour les admins
        require_once "Model.php";
        $rep =  Model::getPDO()->query("SELECT * FROM p_Commande");
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelCommande');
        $tab_prod = $rep->fetchAll();
        return $tab_prod;
    }

    public static function getAllCommandesByUtil($id){
        // var_dump($id);
        // die();
        $sql = "SELECT * FROM p_Commande WHERE login='{$id}'";
        // Préparation de la requête
        try{
            $req_prep = Model::getPDO()->prepare($sql);
            $req_prep->execute();
            $tab_commandes = $req_prep->fetchAll();
        }catch(PDOException $e){
            echo $e->getMessage();
        }

        if(empty($tab_commandes)){
            return;
        }
        else{
            return $tab_commandes;

        }
       
       
    }
    public static function getCommandeByNum($num){
        $sql = "SELECT * FROM p_Commande WHERE numCommande={$num}";
        // Préparation de la requête
        try{
            $req_prep = Model::getPDO()->prepare($sql);
            $req_prep->execute();
            $commande = $req_prep->fetchAll();
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        return $commande;
    }
}
?>