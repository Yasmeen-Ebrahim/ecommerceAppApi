<?php

include '../connect.php' ;


$verifycode = filterRequest("verifycode");
$email = filterRequest("email");

$pre = $con->prepare("SELECT * FROM `users` WHERE `users_email` = ? AND `users_verifycode` = ?");
$pre->execute(array($email, $verifycode));

$count = $pre->rowCount();

if($count > 0 ){
    $pre = $con->prepare("UPDATE `users` SET `users_approve` = 1 WHERE `users_verifycode` = ?");
    $pre->execute(array($verifycode));
    printSuccess();
}else{
    printFailure();
}
?>