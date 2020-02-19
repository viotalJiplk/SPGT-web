<?php
    declare(strict_types = 1);
    session_start();
    include_once("php/dbio.php");

    try{
        if(!(array_key_exists( "username" , $_SESSION) && array_key_exists( "password" , $_SESSION))){
            if(array_key_exists ( "username" , $_POST ) && array_key_exists ( "password" , $_POST )){
                if(count(dbio("SELECT * FROM d215865_spgtweb.stdlogin WHERE username='$_POST[username]' AND password='$_POST[password]'",1)) == 1 ){
                    $_SESSION["username"] = $_POST["username"];
                    $_SESSION["password"] = $_POST["password"];
                }
            }
        }
        if(array_key_exists( "username" , $_SESSION) && array_key_exists( "password" , $_SESSION)){
            header('Location: index.php', true, 302);
        }

    }catch(InputException $e){                                              //username not Unique
        echo $e->getMessage();
    }catch(dbIOException $e){                                               //some db exception
        echo "system exception";
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <form action="login.php" method="post">
            <input type="text" value="username" name="username" required/>
            <input type="password" name="password" required/>
            <button type="submit">Login</button>
        </form>
    </body>
</html>
<?php
?>