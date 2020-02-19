<?php

include_once("classdef.php");

function dbio(string $sql, int $io){
    try{
        $servername = "localhost";
        $dbname = "d215865_spgtweb";

        $username = "a215865_spgtweb";
        $password = "QhcnpmhJ";


        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

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
        $ExceptionHandler = new ExceptionHandlerclass;
        $ExceptionHandler->SetException("PDOException", $e->getMessage());
        return ($ExceptionHandler);
    }catch(AttrException $e){                                               //zpracování výjimky atributů spojení s databází 
        $ExceptionHandler = new ExceptionHandlerclass;
        $ExceptionHandler->SetException("PDOAtrException", $e);
        return ($ExceptionHandler);
    }catch(Exception $e){                                                   //zpracování obecné výjimky
        $ExceptionHandler = new ExceptionHandlerclass;
        $ExceptionHandler->SetException("UnknownException", $e);
        return ($ExceptionHandler);
    }
}

?>