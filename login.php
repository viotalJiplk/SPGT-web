<?php
    include_once("php/dbio.php");

    dbio("SELECT * FROM stdlogin", 1);
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