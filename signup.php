<?php
    declare(strict_types = 1);
    session_start();
    include_once("php/dbio.php");

    try{
        if(!array_key_exists( "username" , $_SESSION)){
            if(array_key_exists ( "username" , $_POST ) && array_key_exists ( "password" , $_POST )){
                $sswordhash = password_hash($_POST["password"], PASSWORD_DEFAULT);;
                dbio("INSERT INTO d215865_spgtweb.stdlogin (username, password)VALUES ('$_POST[username]', '$sswordhash');", 0);
                $_SESSION["username"] = $_POST["username"];
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
		<link rel="stylesheet" href="css/signup.css">
    </head>
    <body>

        <?php require 'include/nav.html';?>

        <div class="mainContent">
            <h3>Vytvořte si účet:</h3>

            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <div>
                    <p>Uživatelské jméno:</p>
                    <input type="text" value="username" name="username" required/>
                </div>
                <div>
                    <p>Heslo:</p>
                    <input type="password" name="password" required/>
                </div>
                <button type="submit">signup</button>
            </form>
            <?php
                if(isset($error)){
                    echo "<p id=\"error\">" . $error . "<p>";
                }
                
                echo $_SESSION["username"];                     //for development
                echo "<br>";                                    //for development
                echo $sswordhash;                     //for development
            ?>

        </div>
    </body>
</html>