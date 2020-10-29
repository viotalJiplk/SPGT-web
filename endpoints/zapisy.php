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
            if(isset($payload->id)){
                $id = $payload->id;
                if($id != NULL){
                    if(gettype($id) != "integer"){
                        throw new notValidinException("wrong payload");
                    }
                    $result = dbio("SELECT * FROM d215865_spgtweb.zapisy WHERE id=:id", array(":id" => $id));
                }else{
                    throw new notValidinException("wrong payload");
                }
            }elseif(isset($payload->startdate) AND isset($payload->enddate)){
                $result = dbio("SELECT id,time FROM d215865_spgtweb.zapisy WHERE time >= :timestart AND time <= :timeend", array(":timestart" => $payload->startdate, ":timeend" => $payload->enddate));
            }elseif(isset($payload->nrecords)){
                if(!isset($payload->offset)){
                    $payload->offset = 0;
                }
                if(gettype($payload->nrecords) != "integer" AND gettype($payload->offset) != "integer"){
                    throw new notValidinException("nrecords not int");    
                }
                $result = dbio("SELECT id, time FROM d215865_spgtweb.zapisy ORDER BY time DESC LIMIT $payload->nrecords OFFSET $payload->offset", array());
            }else{
                throw new notValidinException("wrong payload");
            }
            echo json_encode($result);
        }
    }catch(dbIOException $e){                                               //some db exception
        $error = "system exception";
        echo json_encode($e);
    }catch(notValidinException $e){                                         //something in json payload was missing
        echo json_encode($e);
    }
?>