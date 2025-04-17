<?php

include '../connect.php' ;

$userid = filterRequest("userid");

$pre = $con->prepare("SELECT itemsview.* , favorite.* FROM itemsview
INNER JOIN favorite ON favorite.favorite_itemsid = itemsview.items_id AND favorite.favorite_usersid = ?");
$pre->execute(array($userid));

$data = $pre->fetchAll(PDO::FETCH_ASSOC);

$count = $pre->rowCount();

if($count > 0 ){
    echo json_encode(array("status" => "success" , "data" => $data)); 
}else{
    printFailure();
}
?>