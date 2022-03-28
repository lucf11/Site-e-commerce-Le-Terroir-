<?php
    $login = htmlspecialchars($utilisateur->getLogin());
    echo "<p> L'utilisateur de login " . $login . " a bien été ajouté. </p>";
    require (File::build_Path(array('view/utilisateur/list.php'))); // On affiche la vue readAll
?>