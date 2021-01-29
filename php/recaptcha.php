<?php
    function grecaptha_verify($secret, $response){
        $request = postrequest("https://www.google.com/recaptcha/api/siteverify", [], "secret=" . $secret . "&response=" .$response);
        try{    
            if($request["httprescode"] == 200) {
                $data = json_decode($request["data"]);
                if($data->success){
                    $return = true;
                }else{
                    $return = false;
                }
            }else{
                $return = false;
            }
        }catch(Exception $e){
            $return = false;
        }
        return $return;

    }
?>