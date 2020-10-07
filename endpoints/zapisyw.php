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
            if(isset($payload->date) & isset($payload->program) & isset($payload->zapis)){
                if($payload->date != NULL & $payload->program != NULL & $payload->zapis != NULL){
                    $date = $payload->date;
                    $program = $payload->program;
                    $zapis = $payload->zapis;

                    if((gettype($date) != "string") OR (gettype($program) != "string") OR (gettype($zapis) != "string")){         //to do date format checking
                        throw new notValidinException("type of something in payload is incorrect");
                    }

                    $sqlp1 = "INSERT INTO d215865_spgtweb.zapisy (time, program, zapis";
                    $sqlp2 = ") VALUES('$date', '$program', '$zapis'";
                    if(isset($payload->materialy)){
                        $sqlp1 = $sqlp1 . ", materialy";
                        $sqlp2 = $sqlp2 . ", '" . $payload->materialy . "'";
                    }
                    if(isset($payload->hlasovani)){
                        $sqlp1 = $sqlp1 . ", hlasovani";
                        $sqlp2 = $sqlp2 . ", '" . $payload->hlasovani . "'";
                    }
                    dbio($sqlp1 . $sqlp2 . ")",0);
                }else{
                    throw new notValidinException("wrong payload");
                }
            }else{
                throw new notValidinException("wrong payload");
            }
        }
        echo json_encode("ok");
    }catch(dbIOException $e){                                               //some db exception
        $error = "system exception";
        echo json_encode($e);
    }catch(notValidinException $e){                                         //something in json payload was missing
        echo json_encode($e);
    }
?>