<?php

include '../connect.php' ;

$userid = filterRequest("userid");
$itemid = filterRequest("itemid");


$pre = $con->prepare("INSERT INTO `cart` (`cart_usersid`, `cart_itemsid`) VALUES (? , ?)");
$pre->execute(array($userid , $itemid));

$count = $pre->rowCount();

if ($count > 0){
    echo json_encode(array("status" => "success"));
} else {
    echo json_encode(array("status" => "failure"));
}



?>