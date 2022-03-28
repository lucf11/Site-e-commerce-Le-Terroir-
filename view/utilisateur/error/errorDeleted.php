<?php
	echo "<p> Vous ne pouvez pas supprimer l'utilisateur de login " . htmlspecialchars($login) . " car il n'existe pas. </p>";
	require (File::build_Path(array('view/voiture/list.php'))); // On affiche la vue readAll

  ?>