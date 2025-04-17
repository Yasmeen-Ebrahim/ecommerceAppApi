<?php

include '../connect.php' ;

$email = filterRequest("email");
$verifycode = rand(10000 , 100000);


$pre = $con->prepare("SELECT * FROM `users` WHERE `users_email` = ?");
$pre->execute(array($email));

$count = $pre->rowCount();

if($count > 0 ){
    $pre = $con->prepare("UPDATE `users` SET `users_verifycode` = ? WHERE `users_email` = ?");
    $pre->execute(array($verifycode , $email));
    printSuccess();
}else{
    printFailure();
}


?>