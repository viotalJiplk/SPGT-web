<?php
    include_once("php/dbio.php");
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
    try{
        dbio("INSERT INTO stdlogin (username, password)VALUES ('$_POST[username]', '$_POST[password]');", 0);
    }catch(InputException $e){
        echo $e->getMessage();
    }
    $result = dbio("SELECT * FROM stdlogin", 1);
    echo json_encode($result);

?>