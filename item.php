<?php


include "connect.php" ;

$categoryid = filterRequest("categoryid") ;
$userid = filterRequest("userid") ;


$pre = $con->prepare("SELECT itemsview.* , 1 as favorite ,
round(itemsview.items_price - itemsview.items_price * itemsview.items_discount / 100)
 AS discount_price  FROM itemsview
INNER JOIN favorite on itemsview.items_id = favorite.favorite_itemsid
 AND favorite.favorite_usersid = ? WHERE categories_id = ?

UNION ALL

SELECT itemsview.*, 0 AS favorite ,
round(itemsview.items_price - itemsview.items_price * itemsview.items_discount / 100)
AS discount_price  FROM itemsview
WHERE itemsview.items_id NOT IN (SELECT itemsview.items_id FROM itemsview
INNER JOIN favorite on itemsview.items_id = favorite.favorite_itemsid
AND favorite.favorite_usersid = ? ) AND categories_id = ?
");
$pre->execute(array($userid, $categoryid , $userid , $categoryid));
$itemsdata = $pre->fetchAll(PDO::FETCH_ASSOC);

$count  = $pre->rowCount();
    if ($count > 0){
        echo json_encode(array("status" => "success", "itemsdata" => $itemsdata));
    } else {
        echo json_encode(array("status" => "failure"));
    }
    return $count;

// $pre = $con->prepare("SELECT itemsview.* , 1 as favorite ,
//  (itemsview.items_price - (itemsview.items_price * itemsview.items_discount / 100))
//  AS discount_price  FROM itemsview
// INNER JOIN favorite on itemsview.items_id = favorite.favorite_itemsid
//  AND favorite.favorite_usersid = ? WHERE categories_id = ?

// UNION ALL

// SELECT itemsview.*, 0 AS favorite , (itemsview.items_price - (itemsview.items_price * itemsview.items_discount /  100)) 
// AS discount_price  FROM itemsview
// WHERE itemsview.items_id NOT IN (SELECT itemsview.items_id FROM itemsview
// INNER JOIN favorite on itemsview.items_id = favorite.favorite_itemsid
// AND favorite.favorite_usersid = ? ) AND categories_id = ?
// ");
// $pre->execute(array($userid, $categoryid , $userid , $categoryid));
// $itemsdata = $pre->fetchAll(PDO::FETCH_ASSOC);

// $count  = $pre->rowCount();
//     if ($count > 0){
//         echo json_encode(array("status" => "success", "itemsdata" => $itemsdata));
//     } else {
//         echo json_encode(array("status" => "failure"));
//     }
//     return $count;


?>