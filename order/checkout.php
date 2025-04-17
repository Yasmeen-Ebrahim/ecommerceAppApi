<?php

include '../connect.php' ;

$userid                     = filterRequest("userid") ;
$paymentmethod              = filterRequest("paymentmethod") ;
$deliverytype               = filterRequest("deliverytype") ;
$useraddress                = filterRequest("useraddress") ;
$ordercoupon                = filterRequest("ordercoupon") ;
$ordercoupondiscount        = filterRequest("ordercoupondiscount") ;
$orderprice                 = filterRequest("orderprice") ;
$orderdeliveryprice         = filterRequest("orderdeliveryprice") ;
$totalorderprice         = filterRequest("totalorderprice") ;
$currentdate = date("Y-m-d H:i:s");


// Check Coupon

$pre = $con->prepare("SELECT * FROM `coupon` WHERE `coupon_id` = ? AND `coupon_count` > 0 AND `coupon_expiredate` > ? ");
$pre->execute(array($ordercoupon , $currentdate));

$count  = $pre-> rowCount();

    if ($count > 0){
            // $orderprice = $orderprice - $orderprice * $ordercoupondiscount / 100 ;
            // $totalorderprice = $orderprice + $orderdeliveryprice
        $pre = $con->prepare("UPDATE `coupon` SET `coupon_count` = `coupon_count` - 1 WHERE `coupon_id` = ? ") ;
        $pre->execute(array($ordercoupon)) ;
    }


// Make Order
$pre = $con-> prepare(" INSERT INTO `orders`
(`orders_userid`, `orders_paymentmethod`, `orders_deliverytype`, `orders_address`, `orders_coupon`, `orders_coupondiscount`,
`orders_price`, `orders_pricedelivery` , `orders_totalorderprice`)
   VALUES (? , ? , ? , ? , ? , ? , ? , ? , ?)");
$pre-> execute(array($userid , $paymentmethod , $deliverytype , $useraddress , $ordercoupon ,$ordercoupondiscount, $orderprice , $orderdeliveryprice , $totalorderprice));

$count  = $pre-> rowCount();
    if ($count > 0){
        echo json_encode(array("status" => "success"));
        //get max
        $pre = $con->prepare("SELECT  MAX(`orders_id`) FROM `orders` ");
        $pre->execute();
        $maxOrderId = $pre->fetchColumn();

        //update cart_orders
        $pre = $con->prepare("UPDATE `cart` SET `cart_orders`= ? WHERE `cart_usersid` = ? AND `cart_orders` = ?");
        $pre->execute(array($maxOrderId , $userid , 0));
    } else {
        echo json_encode(array("status" => "failure"));
    }


?>