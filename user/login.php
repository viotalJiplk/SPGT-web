<?php

declare(strict_types = 1);

include_once('../BUILD_authorized.php');

$message = '';


$linkBack = '';
if (isset($_GET['back'])) {
    $linkBack = $_GET['back'];
}



function redir_administrace () {
    include_once('../helpers/redirectHelper.php');

    $linkBack = '';
    if (isset($_GET['back'])) {
        $linkBack = $_GET['back'];
    }

    if(isset($_POST['submit'])) {
        $linkBack = $_POST['back'];
    }

    if (isset($linkBack)) {
        redirect($linkBack);
    }
    else redirect('../index');
}

session_start();


if(isset($_POST['submit'])) {
    sleep ( 2 );
    

    include("../php/dbio.php"); 
    include("../php/classdef.php");

    try{
        if(!array_key_exists( "username" , $_SESSION)){
            if(array_key_exists("username" , $_POST) && array_key_exists("password" , $_POST )){
                $sswordsearch =  dbio("SELECT password FROM d215865_spgtweb.stdlogin WHERE username='$_POST[username]'", 1 );
                if(array_key_exists(0, $sswordsearch)){
                    $sswordsearch = $sswordsearch[0]; 
                    if(array_key_exists("password", $sswordsearch)){
                        $sswordsearch = $sswordsearch["password"];
                    }else{
                         $message = 'Špatně zadané heslo. ';
                    }
                }else{
                     $message = 'Špatně zadané uživatelské jméno nebo heslo. ';
                }
                $sswordtrue = password_verify($_POST["password"], $sswordsearch);
                if($sswordtrue){
                    $_SESSION["username"] = $_POST["username"];
                    redir_administrace();
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
}


if (strlen($message) > 0) {
   $message = '<div class="alert alert-danger">
    '.$message.'
</div>';
}


include_once('../BUILD.php');
build_page('Uživatel - přihlášení', basename($_SERVER["SCRIPT_FILENAME"], '.php'), '

'.$message.'

<form method="POST" action="/user/login">
    <div class="form-group">
        <label for="username">Uživatelské jméno</label>
        <input autocomplete="on" name="username" type="text" class="form-control" id="username" placeholder="Zadejte uživatelské jméno" value="" />
    </div>
    <div class="form-group">
        <label for="password">Heslo</label>
        <input autocomplete="On" name="password" type="password" class="form-control" id="password" placeholder="Zadejte heslo" value="" />
    </div>
    <input name="back" type="hidden" id="back" value="'.$linkBack.'" />

    <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-sign-in-alt"></i> Přihlásit</button>
</form>

', 'user/', '../');
?>