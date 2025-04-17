<?php

include '../connect.php' ;


$email = filterRequest("email");
$password = sha1($_POST["password"]);

$pre = $con->prepare("UPDATE `users` SET `users_password` = ? WHERE `users_email` = ?");
$pre->execute(array($password, $email));

$count = $pre->rowCount();

if($count > 0 ){
    printSuccess();
}else{
    printFailure();
}
?>