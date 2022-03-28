<section class="main_panier">
<div class="list_panier">
            <?php
                if(!isset($_SESSION['Panier'])){
                    echo 'votre panier est vide';
                }
                else{

                    foreach($tab_v as $v){
                        echo '<div class="contain">';
                        $p = ModelProduit::getProduitBynum($v['idProduit']);
                        $res = htmlspecialchars($p->getnomProduit());
                        $res1 = htmlspecialchars($p->getPrix());
                        $res2 = htmlspecialchars($p->getDescription());
                        $id = htmlspecialchars($p->getnumProduit());
                        $img = htmlspecialchars($p->getLien());

                    
                        echo '<img src="../img/'.$img.'">';
                        echo '<div class="descContain">';
                        echo  '<div class="name"> Produit : ' . $res . '.</div>';
                        echo '<div class="prixProduit">Proposé au prix de : ' . $res1 . '.</div>';
                        echo  '<div class="descProduit">Description : '  . $res2 . '.</div>';
                        echo '</div>';

                        echo '<button><a class="suppr" href="index.php?action=supprimerArticle&controller=panier&idArticle='.$id.'">Supprimer l\'article</a></button>';
                        echo '</div>';
                        
                    }
                     $mt = ModelPanier::getmontantTotal();
                    echo '<div class="montant">';
                    echo 'Montant du panier :'.$mt;
                    echo '</div>';
                    echo'<div class ="bouton">';

                    echo '<button><a href="index.php?action=supprimer&controller=panier">Supprimer tous les articles</a></button>';
                     echo '<button class="command"><a href="../controller/index.php?action=commander&controller=panier"> Commander </a></button>';
                     echo'</div>';
                }
               
               
            // echo'<pre>';
            // // var_dump($tab_v);
            // foreach($tab_v as $v){
            //     var_dump($v);
            // }
            ?>
</div>
</section>