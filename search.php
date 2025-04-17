<?php

include "connect.php" ;

$search = filterRequest("search");

$pre = $con->prepare("SELECT * FROM `itemsview` WHERE `items_name` LIKE '%$search%' OR `items_name_ar` LIKE '%$search%'");
$pre->execute();

$data = $pre->fetchAll(PDO::FETCH_ASSOC);

$count = $pre->rowCount();

    if ($count > 0){
        echo json_encode(array("status" => "success" , "data" => $data));
    } else {
        echo json_encode(array("status" => "failure"));
    }

?>