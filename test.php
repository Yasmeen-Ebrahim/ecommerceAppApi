<?php

include "connect.php" ;

$pre = $con->prepare("SELECT itemsview.* FROM itemsview WHERE itemsview.items_discount != 0 ");
$pre->execute();

$data = $pre->fetchAll(PDO::FETCH_ASSOC);

$count = $pre->rowCount();

    if ($count > 0){
        echo json_encode(array("status" => "success" , "data" => $data));
    } else {
        echo json_encode(array("status" => "failure"));
    }

?>