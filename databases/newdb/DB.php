<?php

function get_games ($toRootRelStr = './', $targetId = '', $anotherFilterColumnValue = '') {
    $sql = "SELECT * FROM tableName WHERE removed = 0 ";
    
    if (strlen($targetId) > 0) {
        $sql .= "AND id IN ('".$targetId."') ";
    }
    else if (strlen($anotherFilterColumnValue) > 0) {
        $sql .= "AND anotherFilterColumn IN ('".$anotherFilterColumnValue."') ";
    }

    $sql.="ORDER BY columnName ASC";

    include_once($toRootRelStr.'databases/access/connection.php');
    $connection = get_connection();
    $result = $connection ->query($sql);

    $obj = array();

    if (!is_object($result)) {
        return $obj;
    }

    if ($result->num_rows > 0) {

        while ($data = $result->fetch_assoc()) {
                array_push($obj, $data);
        }
    }
    $connection->close();

    return $obj;
}

?>

