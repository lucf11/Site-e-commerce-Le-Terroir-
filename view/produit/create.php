<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title> Le formulaire </title>
    </head>
    <body>
        <form method="post" action="routeur.php?action=created">
            <fieldset>
                <legend><u>Formulaire Create :<u></legend>
                <p>
                    <label for="immat_id">nomProduit</label> :
                    <input type="text" placeholder="" name="nomProduit" id="nomProduit" required/>
                </p>
                <p>
                    <label for="marque_id">idCategorie</label> :
                    <input type="text" placeholder="" name="idCategorie" id="idCategorie" required/>
                </p>
                <p>
                    <label for="couleur_id">numProduit</label> :
                    <input type="text" placeholder="" name="numProduit" id="numProduit" required/>
                </p>
                <p>
                    <label for="couleur_id">prix</label> :
                    <input type="text" placeholder="" name="prix" id="prix" required/>
                </p>
                <p>
                    <label for="couleur_id">description</label> :
                    <input type="text" placeholder="" name="description" id="description" required/>
                </p>
                <p>
                <label for="image">Importer une image du produit:</label>

                <input type="file"
                        id="image" name="image"
                        accept="image/png, image/jpeg">
                </p>
                <p>
                    <input type="submit" value="Envoyer" />
                </p>
            </fieldset>
        </form>
    </body>