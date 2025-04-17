<?php

include '../connect.php' ;

$email = filterRequest("email");
$password = sha1($_POST["password"]);


$pre = $con->prepare("SELECT * FROM `users` WHERE `users_email` = ? AND `users_password` = ?");
$pre->execute(array($email, $password));

$data = $pre->fetch(PDO::FETCH_ASSOC);

$count = $pre->rowCount();

if($count > 0 ){
    echo json_encode(array("status" => "success" , "data"=> $data));
}else{
    printFailure();
}
?>