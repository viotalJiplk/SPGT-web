<?php

include(dirname(__FILE__)."/classdef.php");     //the location will be found even when this file (dbio.php) was included

if(!function_exists("dbio")){
    function dbio(string $sql, int $io){
        try{
            $servername = "localhost";

            $username = "a215865_spgtweb";
            $password = "QhcnpmhJ";


            $conn = new PDO("mysql:host=$servername", $username, $password);

                //adding parmeters and testing return value
            if(!$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION)){    //PDO::ERRMODE_SILENT for not debug uses
                throw new AttrException("Failed to set atribute (ERRMODE)");
            }
            if(!$conn->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING)){    //set atribute allways 2 param, empety = NULL
                throw new AttrException("Failed to set atribute (NULL_EMPTY_STRING)");
            }
            if(!$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC)){ //array only with collum name (not indexed ones)
                throw new AttrException("Failed to set atribute (FETCH_MODE)");
            }
        
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            if($io){
                $result = $stmt -> fetchAll();    
                return $result;
                $conn = null;
            }
        }catch(PDOException $e) {                                               //zpracování výjimky databáze
            if($e->errorInfo["1"] == 1062){                                     //username není unikátní
                throw new InputException("Username not UNIQUE");
            }else{
                $ExceptionHandler = new ExceptionHandlerclass;
                $ExceptionHandler->SetException("PDOException", $e->getMessage());
                throw new dbIOException("PDOexcepion");
            };
        }catch(AttrException $e){                                               //zpracování výjimky atributů spojení s databází 
            $ExceptionHandler = new ExceptionHandlerclass;
            $ExceptionHandler->SetException("PDOAtrException", $e);
            throw new dbIOException("exception when setting attribute");
        }catch(Exception $e){                                                   //zpracování obecné výjimky
            $ExceptionHandler = new ExceptionHandlerclass;
            $ExceptionHandler->SetException("UnknownException", $e);
            throw new dbIOException("db general excepion");
        }
    }
}
?>