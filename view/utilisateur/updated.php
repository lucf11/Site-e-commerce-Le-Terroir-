<?php
    $login = htmlspecialchars($data['login']);
	echo "<p> L'utilisateur ". $login . " a bien été modifié. </p>"; 
	require (File::build_Path(array('view/utilisateur/list.php'))); // On affiche la vue readAll
?>