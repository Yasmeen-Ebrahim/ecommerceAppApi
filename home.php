<?php

include "connect.php" ;

$allData = array();

//categories
$pre = $con->prepare("SELECT * FROM `categories`");
$pre->execute();
$categoriesdata = $pre->fetchAll(PDO::FETCH_ASSOC);

//items
$pre = $con->prepare("SELECT * FROM `itemsview`");
$pre->execute();
$itemsdata = $pre->fetchAll(PDO::FETCH_ASSOC);

$allData['status'] = "success" ;
$allData['categories'] = $categoriesdata ;
$allData['items'] = $itemsdata ;

echo json_encode($allData);

?>