<?php

include '../connect.php' ;

$orderId = filterRequest("orderid") ;

$pre = $con->prepare("SELECT * FROM `orderdetails`  WHERE `cart_orders` = ?");
$pre->execute(array($orderId));
$orderData = $pre->fetchAll(PDO::FETCH_ASSOC);

$count = $pre->rowCount();

    if ($count > 0){
        echo json_encode(array("status" => "success" , "orderData" => $orderData));
    } else {
        echo json_encode(array("status" => "failure"));
    }


?>