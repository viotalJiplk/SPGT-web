<?php
    declare(strict_types = 1);
    session_start();
    include(dirname(__FILE__)."/php/dbio.php");                     //the location will be found even when this file (login.php) was included
    include(dirname(__FILE__)."/php/classdef.php");

    try{
        if(!array_key_exists( "username" , $_SESSION)){
            if(array_key_exists("username" , $_POST) && array_key_exists("password" , $_POST )){
                $sswordsearch =  dbio("SELECT password FROM d215865_spgtweb.stdlogin WHERE username='$_POST[username]'", 1 );
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
    </head>
    <body>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <input type="text" value="username" name="username" required/>
            <input type="password" name="password" required/>
            <button type="submit">Login</button>
        </form>
        <?php
            if(isset($error)){
                echo "<p id=\"error\">" . $error . "<p>";
            }
        ?>
    </body>
</html>