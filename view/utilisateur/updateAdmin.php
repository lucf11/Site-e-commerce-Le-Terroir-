
        <form method="POST" action="index.php?action=createdAdmin&controller=utilisateur">
            <fieldset>
                <legend><u>Formulaire Create :<u></legend>
                <p>
                    <label for="immat_id">login</label> :
                    <input type="text" placeholder="" name="login" id="login" required/>
                </p>
                <p>
                    <label for="immat_id">password</label> :
                    <input type="password" placeholder="" name="password" id="password" required/>
                </p> 
                <p>
                    <label for="immat_id">email</label> :
                    <input type="email" placeholder="" name="email" id="email" required/>
                </p> 
                <p>
                    <input type="submit" value="Envoyer" />
                </p>
            </fieldset>
       