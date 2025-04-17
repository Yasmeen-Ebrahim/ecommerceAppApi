<?php

include '../connect.php' ;

$userid = filterRequest("userid");
$itemid = filterRequest("itemid");


$pre = $con->prepare("SELECT COUNT(cart.cart_id) AS `itemcount` FROM `cart` WHERE cart.cart_itemsid = ? AND cart.cart_usersid = ? AND cart.cart_orders = ?");
$pre->execute(array($itemid , $userid , 0));

$data = $pre->fetchColumn();

$count = $pre->rowCount();

if ($count > 0){
    echo json_encode(array("status" => "success" , "data" => $data));
} else {
    echo json_encode(array("status" => "success" , "data" => "0"));
}



?>