<?php

include '../connect.php' ;

$name = filterRequest("name");
$city = filterRequest("city");
$street = filterRequest("street");
$addressid = filterRequest("addressid");

$pre = $con->prepare("UPDATE `address` SET `address_name` = ?, `address_city` = ?, `address_street` = ? WHERE `address_id` = ? ") ;
 $pre->execute(array($name , $city , $street , $addressid));

 $count = $pre->rowCount();

    if ($count > 0){
        printSuccess();
    } else {
        printFailure();
    }


?>