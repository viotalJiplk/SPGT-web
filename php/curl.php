<?php
    function postrequest($server, $head, $body){
	    $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $server);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body); 													//set HTTP Body for POST request
        curl_setopt($ch, CURLOPT_HTTPHEADER, $head);													//Set HTTP Header for POST request
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        $post = curl_exec($ch);																			//Submit the POST request
        $httprescode = curl_getinfo($ch, CURLINFO_RESPONSE_CODE); 										//geting http result code
        curl_close($ch);																				//Close cURL session handle
        $return = array();
        $return["data"] = $post;
        $return["httprescode"] = $httprescode;
        return $return;
    }
?>