<?php

include("SearchEngine.php");
$json =json_decode( file_get_contents('php://input'),true );
$keywords=$json["keywords"];

echo GetSynonyms($keywords);

?>