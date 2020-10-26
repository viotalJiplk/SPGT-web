<?php
    declare(strict_types = 1);
    session_start();
    include(dirname(__FILE__)."/php/dbio.php");                     //the location will be found even when this file (login.php) was included
    include(dirname(__FILE__)."/php/classdef.php");

    try{
        if(!array_key_exists( "username" , $_SESSION)){
            if(array_key_exists("username" , $_POST) && array_key_exists("password" , $_POST )){
                $sswordsearch =  dbio("SELECT password FROM d215865_spgtweb.stdlogin WHERE username = :username", array(":username" => $_POST["username"] ));
                if(array_key_exists(0, $sswordsearch)){
                    $sswordsearch = $sswordsearch[0]; 
                    if(array_key_exists("password", $sswordsearch)){
                        $sswordsearch = $sswordsearch["password"];
                    }else{
                        throw new InputException("Wrong username or password");
                    }
                }else{
                    throw new InputException("Wrong username or password");
                }
                $sswordtrue = password_verify($_POST["password"], $sswordsearch);
                if($sswordtrue){
                    $_SESSION["username"] = $_POST["username"];
                }
            }
        }
        if(array_key_exists( "username" , $_SESSION)){
            header('Location: index.php', true, 302);
        }

    }catch(InputException $e){                                              //username not Unique
        $error = $e->getMessage();
    }catch(dbIOException $e){                                               //some db exception
        $error = "system exception";
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>SPGT-login</title>
		<link rel="stylesheet" href="css/login.css">
        <link rel="shortcut icon" href="favicon.svg" type="image/svg+xml">
    </head>
    <body>
        <?php require 'include/nav.html';?>

        <div class="mainContent">
            <h3>Přihlaste se:</h3>

            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <div>
                    <span>Uživatelské jméno:</span>
                    <input class="textInput" type="text" placeholder="jméno" name="username" required/>
                </div>
                <div>
                    <span>Heslo:</span>
                    <input class="textInput" type="password" placeholder="heslo" name="password" required/>
                </div>
                <div class="links">
                    <a href="signup.php">Registrovat se.</a>
                    <a href="#">Zapomněli jste heslo?</a>
                </div>
                <button class="btn btn--confirm" type="submit">Přihlásit se</button>
            </form>
            <?php
                if(isset($error)){
                    echo "<p id=\"error\">" . $error . "<p>";
                }
            ?>

        </div>

    </body>
</html>