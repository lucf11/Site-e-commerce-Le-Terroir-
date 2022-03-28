<html>
    <head>
       <meta charset="utf-8">
        
    </head>
    <body>
        <div id="container">
            <!-- zone de connexion -->
            
            <form action="index.php?action=connected&controller=utilisateur" method="POST">
                <h1>Connexion</h1>
                
                <label><b>Login</b></label>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="login" required>

                <label><b>Password</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="mdp" required>

                <input type="submit" id='submit' value='LOGIN' >
               <br>
                <a href="index.php?action=create&controller=utilisateur"> Si vous êtes pas inscrit, cliquez ici</a>
            </form>
        </div>
    </body>
</html>