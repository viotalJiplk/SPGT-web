<?php
    declare(strict_types = 1);
    session_start();

    try{
        if(!array_key_exists( "username" , $_SESSION)){
            header('Location: /account/login.php', true, 302);
            exit();
        }
    }catch(Exception $e){
        echo $e;
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
            <h3>Váš účet:</h3>
            <p>jméno: <?php echo $_SESSION["username"];?></p>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                <h4>Změna hesla</h4>
                <input type="text">
                <button class="btn btn--confirm" type="submit">změna hesla</button>
            </form>
            <button class="btn btn--confirm" onclick="location.href = 'logout.php'">logout</button>
            <?php
                if(isset($error)){
                    echo "<p id=\"error\">" . $error . "<p>";
                }
            ?>

        </div>

    </body>
</html>