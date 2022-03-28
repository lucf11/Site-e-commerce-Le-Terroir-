<?php
    require_once "../lib/File.php";
    require_once "../lib/Security.php";
    $model_path_array = array('model/ModelUtilisateur.php');
    require_once File::build_Path($model_path_array); // chargement du modèle

    class ControllerUtilisateur{

        protected static $object = 'utilisateur';

        public static function readAll() {
            $tab_v = ModelUtilisateur::selectAll();     //appel au modèle pour gerer la BD
            $controller='utilisateur';
            $view='list';
            $pagetitle='Liste des utilisateurs';
            $filepath = File::build_path(array("view",$controller, "view.php"));
            require ($filepath);  //"redirige" vers la vue
        }
    
     

        public static function read(){
            $utilisateur = ModelUtilisateur::select($_SESSION['login']);

            if ($utilisateur === false){
                $view = 'error/errorDetail';
                $pagetitle = "Error sur detail de l'utilisateur";
                $controller = 'utilisateur';
                $filepath = File::build_path(array("view",$controller, "view.php"));
                require ($filepath);
            } else {
                $view = 'detail';
                $pagetitle = "Détails de l'utilisateur";
                $controller = 'utilisateur';
                $filepath = File::build_path(array("view",$controller, "view.php"));
                require ($filepath);
            }
        }

        public static function create(){ // Creation d'un utilisateur
            $view = 'update';
            $pagetitle  = 'Creation dun utilisateur';
            $controller = 'utilisateur';
            $filepath = File::build_path(array("view",$controller, "view.php"));
            require ($filepath);  //"redirige" vers la vue
        }
        public static function createAdmin(){ // Creation d'un utilisateur
            $view = 'updateAdmin';
            $pagetitle  = 'Creation dun admin';
            $controller = 'utilisateur';
            $filepath = File::build_path(array("view",$controller, "view.php"));
            require ($filepath);  //"redirige" vers la vue
        }

        public static function createdAdmin(){ // Utilisateur créé
            $mdp1 = $_POST['password'];
            $mdp = Security::hacher($mdp1);
            $data = array(
                "login" => $_POST['login'],
                "password" => $mdp,
                "email" =>$_POST['email']
            );
            $utilisateur = new ModelUtilisateur();
            $utilisateur->setMDP($mdp);
            $utilisateur->setLogin($data['login']);
            $utilisateur->setEmail($data['email']);
            $utilisateur->setPerm(1);
            $utilisateur->saveAdmin();
            ControllerUtilisateur::readAll();
        }
        public static function created(){ // Utilisateur créé
            $mdp1 = $_POST['mdp'];
            $mdp = Security::hacher($mdp1);
            $confmdp = $_POST['confmdp'];
            $confmdp1 = Security::hacher($confmdp);
            $data = array(
                "login" => $_POST['login'],
                "password" => $mdp,
                "email" =>$_POST['email']
            );
          
            $veriflogin = ModelUtilisateur::checkLogin($data['login']);

            
            if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                header("Location:../controller/index.php?action=create&controller=utilisateur&login=".$_POST['login']."&email=".$_POST['email']);
                
            }
            else{
                $nonce = Security::generateRandomHex();
                $utilisateur = new ModelUtilisateur($data['login'],$data['password'],$data['email'],$nonce);
                $test = $utilisateur->save();
                $mail = '<p>Valiidez votre compte : </p><a href="https://webinfo.iutmontp.univ-montp2.fr/~ferrierl/Projet-PHP/controller/index.php?action=validated&controller=utilisateur&login='.$data['login'].'&nonce='.$nonce.'">Cliquez</a>';
                mail('bob@yopmail.com', 'Validation compte', $mail);
                if ($test === false || $veriflogin == false){
                    $view = 'error/errorCreated';
                    $pagetitle = "Erreur création d'un utilisateur";
                    $controller = 'utilisateur';
                    $filepath = File::build_path(array("view",$controller, "view.php"));
                    require ($filepath);

                }
                elseif($mdp != $confmdp1){
                    header("Location:../controller/index.php?action=create&controller=utilisateur&index=1&login=".$_POST['login']."&email=".$_POST['email']);
                }
                else{
                    ControllerProduit::readAll();
                }
            
            }
        }

        public static function update(){ // Mise a jour d'un utilisateur
            $login=$_GET['login'];
            $utilisateur = ModelUtilisateur::select($login);
            if ($utilisateur === false){
                $view = 'error/errorUpdate';
                $pagetitle = "Erreur creation formulaire de modification d'un utilisateur";
                $controller = 'utilisateur';
                $filepath = File::build_path(array("view",$controller, "view.php"));
                require ($filepath);
            } else {
                $view = 'update';
                $pagetitle = "Modification d'un utilsateur";
                $controller = 'utilisateur';
                $filepath = File::build_path(array("view",$controller, "view.php"));
                require ($filepath);
            }
        }

        public static function updated(){ // On a mis a jour un utilisateur
            $login = $_POST['login'];
            $mdp1 = $_POST['mdp'];
            $mdp = Security::hacher($mdp1);
    

            //$hash = hacher($mdp);
            $data = array(
                'login' => $login,
                'password' => $mdp

            );

            $test = ModelUtilisateur::update($data);
            if ($test === false){
                $view = 'error/errorUpdated';
                $pagetitle = "Erreur modification d'un utilisateur";
                $controller = 'utilisateur';
                $filepath = File::build_path(array("view",$controller, "view.php"));
                require ($filepath);

            } else {
                $view = 'updated';
                $pagetitle = 'Utilisateur modifié';
                $controller = 'utilisateur';
                $filepath = File::build_path(array("view",$controller, "view.php"));
                require ($filepath);
                
            }
        }

        public static function delete(){
            $login = $_GET['login'];
            $test = ModelUtilisateur::delete($login);
            if ($test === false){
                $view = 'error/errorDeleted';
                $pagetitle = "Erreur suppression d'un utilisateur";
                $controller = 'utilisateur';
                $filepath = File::build_path(array("view",$controller, "view.php"));
                require ($filepath);
            } else {
                $view = 'deleted';
                $pagetitle = "Suppression d'un utilisateur";
                $controller = 'utilisateur';
                $filepath = File::build_path(array("view",$controller, "view.php"));
                require ($filepath);
            }
        }

        public static function error(){ // Erreur de base
            $view = 'error';
            $pagetitle = "Page d'erreur";
            $controller = 'utilisateur';
            $filepath = File::build_path(array("view",$controller, "view.php"));
            require ($filepath);
        }
        public static function connect(){
            $view = 'connect';
            $pagetitle = 'page de connexion';
            $controller = 'utilisateur';
            $filepath = File::build_path(array("view",$controller, "view.php"));
            require ($filepath);
        }

        public static function validated(){
            $login = $_GET['login'];
            $nonce = $_GET['nonce'];
            if(ModelUtilisateur::checkNonce($login,$nonce)){
                ModelUtilisateur::setNonceNull($login);
            }

        }
        public static function connected(){
            $login=$_POST['login'];
            $mdp1 = $_POST['mdp'];
            $mdp = Security::hacher($mdp1);
            $verif = ModelUtilisateur::checkPassword($login,$mdp);
            $utilisateur = ModelUtilisateur::select($login);
            $nonce = $utilisateur[8];
            
            if($verif){
                $_SESSION['login'] = $login;
                $util = ModelUtilisateur::getPermission($login);
                $_SESSION['permission'] = $util->getPerm();
                // $view = 'detail';
                // $pagetitle = "connecte";
                // $controller = 'utilisateur';
                // $filepath = File::build_path(array("view",$controller, "view.php"));
                // require ($filepath);
                ControllerProduit::readAll();

            }
            else{
                $view = 'error/errorDetail';
                $pagetitle = "Erreur";
                $controller = 'utilisateur';
                $filepath = File::build_path(array("view",$controller, "view.php"));
                require ($filepath);
            }


        }
        public static function deconnect(){
            session_destroy();
            $view = 'deconnect';
            $pagetitle = "index";
            $controller = 'utilisateur';
            $filepath = File::build_path(array("view",$controller, "view.php"));
            require ($filepath);

        }

    }



?>