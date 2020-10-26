<?php
    include(dirname(__DIR__)."/php/dbio.php");                     //the location will be found even when this file (zapisy.php) was included
    include(dirname(__DIR__)."/php/classdef.php");
    header("Content-type: application/json");

    try{
        $result = dbio("SELECT id,time FROM d215865_spgtweb.zapisy", array());
        echo json_encode($result);
    }catch(dbIOException $e){                                               //some db exception
    $error = "system exception";
    echo json_encode($e);
    }
?>