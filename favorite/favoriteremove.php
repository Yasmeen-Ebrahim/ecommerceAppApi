<?php

include '../connect.php' ;

$userid = filterRequest("userid");
$itemid = filterRequest("itemid");


$pre = $con->prepare("DELETE FROM `favorite` WHERE `favorite_usersid` = ? AND `favorite_itemsid` = ?");
$pre->execute(array($userid , $itemid));

$data = $pre->fetchAll(PDO::FETCH_ASSOC);

$count = $pre->rowCount();

if($count > 0 ){
    echo json_encode(array("status" => "success" , "data" => $data)); ;
}else{
    printFailure();
}
?>