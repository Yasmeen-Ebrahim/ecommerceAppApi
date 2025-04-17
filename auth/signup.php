<?php

include '../connect.php' ;

$username = filterRequest("username");
$email = filterRequest("email");
$phone = filterRequest("phone");
$password = sha1($_POST["password"]);
$verifycode = rand(10000 , 100000);

$pre = $con->prepare("SELECT * FROM `users` WHERE `users_email` = ? OR `users_phone` = ?");
$pre->execute(array($email, $phone));

$count = $pre->rowCount();

if($count > 0 ){
    echo json_encode(array("status" => "failure" , "message" => "email or phone exists")) ;
}else{

$pre = $con->prepare("INSERT INTO `users` (`users_name` , `users_email` , `users_phone`, `users_password` , `users_verifycode`) VALUES (?, ?, ?, ? ,?)");
$pre->execute(array($username , $email , $phone , $password , $verifycode));

$count = $pre->rowCount();

if($count > 0){
    printSuccess();
}else{
    printFailure();
}
}

?>