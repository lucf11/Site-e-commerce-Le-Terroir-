<?php
	require_once "/home/ann2/ferrierl/public_html/Projet-PHP/lib/File.php";
	$path_array = array("controller/ControllerProduit.php");
	require_once (File::build_Path($path_array));
	$path_array = array("controller/ControllerPanier.php");
	require_once(File::build_Path($path_array));
	$path_array = array("controller/ControllerUtilisateur.php");
	require_once(File::build_Path($path_array));
	$path_array = array("controller/ControllerCommande.php");
	require_once(File::build_Path($path_array));

	if (isset($_GET['action'])){ // On recupère l'action passée dans l'URL
		$action = $_GET['action'];
	} else {
		$action = 'readAll'; // Lorsque l'on arrive sur le site on voit directement la meme page que si on etait sur readAll
	}


	$controller_default = 'produit';
	if(isset($_GET['controller'])){ // On recupère le controleur dans l'URL
		$controller = $_GET['controller'];
	} elseif (isset($_COOKIE['preference'])){
		$controller = $_COOKIE['preference'];
	} else {
		$controller = $controller_default;
	}

	$controller_class = 'Controller'. ucfirst($controller);

	if(class_exists($controller_class)){
		$tab_methode_controller = get_class_methods($controller_class);
		if ((in_array($action, $tab_methode_controller))){
			// Appel de la méthode statique $action du controlleur récupéré dans l'URL
			$controller_class::$action();
		} else {
		
			echo 'erruer';
		}
	} else {
		echo 'erreur';
	}


?>