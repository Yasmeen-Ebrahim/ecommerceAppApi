<?php

include '../connect.php' ;

$couponname = filterRequest("couponname");
$currentdate = date("Y-m-d H:i:s");

$pre = $con->prepare("SELECT * FROM `coupon` WHERE `coupon_name` = ? AND `coupon_count` > 0 AND `coupon_expiredate` > ? ");
$pre->execute(array($couponname , $currentdate));

$coupondata = $pre->fetchAll(PDO::FETCH_ASSOC);

$count  = $pre->rowCount();

    if ($count > 0){
        echo json_encode(array("status" => "success", "couponData" => $coupondata));
    } else {
        printFailure();
    }
    return $count;


?>