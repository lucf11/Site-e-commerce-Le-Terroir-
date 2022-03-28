<section class="commande_detail">
<div class="commande">
            <?php
                if(!isset($_SESSION['login'])){
                    echo 'Vous n\'êtes pas connecté, connectez vous :';
                    echo '<a href="../controller/index.php?action=connect&controller=utilisateur"> Connectez-vous </a>';
                  }
                else{

                    foreach($tab_commandes  as $c){
                        $num = $c->getnumCommande();
                        $mt = $c->getmontantCommande();
                        echo 'Numéro de commande : ' . $num . ' montant totale : '. $mt;
                    }
                    
                }
               
    
            ?>
</div>
</section>