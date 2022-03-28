<?php

class ModelProduit {


    private $numProduit;
    private $nomProduit;
    private $idCategorie;
    private $prix;
    private $description;
    private $lien;

    // un getter      
    public function getnumProduit() {
        return $this->numProduit;
    }

    public function getLien() {
        return $this->lien;
    }


    // un setter 
    public function setPrix($m) {
        $this->prix = $m;
    }
    public function getnomProduit(){
        return $this->nomProduit;
    }
    public function setdescription($c){
        if(strlen($c)<=30){
            $this->description = $c;
        }
    }
    public function getDescription(){
        return $this->description;
    }
    public function getPrix(){
        return $this->prix;
    }
    public static function getProduitBynum($nume) {
        require_once "Model.php";
        $sql = "SELECT * from p_Produit WHERE numProduit=:nom_tag";
        // Préparation de la requête
        try{
            $req_prep = Model::getPDO()->prepare($sql);

            $values = array(
                "nom_tag" => $nume,
                //nomdutag => valeur, ...
            );
            // On donne les valeurs et on exécute la requête     
            $req_prep->execute($values);

            // On récupère les résultats comme précédemment
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelProduit');
            $tab_prod = $req_prep->fetchAll();
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        // Attention, si il n'y a pas de résultats, on renvoie false
        if (empty($tab_prod))
            return false;
        return $tab_prod[0];
    }
    public  function save(){
        require_once 'Model.php';
        //'". str_replace( "'", "''", $s ) ."' 
        $sql = "INSERT INTO p_Produit(nomProduit, idCategorie, numProduit, prix, description)VALUES('$this->nomProduit','$this->idCategorie','$this->numProduit' ,'$this->prix','$this->description')";
        //echo $sql;
        //die();
        // Préparation de la requête
        try{
            $req_prep = Model::getPDO()->prepare($sql);

            $values = array(
                "nomProduit" => $this->nomProduit,
                "idCategorie" => $this->idCategorie,
                "numProduit" => $this->numProduit,
                "prix" => $this->prix,
                "description" => $this->description
            //nomdutag => valeur, ...
            );

            $req_prep->execute($values);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }


    public static function getAllProduits(){
        require_once "Model.php";
        $rep =  Model::getPDO()->query("SELECT * FROM p_Produit");
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelProduit');
        $tab_prod = $rep->fetchAll();
        return $tab_prod;    }

    // un constructeur
    public function __construct($nume = NULL, $prix = NULL, $id = NULL , $nom=NULL,$desc=NULL) {
        if(!is_null($nume)&& !is_null($prix)&& !is_null($id) && !is_null($nom) && !is_null($desc)){
            $this->numProduit = $nume;
            $this->prix = $prix;
            $this->idCategorie= $id;
            $this->nomProduit = $nom;
            $this->description = $desc;
        }
    } 

    // une methode d'affichage.
    /*public function afficher() {
      echo $this->marque;
  }*/
}
?>

