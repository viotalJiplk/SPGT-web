<?php

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