<?php

include "../connect.php" ;

$userid = filterRequest("userid") ;

$pre = $con->prepare("SELECT itemsview.* , 1 as favorite ,
round(itemsview.items_price - itemsview.items_price * itemsview.items_discount / 100)
  AS discount_price  FROM itemsview
INNER JOIN favorite on itemsview.items_id = favorite.favorite_itemsid
 AND favorite.favorite_usersid = $userid WHERE items_discount != 0

UNION ALL

SELECT itemsview.*, 0 AS favorite ,
round(itemsview.items_price - itemsview.items_price * itemsview.items_discount / 100)
AS discount_price  FROM itemsview
WHERE itemsview.items_id NOT IN (SELECT itemsview.items_id FROM itemsview
INNER JOIN favorite on itemsview.items_id = favorite.favorite_itemsid
AND favorite.favorite_usersid = $userid ) AND items_discount != 0
");

$pre->execute();
$discountitemsdata = $pre->fetchAll(PDO::FETCH_ASSOC);

$count  = $pre->rowCount();
    if ($count > 0){
        echo json_encode(array("status" => "success", "discountItemsData" => $discountitemsdata));
    } else {
        echo json_encode(array("status" => "failure"));
    }
    return $count;



?>