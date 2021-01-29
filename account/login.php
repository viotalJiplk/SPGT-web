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
                    if(array_key_exists("username" , $_POST) && array_key_exists("password" , $_POST )){
                        $sswordsearch =  dbio("SELECT password FROM d215865_spgtweb.stdlogin WHERE username = :username", array(":username" => $_POST["username"] ));
                        if(array_key_exists(0, $sswordsearch)){
                            $sswordsearch = $sswordsearch[0]; 
                            if(array_key_exists("password", $sswordsearch)){
                                $sswordsearch = $sswordsearch->password;
                            }else{
                                throw new InputException("Wrong username or password");
                            }
                        }else{
                            throw new InputException("Wrong username or password");
                        }
                        $sswordtrue = password_verify($_POST["password"], $sswordsearch);
                        if($sswordtrue){
                            $_SESSION["username"] = $_POST["username"];
                        }else{
                            throw new InputException("Wrong username or password");
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
		<link rel="stylesheet" href="/css/login.css">
        <link rel="shortcut icon" href="/favicon.svg" type="image/svg+xml">
    </head>
    <body>
        <?php require "../".'include/nav.html';?>

        <div class="mainContent">
            <h3>Přihlaste se:</h3>

            <form action="<?php echo $_SERVER['PHP_SELF'];?>" id="login" method="post">
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
                <button class="g-recaptcha btn btn--confirm" 
                    data-sitekey="6LfF1EEaAAAAALhEcpEA17upLMfVMEvE6btlNCjr" 
                    data-callback='onSubmit' 
                    data-action='submit'
                >Přihlásit se</button>
            </form>
            <?php
                if(isset($error)){
                    echo "<p id=\"error\">" . $error . "<p>";
                }
            ?>
            <script src="https://www.google.com/recaptcha/api.js"></script>
            <script>
                function onSubmit(token) {
                    document.getElementById("login").submit();
                }
            </script>

        </div>

    </body>
</html>