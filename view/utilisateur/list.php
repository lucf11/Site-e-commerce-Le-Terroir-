<?php
    echo "<p> Voici la liste des différents utilisateurs : </p>";
    $tab_utilisateur = ModelUtilisateur::selectAll();
    foreach ($tab_utilisateur as $utilisateur){
        $login = htmlspecialchars($utilisateur->getLogin());
        $loginEchappe = rawurlencode($utilisateur->getLogin());
        echo "<ul>";
        echo "<li> Utilisateur de login ";
        echo "<a href='index.php?action=read&login=$loginEchappe&controller=utilisateur'>$login</a> ";
        echo "<a href='index.php?action=delete&login=$loginEchappe&controller=utilisateur'>supprimer</a> ";
        echo "<a href='index.php?action=update&login=$loginEchappe&controller=utilisateur'>modifier</a></li>";

        echo "</ul>";
    }
 ?>





