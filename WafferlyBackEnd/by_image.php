<?php

// require 'autoload.php';
// use Kreait\Firebase\Factory;
// use Kreait\Firebase\ServiceAccount;
// use Google\Cloud\Storage\StorageClient;
// use Google\Cloud\Vision\VisionClient;
// $vision = new VisionClient(['keyFile' => json_decode(file_get_contents("ivory-signer-267012-56b31bc7521e.json"), true)]);
// $json = json_decode(file_get_contents('php://input'),true);

// $storage = new StorageClient([
//     'projectId' => 'ivory-signer-267012',
// ]);
// $bucket = $storage->bucket('ivory-signer-267012.appspot.com');
// $object = $bucket->object($imageUri);
// $familyPhotoResource = $object;

// $image = $vision->image($object, 
//     [
//      'LABEL_DETECTION',
//     'LOGO_DETECTION',
// "TEXT_DETECTION"    ]);

// $result = $vision->annotate($image);

// $labels = $result->labels();
// $logos = $result->logos();
// $fullText = $result->text();
// $syn = array();
// $re="";$logo = "";$l=array();$logore="";$re2="";
// $logos2="";
// $counter = 0;
// if ($logos){
//     foreach ($logos as $logo){
//         if(($logo->info()['score'] * 100)>=90){
//     $re2= ucfirst($logo->info()['description']);
//     array_push($l,$re2);
   
// }
        
//     }

// foreach ($l as $logo2){
//     if( $counter == count( $l ) - 1) {
//         $logos2.=$logo2;
//     }else {
// $logos2.=$logo2." ";}
// $counter = $counter+1;
// }
    
// }


// $keywords2="";
// $counter = 0;
// if($labels){
// foreach ($labels as $label){
//     if(($label->info()['score'] * 100)>=90){
//   $re = ucfirst($label->info()['description']);
// array_push($syn,$re);

// }}
// foreach ($syn as $keyword){
//     if( $counter == count( $syn ) - 1) {
//         $keywords2.=$keyword;
//     }else {
// $keywords2.=$keyword." ";}
// $counter = $counter+1;
// }
// }

// $syn = array();
// $text="";
//     $i=0;
// if($fullText){
//     foreach ($fullText as $texts){
//     $re = ucfirst($texts->info()['description']);
//     array_push($syn,$re);
//     }

//     for ($i=0; $i<2 ;$i++){
//         if( $i == 1) {
//             $text.=$syn[$i];
//         }else {
//     $text.=$syn[$i]." ";}
//     }
//     $syn2 = explode(" ",$text);
//     foreach($syn2 as $kk){
//     }
//     $text="";
//     for ($i=0; $i<2 ;$i++){
//         if( $i == 1) {
//             $text.=$syn2[$i];
//         }else {
//     $text.=$syn2[$i]." ";}
//     } 
// }
    
//      echo SearchByKeywords ($keywords2,$text,$logos2);

 
require 'autoload.php';
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Google\Cloud\Storage\StorageClient;
use Google\Cloud\Vision\VisionClient;
$vision = new VisionClient(['keyFile' => json_decode(file_get_contents("ivory-signer-267012-56b31bc7521e.json"), true)]);
$json = json_decode(file_get_contents('php://input'),true);

// $imageID= "06b308e0-96be-437a-b140-d7212170b15a";
   //echo json_encode(($json['Uri']));
$storage = new StorageClient([
    'projectId' => 'ivory-signer-267012',
]);
//regal-sun-267821-901fdc38da32.json
$bucket = $storage->bucket('ivory-signer-267012.appspot.com');
$object = $bucket->object($imageUri);
//echo json_encode($json['Uri']);
$familyPhotoResource = $object;

//print_r( $object);
$image = $vision->image($object, 
    [
     'LABEL_DETECTION',
    'LOGO_DETECTION',
"TEXT_DETECTION"    ]);

$result = $vision->annotate($image);

$labels = $result->labels();
$logos = $result->logos();
$fullText = $result->text();
$syn = array();
$re="";$logo = "";$l=array();$logore="";$re2="";
$logos2="";
$counter = 0;
if ($logos){
    foreach ($logos as $logo){
        if(($logo->info()['score'] * 100)>=90){
    $re2= ucfirst($logo->info()['description']);
    array_push($l,$re2);
    // break;
  // echo json_encode(number_format($logo->info()['score'] * 100 , 2));

}
        
    }

// echo json_encode($syn);
foreach ($l as $logo2){
    if( $counter == count( $l ) - 1) {
        $logos2.=$logo2;
    }else {
$logos2.=$logo2." ";}
$counter = $counter+1;
}
    
}


$keywords2="";
$counter = 0;
if($labels){
foreach ($labels as $label){
    if(($label->info()['score'] * 100)>=90){
  $re = ucfirst($label->info()['description']);
array_push($syn,$re);

//echo json_encode( number_format($label->info()['score'] * 100 , 2));
}}
// echo json_encode($syn);
foreach ($syn as $keyword){
    if( $counter == count( $syn ) - 1) {
        $keywords2.=$keyword;
    }else {
$keywords2.=$keyword." ";}
$counter = $counter+1;
}
}



// echo $keywords2."<br>";

$syn = array();
$text="";
    $i=0;
if($fullText){
    foreach ($fullText as $texts){
    $re = ucfirst($texts->info()['description']);
    array_push($syn,$re);
    //echo json_encode( number_format($label->info()['score'] * 100 , 2));
    }

    
    // echo json_encode($syn);
    for ($i=0; $i<2 ;$i++){
        if( $i == 1) {
            $text.=$syn[$i];
        }else {
    $text.=$syn[$i]." ";}
    }
    $syn2 = explode(" ",$text);
    foreach($syn2 as $kk){
        // echo $kk."<br>";
    }
    $text="";
    for ($i=0; $i<2 ;$i++){
        if( $i == 1) {
            $text.=$syn2[$i];
        }else {
    $text.=$syn2[$i]." ";}
    } 
}
    
    
     

  


     echo SearchByKeywords ($keywords2,$text,$logos2);

?>