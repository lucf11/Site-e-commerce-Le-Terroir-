<?php

class ModelPanier {


    private $montantTotal;
    private $date;
    private $idPanier;

    //getters
    public static function getmontantTotal() {
        $compteur = 0;
        foreach($_SESSION['Panier'] as $p){
            $compteur = $compteur + (int)$p['prix'];
        }
        return $compteur;
    }

    
    public function getDate() {
        return $this->date;
    }
    public function getidPanier(){
        return $this->idPanier;
    }
    
    public static function getId(){
        require_once "Model.php";
        $id = "SELECT MAX(idPanier) FROM p_Panier ";
        // Préparation de la requête
        try{
            $req_prep = Model::getPDO()->prepare($id);

            // On donne les valeurs et on exécute la requête     
            $req_prep->execute();
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'int');
            $tab_prod = $req_prep->fetchAll();

        }catch(PDOException $e){
            echo $e->getMessage();
        }
        return $tab_prod;
       
    }

    //setters
    public function setmontantTotal($m) {
        $this->montantTotal = $m;
    }
    public function setdate($d) {
        $this->date = $m;
    }
    public function setidPanier($m) {
        $this->idPanier = $m;
    }

    // un constructeur
    public function __construct($montant = NULL, $date = NULL) {
        if(!is_null($montant)&& !is_null($date)){
            $this->montantTotal = $montant;
            $this->date= $date;
        }
    }

    //fonctions diverses 

    public  function save(){
        require_once 'Model.php';
        //'". str_replace( "'", "''", $s ) ."' 
        $sql = "INSERT INTO p_Panier VALUES('$this->idPanier','$this->date','$this->montantTotal')";
        //echo $sql;
        //die();
        // Préparation de la requête
        try{
            $req_prep = Model::getPDO()->prepare($sql);

            $values = array(
                "idPanier" => $this->idPanier,
                "date" => $this->date,
                "montantTotal" => $this->montantTotal
            );

            $req_prep->execute($values);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    


    //retourne tous les idProduits qui sont dans le panier
    public static function getAllProduitsPanier(){
        // require_once "Model.php";
        // $sql ="SELECT * FROM p_Produit WHERE numProduit IN(SELECT idProduit FROM p_ligneProduit pl JOIN p_Panier pa ON pa.idPanier = pl.idPanier WHERE pa.idPanier={$idp})";
        // // Préparation de la requête
        // try{
        //     $req_prep = Model::getPDO()->prepare($sql);

        //     $values = array(
        //         "nom_tag" => $idp,
        //         //nomdutag => valeur, ...
        //     );
        //     // On donne les valeurs et on exécute la requête     
        //     $req_prep->execute($values);

        //     // On récupère les résultats comme précédemment
        //     $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelProduit');
        //     $tab_prod = $req_prep->fetchAll();
        // }catch(PDOException $e){
        //     echo $e->getMessage();
        // }
        // // Attention, si il n'y a pas de résultats, on renvoie false
        // if (empty($tab_prod))
        //     return false;
        // return $tab_prod;
        if(!isset($_SESSION['Panier'])){
            return;
        }
        else{
            return $_SESSION['Panier'];
        }
    }



    public static function ajouterArticle($idProduit, $prix){
        if(!isset($_SESSION['Panier'])){
            $_SESSION['Panier'] = array();
        }


        $tab_infosProduits = array(
            "idProduit" => $idProduit,
            "prix" => $prix
        );
        array_push($_SESSION['Panier'],$tab_infosProduits);

    }

    public static function commanderPanier(){
        require_once "Model.php";
        $mt = self::getmontantTotal();
        $sql ="INSERT INTO p_Panier (montantTotal) VALUES({$mt})";
        $id = "SELECT MAX(idPanier) FROM p_Panier ";
       
        
        
        // Préparation de la requête
        try{
            $req_prep = Model::getPDO()->prepare($sql);

            // On donne les valeurs et on exécute la requête     
            $req_prep->execute();
        }catch(PDOException $e){
            echo $e->getMessage();
        }

        // Préparation de la requête
        try{
            $req_prep = Model::getPDO()->prepare($id);

            // On donne les valeurs et on exécute la requête     
            $req_prep->execute();
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'int');
            $tab_prod = $req_prep->fetchAll();

        }catch(PDOException $e){
            echo $e->getMessage();
        }

        foreach($_SESSION['Panier'] as $p){
            $v = $p['idProduit'];
            $sql ="INSERT INTO p_ligneProduit VALUES('{$v}','{$tab_prod[0][0]}',1)";
            // Préparation de la requête
            try{
                $req_prep = Model::getPDO()->prepare($sql);

                // On donne les valeurs et on exécute la requête     
                $req_prep->execute();
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        

        
    
    }
    public static function viderPanier(){
        unset($_SESSION['Panier']);
    }
    public static function viderArticle($id){
        $prod = ModelProduit::getProduitBynum($id);
        $tableau = array(
            "idProduit" => $id,
            "prix" => $prod->getPrix()
        );
        $tab = $_SESSION['Panier'];
        unset($_SESSION['Panier'][array_search($tableau, $tab)]);
    }
}

?>

    