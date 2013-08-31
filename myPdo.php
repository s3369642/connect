<?php

$db = array(
"connection"=>"mysql:host=localhost; dbname=winestore",
"host"=>"localhost",
"user"=>"webadmin",
"password"=>"root"
);

$dbconn = new PDO($db['connection'],$db['user'],$db['password']);

?>
