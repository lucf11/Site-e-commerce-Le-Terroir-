<form action="../script/toPDF.php" method="POST">
<fieldset>
                <legend><u>Formulaire facture  :<u></legend>
                <p>
                    <label for="livraison_id">Adresse livraison</label> :
                    <input type="text" placeholder="" name="livraison" id="livraison" required/>
                </p>
                <p>
                    <label for="facture_id">Adresse facturation</label> :
                    <input type="text" placeholder="" name="facturation" id="facturation" required/>
                </p>
                <p>
                    <label for="nom_id">Nom</label> :
                    <input type="text" placeholder="" name="nom" id="nom" required/>
                </p>
                <p>
                    <label for="prenom_id">Prenom</label> :
                    <input type="text" placeholder="" name="prenom" id="prenom" required/>
                </p>
                <p>
                    <input type="submit" value="Envoyer" />
                </p>
</fieldset>
</form>