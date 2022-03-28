<?php

    echo "<p> L'utilisateur de login " . htmlspecialchars($login) . " a bien été supprimée. </p>";
    require (File::build_Path(array('view/utilisateur/list.php'))); // On affiche la vue readAll
?>
