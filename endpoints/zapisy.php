<?php
    include(dirname(__DIR__)."/php/dbio.php");                     //the location will be found even when this file (zapisy.php) was included
    include(dirname(__DIR__)."/php/classdef.php");
    header("Content-type: application/json");

    try{
        $json = file_get_contents('php://input');
        $payload = json_decode($json);
        if($payload == NULL){
            throw new notValidinException("no json sent");
        }else{
            if(isset($payload->date)){
                $date = $payload->date;
                if($date != NULL){
                    if(gettype($date) != "string"){
                        throw new notValidinException("wrong payload");
                    }
                    $result = dbio("SELECT * FROM d215865_spgtweb.zapisy WHERE time='$date'",1);
                    echo json_encode($result);
                }else{
                    throw new notValidinException("wrong payload");
                }
            }else{
                throw new notValidinException("wrong payload");
            }
        }
    }catch(dbIOException $e){                                               //some db exception
        $error = "system exception";
        echo json_encode($e);
    }catch(notValidinException $e){                                         //something in json payload was missing
        echo json_encode($e);
    }
?>