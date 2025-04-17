<?php

include '../connect.php' ;

$userid = filterRequest("userid");

$pre = $con-> prepare("SELECT * FROM `orderaddress` WHERE `orders_userid` = ? AND orders_status != 3") ;
$pre-> execute(array($userid)) ;

$Orders = $pre-> fetchAll(PDO::FETCH_ASSOC);

$count = $pre ->rowCount() ;

if($count > 0){
    echo json_encode(array("status" => "success" , "Orders" => $Orders));
}else{
    printFailure() ;
}
?>