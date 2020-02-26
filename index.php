<?php

include_once('BUILD.php');
build_page("Studenti pro studenty", basename($_SERVER["SCRIPT_FILENAME"], '.php' ), '
    '.file_get_contents('./views/articles/2019-2020/2020.1.26 testovaci.html').'

     <h5>Zapojte se přímo na schůzích, nebo nás kontaktujte.</h3>
');

?>