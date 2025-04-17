<?php

include '../connect.php' ;

$userid = filterRequest("userid");
$itemid = filterRequest("itemid");


$pre = $con->prepare("DELETE FROM `cart` WHERE `cart_usersid` = ? AND  `cart_itemsid` = ? AND `cart_orders` = ? LIMIT 1 ");
$pre->execute(array($userid , $itemid , 0));

$count = $pre->rowCount();

if ($count > 0){
    echo json_encode(array("status" => "success"));
} else {
    echo json_encode(array("status" => "failure"));
}

?>
