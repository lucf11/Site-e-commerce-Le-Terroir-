
<div class="card_detail">
    <?php
        $res = htmlspecialchars($v->getnomProduit());
        $res1 = htmlspecialchars($v->getPrix());
        $res2 = htmlspecialchars($v->getDescription());
        $id = htmlspecialchars($v->getnumProduit());
        $img = htmlspecialchars($v->getLien());

        echo '<img src="../img/'.$img.'">';
        echo '<div class="container_detail">';
        echo '<div class="name"> Produit : ' . $res . '.</div>';
        echo '<div class="prixProduit">Proposé au prix de : ' . $res1 . '.</div>';
        echo '<div class="descProduit">Description : '  . $res2 . '.</div>';
        echo '<button><a href="../controller/index.php?action=ajouterAuPanier&controller=panier&id='.$id.'">Ajouter au panier</a></button>';
        echo '</div>';
    ?>

</div>

     
     