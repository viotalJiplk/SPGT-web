<?php

include(dirname(__FILE__)."/classdef.php");     //the location will be found even when this file (dbio.php) was included


if(!function_exists("dbio")){
    /**
     * function providing interface to database
     *
     * @param string $sql sql command
     * @param array $param data for sql command
     * @return array array of resultsyy
     */
    function dbio(string $sql, array $param){
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
            if(!$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ)){ //array only with collum name (not indexed ones)
                throw new AttrException("Failed to set atribute (FETCH_MODE)");
            }
        
            $stmt = $conn->prepare($sql);
            $stmt->execute($param);

            $result = array();
            $i = 0;

            if(preg_match("/^(SELECT)/", $sql)){                                //pro SELECT získávání výsledků
                $result = $stmt -> fetchAll();    
            }
            $conn = null;
            return $result;
        }catch(PDOException $e) {                                               //zpracování výjimky databáze
            if($e->errorInfo["1"] == 1062){                                     //username není unikátní
                throw new InputException("Username not UNIQUE");
            }else{
                throw new dbIOException("PDOexcepion");
            };
        }catch(AttrException $e){                                               //zpracování výjimky atributů spojení s databází 
            throw new dbIOException("exception when setting attribute");
        }catch(Exception $e){
            throw new dbIOException("db general excepion");
        }
    }
}
?>
