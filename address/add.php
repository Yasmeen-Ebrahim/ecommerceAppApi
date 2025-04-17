<?php

include '../connect.php' ;

$name = filterRequest("name");
$city = filterRequest("city");
$street = filterRequest("street");
$lat = filterRequest("lat");
$long = filterRequest("long");
$userid = filterRequest("userid");

$pre = $con->prepare("INSERT INTO `address`(
`address_name`, `address_city`, `address_street`, `address_lat`, `address_long`, `address_usersid`)
 VALUES (? , ? , ? , ? , ? , ? ) ") ;
$pre->execute(array($name , $city , $street , $lat , $long , $userid));

$count = $pre->rowCount();

    if ($count > 0){
        printSuccess();
    } else {
        printFailure();
    }


?>