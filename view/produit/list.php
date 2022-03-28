<section class="main">
<div class="cards">
            <?php
            foreach ($tab_v as $v){
                $numProduit = $v->getnumProduit();
                $nom = $v->getnomProduit();
                $prix = $v->getPrix();
                $desc = $v->getDescription();
                $img = $v->getLien();
                echo '<div class = "card">';
                echo '<a href="https://webinfo.iutmontp.univ-montp2.fr/~ferrierl/Projet-PHP/controller/index.php?action=read&numProduit='.$numProduit.'">';
                echo '<img src="../img/'.$img.'">';
                echo '<div class ="card-header"';
                echo '<h4 class="title">'.$nom.'</h4>';
                echo '<h4 class="price">'.$prix.'</h4></div>';
                echo '<div class="card-body">';
                echo '<p>'.$desc.'</p>';
                echo '</a>';
                echo '</div> </div>';
            



                // echo "<div class='imgcard'> Produit de numero produit <a href='../controller/routeur.php?action=read&numProduit=$numProduit'>$numProduit</a>";
            }
            ?>
</div>
</section>