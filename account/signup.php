<?php
    declare(strict_types = 1);
    session_start();
    include(dirname(__FILE__)."/.."."/php/dbio.php");                     //the location will be found even when this file (login.php) was included
    include(dirname(__FILE__)."/.."."/php/classdef.php");
    include(dirname(__FILE__)."/.."."/php/curl.php");
    include(dirname(__FILE__)."/.."."/php/recaptcha.php");

    try{
        if(!array_key_exists( "username" , $_SESSION)){
            if(array_key_exists("g-recaptcha-response", $_POST)){
                if(grecaptha_verify("6LfF1EEaAAAAACf6xa50NUw_vqSjSLayJWES4oK4" ,$_POST["g-recaptcha-response"])){
                    if(array_key_exists ( "username" , $_POST ) && array_key_exists ( "password" , $_POST )){
                        if(preg_match("/^[a-zA-Z0-9]+$/", $_POST["username"])){
                            $sswordhash = password_hash($_POST["password"], PASSWORD_DEFAULT);;
                            dbio("INSERT INTO d215865_spgtweb.stdlogin (username, password)VALUES (:username, :sswordhash);", array(":username"=>$_POST["username"],":sswordhash" => $sswordhash));
                            $_SESSION["username"] = $_POST["username"];
            
                        }else{
                            throw new InputException("You can only use alphanumeric characters in username");
                        }
                    }
                }else{
                    throw new InputException("invalid captcha");
                }
            }
        }
        if(array_key_exists( "username" , $_SESSION)){
            header('Location: /account/account.php', true, 302);
            exit();
        }
    }catch(InputException $e){                                              //username not Unique
        $error = $e->getMessage();
    }catch(dbIOException $e){                                               //some db exception
        $error = "system exception";
    }catch(Exception $e){
        $error = "unknown exception";
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>SPGT-login</title>
		<link rel="stylesheet" href="/css/signup.css">
        <link rel="shortcut icon" href="/favicon.svg" type="image/svg+xml">
    </head>
    <body>

        <?php require "../".'include/nav.html';?>

        <div class="mainContent">
            <h3>Vytvořte si účet:</h3>

            <form action="<?php echo $_SERVER['PHP_SELF'];?>" id="signup" method="post">
                <div>
                    <span>Uživatelské jméno:</span>
                    <input class="textInput" type="text" placeholder="jméno" name="username" required/>
                </div>
                <div>
                    <span>Heslo:</span>
                    <input class="textInput" type="password" placeholder="heslo" name="password" required/>
                </div>
                <a href="login.php">Přihlásit se.</a>
                <button class="g-recaptcha btn btn--confirm" 
                    data-sitekey="6LfF1EEaAAAAALhEcpEA17upLMfVMEvE6btlNCjr" 
                    data-callback='onSubmit' 
                    data-action='submit'
                >Registrovat se</button>
            </form>
            <?php
                if(isset($error)){
                    echo "<p id=\"error\">" . $error . "<p>";
                }
                
                //echo $_SESSION["username"];                     //for development
                //echo "<br>";                                    //for development
                //echo $sswordhash;                     //for development
            ?>
            <script src="https://www.google.com/recaptcha/api.js"></script>
            <script>
                function onSubmit(token) {
                    document.getElementById("signup").submit();
                }
            </script>

        </div>
    </body>
</html>