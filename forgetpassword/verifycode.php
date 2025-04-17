<?php

include '../connect.php' ;


$verifycode = filterRequest("verifycode");
$email = filterRequest("email");

$pre = $con->prepare("SELECT * FROM `users` WHERE `users_email` = ? AND `users_verifycode` = ?");
$pre->execute(array($email, $verifycode));

$count = $pre->rowCount();

if($count > 0 ){
    printSuccess();
}else{
    printFailure();
}
?>