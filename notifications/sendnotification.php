<?php

include '../connect.php' ;

$notAuth = "" ;

//sendGCM("hi" , "welcome to our application" , "users" , "" , "") ;

$url = 'https://ecommerceproject-2c06f.firebasestorage.app';
//https://football-f559a.firebaseio.com
//https://xxxxx.firebaseio.com
//https://ecommerceproject-2c06f.firebasestorage.app
//https://ecommerceproject-2c06f.appspot.com

$fields = array(
    "to" => '/topics/' ."users",
    'priority' => 'high',
    'content_available' => true,

    'notification' => array(
        "body" =>  "ijwdorf",
        "title" =>  "jwvcwodkvwd",
        "click_action" => "FLUTTER_NOTIFICATION_CLICK",
        "sound" => "default"

    ),
    'data' => array(
        "pageid" => "",
        "pagename" => ""
    )

);


$fields = json_encode($fields);
$headers = array(
    'Authorization: key=' ."key=AAAA7j6oqxo:APA91bEtaxur7EYPZqZlnooc6heVRwTrM2HT59cIE6bYLz898VPGbKtd7JQ8SR7qfHOcTxT1NuPvimYPmOs6Zq0w2XtMs0oEqG2qkwBqmTLH5ByMOr4U9f353QjWqKVFf-Mx7xbYOuL-",
    'Content-Type: application/json'
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

$result = curl_exec($ch);
return $result;
curl_close($ch);



echo "Not Auth" ;

?>