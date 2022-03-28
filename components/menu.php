
<nav>
    <h1>Le Terroir</h1>
        <div class="onglets">
                
                <a href="../index.html">Accueil</a>
                <a href="../controller/index.php?action=readAll&controller=panier">Panier</a>
                <a href="../controller/index.php?action=readAll">Nos Produits</a>
                <?php
                
                if(isset($_SESSION['login']) && $_SESSION['permission']==1){
                    echo '<a href="../controller/index.php?action=create&controller=produit">Créer produit</a>';
                }
                if(isset($_SESSION['login'])){
                    echo '<a href="../controller/index.php?action=read&controller=utilisateur">Mon Compte</a>';
                    echo '<a href="../controller/index.php?action=deconnect&controller=utilisateur">Deconnexion</a>';

                }else{
                    echo '<a href="../controller/index.php?action=connect&controller=utilisateur">Connexion</a>';

                }

                
                ?>
                
        </div>
</nav> 