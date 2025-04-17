<?php

include '../connect.php' ;

$email = filterRequest("email");
$verifycode = rand(10000 , 100000);

$pre = $con->prepare("UPDATE `users` SET `users_verifycode`= ? WHERE `users_email` = ?");
$pre->execute(array($verifycode, $email));

$count = $pre->rowCount();

if($count > 0 ){
    printSuccess();
}else{
    printFailure();
}
?>