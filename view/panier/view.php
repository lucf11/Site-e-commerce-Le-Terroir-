<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $pagetitle; ?></title>
        <link rel="stylesheet" href="../styles/style.css">
        <link rel="stylesheet" href="../styles/menufooter.css">
        <link rel="stylesheet" href="../styles/panier.css">

    </head>
    <body>
      

        <?php
            require_once '../components/menu.php';

            // Si $controleur='voiture' et $view='list',
            // alors $filepath="/chemin_du_site/view/voiture/list.php"
            $filepath = File::build_path(array("view", $controller, "$view.php"));
            require $filepath;
            require_once '../components/footer.php';
        ?>
   


    </body>
</html>