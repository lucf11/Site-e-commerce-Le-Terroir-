<section class="commande_main">
<div class="commandes">
            <?php
                if(!isset($_SESSION['login'])){
                    echo 'Vous n\'êtes pas connecté, connectez vous :';
                    echo '<a href="../controller/index.php?action=connect&controller=utilisateur"> Connectez-vous </a>';
                  }
                else{

                    foreach($tab_commandes  as $c){

                        $num = $c[0];
                        $mt = $c[1];
                        echo 'Numéro de commande : ' . $num . ' montant totale : '. $mt;
                        echo '<br>';
                    }
                    
                }
               
    
            ?>
</div>
</section>