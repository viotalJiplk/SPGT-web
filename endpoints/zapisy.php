<?php
    include(dirname(__DIR__)."/php/dbio.php");                     //the location will be found even when this file (zapisy.php) was included
    include(dirname(__DIR__)."/php/classdef.php");

    try{
        $json = file_get_contents('php://input');
        $payload = json_decode($json);
        if($payload == NULL){
            throw new notValidinException("no json sent");
        }else{
            if(isset($payload->date)){
                
            }else{
                throw new notValidinException("wrong payload");
            }
        }
    }catch(dbIOException $e){                                               //some db exception
        $error = "system exception";
    }catch(notValidinException $e){                                         //something in json payload was missing
        $error = $e;
    }
?>