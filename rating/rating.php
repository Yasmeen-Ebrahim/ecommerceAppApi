<?php

include '../connect.php' ;

$orderId = filterRequest("orderid") ;
$rate = filterRequest("rate") ;
$note = filterRequest("note") ;

$pre = $con->prepare("UPDATE `orders` SET `orders_rate` = ? , `orders_note` = ? WHERE `orders_id` = ?");
$pre->execute(array($rate , $note , $orderId));

$count  = $pre->rowCount();
    if ($count > 0){
        printSuccess();
    } else {
        printSuccess();
    }
    return $count;

?>