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
                    $param = array();
                    $param[":created"] = $payload->date;
                    $param[":program"] = $payload->program;
                    $param[":zapis"] = $payload->zapis;
                    //$param[":id"] = "";

                    if((gettype($param[":created"]) != "string") OR (gettype($param[":program"]) != "string") OR (gettype($param[":zapis"]) != "string")){         //to do date format checking
                        throw new notValidinException("type of something in payload is incorrect");
                    }

                    $sql = "INSERT INTO d215865_spgtweb.zapisy(time, program, zapis, materialy, hlasovani) VALUES(:created, :program, :zapis, :materialy, :hlasovani)";
                    
                    if(isset($payload->materialy)){
                        $param[":materialy"] = $payload->materialy;
                    }else{
                        $param[":materialy"] = NULL;
                    }

                    if(isset($payload->hlasovani)){
                        $param[":hlasovani"] = $payload->hlasovani;
                    }else{
                        $param[":hlasovani"] = NULL;
                    }

                    dbio($sql, $param);
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