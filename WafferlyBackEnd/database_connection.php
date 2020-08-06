<?php
header ('Content-Type: text/html; charset=UTF-8');
$DB_HOST ='sl18.sahara.net.sa' ; 
$DB_USER= 'wafferly_wafferl' ; 
$DB_PASSWORD = '@R8WP811*zpnCt';
$DB_DATABASE = 'wafferly_Find_Synonyms';

$con =  mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD);
$db =  mysqli_select_db($con, $DB_DATABASE);





?>