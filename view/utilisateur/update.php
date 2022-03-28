

<form method="post"
    
    <?php
        $controller = static::$object;
        $action = $_GET['action'];
        if ($action === 'create'){
    ?>

     action='index.php?action=created&controller=<?php echo"$controller";?>'

    <?php
        } else if ($action === 'update'){
    ?>

    action='index.php?action=updated&controller=<?php echo"$controller";?>'

    <?php
        }
    ?>
 
    >
        <fieldset>

            <p>
                <?php
                    $action = $_GET['action'];
                    if ($action === 'create'){
                ?>
                   <legend>Inscription</legend>
                <label for="login_id">Login</label> :
                <input type="text" name="login" id="login_id" value="<?php if (isset($_GET['login'])){ echo $_GET['login']; } ?>" required/>

                 <label for="login_id">mdp</label> :
                <input type="password"name="mdp" id="login_id" required/>

                <label for="login_id">confirmer mdp</label> :
                <input type="password"name="confmdp" id="login_id" required/>
                

                <label for="login_id">email</label> :
                <input type="email"name="email" id="login_id" value="<?php if (isset($_GET['email'])){ echo $_GET['email']; } ?>" required/>

                <?php 
                   
                    if(isset($_GET['index'])){
                        echo '<p>Les mots de passe ne sont pas les mêmes</p>';
                    }
                    else if (isset($_GET['email'])){
                    echo '<p>Adresse email non-valide</p>';
                    }
                 ?>
                <?php
                    } else if ($action === 'update'){

                        $login = htmlspecialchars($utilisateur["login"]);
                        
                       

                ?>
                  <legend>Modification du compte</legend>

                <label for="login_id">Login</label> :
                <input type="text" value=<?php echo"$login";?> name="login" id="login_id" readonly/>

                <label for="mdp id">nouveau mdp</label>
                <input type="password"name="mdp" id="mdp_id" required/>

                


                
 

                <?php
                    }
                ?>
            </p>
            <p>
                <input type="submit" value="Envoyer" />
            </p>
        </fieldset>
    </form>