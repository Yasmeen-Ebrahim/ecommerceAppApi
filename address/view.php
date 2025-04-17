<?php

include '../connect.php' ;

$userid = filterRequest("userid");

$pre = $con->prepare("SELECT * FROM `address` WHERE `address_usersid` = ?");
$pre->execute(array($userid));

$data = $pre->fetchAll(PDO::FETCH_ASSOC);

 $count = $pre->rowCount();

    if ($count > 0){
        echo json_encode(array("status" => "success" , "data" => $data));
    } else {
        printFailure();
    }


?>