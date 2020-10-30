<?php
function escapehtml(array $htmltagall, string $escapestring){
    $escapestring = preg_replace('#<#', '&lt', $escapestring);
    $escapestring = preg_replace('#>#', '&gt', $escapestring);
    
    foreach($htmltagall as $tag){
        $escapedtag = "#\[" . $tag . "\]#";
        $escapedendtag = "#\[/" . $tag . "\]#";

        $htmltag = "<" . $tag . ">";
        $htmlendtag = "</". $tag . ">";
        
        $escapestring = preg_replace($escapedtag, $htmltag, $escapestring);
        $escapestring = preg_replace($escapedendtag, $htmlendtag, $escapestring);
    }

    return $escapestring;
}
?>