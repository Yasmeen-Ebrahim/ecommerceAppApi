<?php

include '../connect.php' ;

$addressid = filterRequest("addressid");

$pre = $con->prepare("DELETE FROM `address` WHERE `address_id` = ?");
$pre->execute(array($addressid));

 $count = $pre->rowCount();

    if ($count > 0){
        printSuccess();
    } else {
        printFailure();
    }


?>