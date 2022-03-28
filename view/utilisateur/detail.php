<?php

    $login = $utilisateur[1];
    $email = $utilisateur[3];
    $loginEchappe = $login;
    
    echo '<h2>Mon Compte</h2>';
    echo "<p>" . htmlspecialchars($login) ." a pour email ".htmlspecialchars($email) ." . </p>";
    echo "<a href='index.php?action=readAllUtil&controller=commande'>Voir l'historique de vos commandes</a>";
    echo "<p> <a href='index.php?action=delete&login=$loginEchappe&controller=utilisateur'>Supprimer mon compte</a> <br>";
    echo "<a href='index.php?action=update&login=$loginEchappe&controller=utilisateur'>modifier Mot de passe </a> </p>";

?>