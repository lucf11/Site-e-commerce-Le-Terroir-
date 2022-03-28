 
        <?php
            session_start();
             if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > (30*60))) {
                 // if last request was more than 30 minutes ago
                 session_unset();     // unset $_SESSION variable for the run-time 
                 session_destroy();   // destroy session data in storage
             } else {
                 $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
             }
            $DS = DIRECTORY_SEPARATOR;
            $ROOT_FOLDER = __DIR__ . $DS . "..";
            require_once "{$ROOT_FOLDER}{$DS}lib{$DS}File.php"; 
            require_once 'routeur.php';
            
        ?>

