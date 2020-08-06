<?php
include_once("SearchEngine.php");
$json = json_decode(file_get_contents('php://input'),true);
echo ExtractImageAtt($json["Uri"]);

?>