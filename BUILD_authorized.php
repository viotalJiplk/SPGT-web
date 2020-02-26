<?php

function check_authorized ($toRootRelStr = './') {
    include_once($toRootRelStr.'storage/session.php');

    $sessionData = getSessionData();
    if (!isset($sessionData) || count($sessionData) == 0) {
        include_once($toRootRelStr.'helpers/redirectHelper.php');
        redirect($toRootRelStr.'set');
        exit();
    }
}


function build_page_authorized ($title, $viewName, $HTML = '', $subFolderPath = '', $toRootRelStr = './') {
    check_authorized ($toRootRelStr);
    include_once('BUILD.php');
    build_page($title, $viewName, $HTML, $subFolderPath, $toRootRelStr);
}

?>