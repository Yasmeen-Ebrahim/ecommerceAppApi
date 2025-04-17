<?php

include '../connect.php' ;

$userid = filterRequest("userid");
$itemid = filterRequest("itemid");


$pre = $con->prepare("INSERT INTO `favorite` (`favorite_usersid`, `favorite_itemsid`) VALUES (? , ?)");
$pre->execute(array($userid , $itemid));

$count = $pre->rowCount();

if($count > 0 ){
    printSuccess();
}else{
    printFailure();
}
?>