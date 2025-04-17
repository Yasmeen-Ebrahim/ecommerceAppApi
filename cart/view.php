<?php

include '../connect.php' ;

$userid = filterRequest("userid");

$pre = $con->prepare("SELECT SUM(items.items_price - (items.items_price * items.items_discount / 100)) as itemprice ,
COUNT(items.items_id) as itemcount ,
cart.* , items.* FROM cart INNER JOIN items
WHERE cart.cart_itemsid = items.items_id AND cart.cart_usersid = ? AND cart.cart_orders = ?
GROUP BY cart.cart_itemsid , cart.cart_usersid");

$pre->execute(array($userid , 0));

$total = $con->prepare("SELECT SUM(items.items_price - (items.items_price * items.items_discount / 100)) as
 `totalitemprice` , COUNT(items.items_id) as `totalitemcount` FROM cart
  INNER JOIN items WHERE cart.cart_itemsid = items.items_id AND cart.cart_usersid = ? AND cart.cart_orders = ?
   GROUP BY cart.cart_usersid");

$total->execute(array($userid , 0));

$data = $pre->fetchAll(PDO::FETCH_ASSOC);
$pricecountdata = $total->fetchAll(PDO::FETCH_ASSOC);

$count = $pre->rowCount();

if ($count > 0){
    echo json_encode(array("status" => "success" , "data" => $data , "price&count" => $pricecountdata));
} else {
    echo json_encode(array("status" => "failure"));
}



?>