<?php

    require_once "Model.php";

    class ModelUtilisateur extends Model{
        private $login;
        private $mdp;
        private $email;
        private $nonce;
        private $permission;


        protected static $object = 'p_Utilisateur';
        protected static $primary = 'login';

        public function getLogin(){
            return $this->login;
        }
        

        public function getMDP(){
            return $this->mdp;
        }

        public function setLogin($l){
            $this->login = $l;
        }

       

        public function setMDP($p){
           $this->mdp = $p;
        }
        public function setEmail($e){
            $this->email = $e;
        }
        public function getEmail(){
            return $this->email;
        }

        public function __construct($l = NULL , $mdp = NULL, $email = NULL, $nonce = NULL){
            if (!is_null($l) && !is_null($mdp) && !is_null($email) && !is_null($nonce)){
                $this->login = $l;
                $this->mdp = $mdp;
                $this->email = $email;
                $this->nonce = $nonce;

            }
        }
        public function toArray(){
            $data = array(
                "login" => $this->getLogin(),
                "password" => $this->getMdp(),
                "email" => $this->getEmail(),
            );
            return $data;
        }

    // une methode d'affichage.é
        public static function afficher(){
            echo "<p> L'utilisateur a pour login $this->login , pour email $this->email</p>";

        }

        public function getNonce(){
            return $this->nonce;
        }
        
        public static function checkPassword($login,$password){
            require_once('Model.php');
            
            $sql= "SELECT COUNT(*) FROM p_Utilisateur WHERE login='{$login}' AND password='{$password}' ";
            $req_prep = Model::getPDO()->prepare($sql);
            $req_prep->execute();
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'INT');
            $tab = $req_prep->fetchAll();
            
            if(($tab[0][0]==1)){
                return true;
            }
            else{
                return false;

            }
        }

        public static function checkLogin($login){
            require_once('Model.php');
            
            $sql= "SELECT COUNT(*) FROM p_Utilisateur WHERE login='{$login}' ";
            $req_prep = Model::getPDO()->prepare($sql);
            $req_prep->execute();
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'INT');
            $tab = $req_prep->fetchAll();
            
            if(($tab[0][0]>=1)){
                return false;
            }
            else{
                return true;

            }
        }

        public static function getPermission($login){
            require_once "Model.php";
            $sql = "SELECT permission from p_Utilisateur WHERE login=:nom_tag";
            // Préparation de la requête
            try{
                $req_prep = Model::getPDO()->prepare($sql);
    
                $values = array(
                    "nom_tag" => $login,
                    //nomdutag => valeur, ...
                );
                // On donne les valeurs et on exécute la requête     
                $req_prep->execute($values);
    
                // On récupère les résultats comme précédemment
                $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
                $tab_prod = $req_prep->fetchAll();
            }catch(PDOException $e){
                echo $e->getMessage();
            }
            
    
            // Attention, si il n'y a pas de résultats, on renvoie false
            if (empty($tab_prod))
                return false;
            return $tab_prod[0];
        }

        public function getPerm(){
            return $this->permission;
        } 
        public function setPerm($p){
            $this->permission = $p;
        }

        public static function checkNonce($login,$nonce){
            require_once('Model.php');
            
            $sql= "SELECT COUNT(*) FROM p_Utilisateur WHERE login='{$login}' AND nonce='{$nonce}' ";
            $req_prep = Model::getPDO()->prepare($sql);
            $req_prep->execute();
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'INT');
            $tab = $req_prep->fetchAll();
            
            if(($tab[0][0]==1)){
                return true;
            }
            else{
                return false;

            }
        }

        public static function setNonceNull($login){
            require_once('Model.php');
            
            $sql= "UPDATE p_Utilisateur SET nonce=NULL where login='{$login}' ";
            $req_prep = Model::getPDO()->prepare($sql);
            $req_prep->execute();
        }

        public static function selectAll(){
        require_once "Model.php";
        $rep =  Model::getPDO()->query("SELECT * FROM p_Utilisateur");
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
        $tab_prod = $rep->fetchAll();
        return $tab_prod;   
        }

        public static function select($primary_value) {
            try{
                $primary_key = static::$primary;
                $table_name = static::$object;
                $class_name = 'Model' . ucfirst($table_name);

                $sql = "SELECT * from $table_name WHERE $primary_key=:primary_value";
                $req_prep = Model::getPDO()->prepare($sql);
                $values = array(
                    "primary_value" => $primary_value,
                );   
                $req_prep->execute($values);
                $req_prep->setFetchMode(PDO::FETCH_CLASS, "$class_name");
                $tab = $req_prep->fetchAll();
                // Attention, si il n'y a pas de résultats, on renvoie false
                if (empty($tab))
                    return false;
                return $tab[0];
            } catch (PDOException $e){
                if (Conf::getDebug()){
                    echo $e->getMessage(); // affiche un message d'erreur
                } else {
                    echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
                }
                die();
            }
        }
        public static function update($data){
            try {
                $table_name = static::$object;
                $primary_key = static::$primary;

                $sql = "UPDATE $table_name SET ";
                $values = array();
                foreach ($data as $key => $value) {
                    $sql = $sql . "$key = :$key, ";
                    $values[$key] = $value;
                }
                $sql = rtrim($sql);
                $sql = rtrim($sql, ',');
                $sql = $sql . " ";
                $sql = $sql . "WHERE $primary_key = :primary_value;";
                $values["primary_value"] = $data[$primary_key]; 
                $pdo = Model::getPDO();
                $req_prep = $pdo->prepare($sql);
                $req_prep->execute($values);
            } catch (PDOException $e){
                if (Conf::getDebug()){
                    echo $e->getMessage();
                } else {
                    echo 'Une erreur est survenue <a href="> retour a la page d\'accueil </a>';
                }
                return false;
                die();
            }
            
        }
        public static function delete($primary_value){
            try {
                $primary_key = static::$primary;
                $table_name = static::$object;
                $class_name = 'Model' . ucfirst($table_name);

                $pdo = Model::getPDO();
                $sql = "DELETE FROM $table_name
                        WHERE $primary_key = :primary_value";
                $req_prep = $pdo->prepare($sql);
                $values = array(
                    "primary_value" => $primary_value,
                );
                $req_prep->execute($values);
            } catch (PDOException $e) {
                if (Conf::getDebug()) {
                    echo $e->getMessage(); // affiche un message d'erreur
                } else {
                    echo 'Une erreur est survenue <a href="> retour a la page d\'accueil </a>';
                }
                return false;
                die();
            }
        }
        
        public  function save(){
            require_once 'Model.php';
            //'". str_replace( "'", "''", $s ) ."' 
            $sql = "INSERT INTO p_Utilisateur (login,password,nonce) VALUES('$this->login','$this->mdp','$this->nonce')";
            //echo $sql;
            //die();
            // Préparation de la requête
            try{
                $req_prep = Model::getPDO()->prepare($sql);
                $req_prep->execute();
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        public  function saveAdmin(){
            require_once 'Model.php';
            //'". str_replace( "'", "''", $s ) ."' 
            $sql = "INSERT INTO p_Utilisateur (login,password,permission) VALUES('$this->login','$this->mdp','$this->permission')";
            //echo $sql;
            //die();
            // Préparation de la requête
            try{
                $req_prep = Model::getPDO()->prepare($sql);
                $req_prep->execute();
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
    }

    

    
?>
