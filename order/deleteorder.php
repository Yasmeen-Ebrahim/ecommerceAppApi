<?php

include '../connect.php' ;

$orderId = filterRequest("orderid");

$pre = $con-> prepare("DELETE FROM `orders` WHERE orders_id = ? AND orders_status = 0") ;
$pre-> execute(array($orderId)) ;

$count = $pre ->rowCount() ;

if($count > 0){
    printSuccess();
}else{
    printFailure() ;
}

?>