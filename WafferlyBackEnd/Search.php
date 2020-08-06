<?php

include('simple_html_dom.php');
$products1 = [];
$products2 = [];

if ($text){ $products1 = Search($text,$logo);}
 if ($keywords) { $products2 = Search($keywords,$logo);}
$productsF = array_merge($products1,$products2);
$json=json_encode(SortByPrice($productsF));
echo $json;


  function Search($keywords2,$logo){
    if ($logo) {$keywords2 =$logo."+".$keywords2;}
    $ProductList = array();
$page = 0;$counter=0;
  for ($i=0; $i<2;$i++){
      $base = 'https://www.google.com/search?q='.urlencode($keywords2).'&start='.$page.'&tbm=shop&biw=1422&bih=642&gl=sa&h1=ar-SA';
 $curl = curl_init();
 curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
 curl_setopt($curl, CURLOPT_HEADER, TRUE);
  curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
 curl_setopt($curl, CURLOPT_URL, $base);
 curl_setopt($curl, CURLOPT_REFERER, $base);
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
 $str = curl_exec($curl);
 curl_close($curl);
// Create a DOM object
$html = new simple_html_dom();
 // Load HTML from a string
 $html->load($str);
    foreach($html->find('.u30d4') as $container){
      $product = new Product();
         if( $container->find('.rgHvZc',0)){
         $product->set_title ($container->find('.rgHvZc',0)->find('a',0)->plaintext);//title Done
         $product->set_link( $container->find('.rgHvZc',0)->find('a',0)->{'href'}); //link Done
         $product->set_price(price( $container->find('.dD8iuc .HRLxBb  ',0)->plaintext)); //price Done
          $product->set_image($container->find('div.oR27Gd',0)->find('img',0)->{'src'});//img Done 
         $product->set_rating(rating($container->find('div.m0amQc',0)));//rating Done
          $product->set_storeName(storeName($container));// store name Done 
          $product->set_reviews( reviews($container->find('div.d1BlKc',0))); //reviwes Done
  
           $ProductList[] = $product;   
    
     }
    }
    $page +=20;
  }
return SortByPrice($ProductList);
  }



function SortByPrice($ee){
  usort($ee, "cmp");  
  return $ee;
}

function cmp($a, $b) {
  return $a->price > $b->price;
}

function reviews($path){
  if($path ){
    $r = $path->find('span',5)->plaintext;
    $decoded_string = html_entity_decode($r, ENT_COMPAT | ENT_HTML401, "UTF-8");
    $res = preg_replace('/[^٠-٩0-9٫]/ui', "", $decoded_string);
    $western_arabic = array('0','1','2','3','4','5','6','7','8','9');
    $eastern_arabic = array('٠','١','٢','٣','٤','٥','٦','٧','٨','٩');
    $res = str_replace($eastern_arabic,$western_arabic, $res);
return $res;
    }
    else return '0';
}



function image($title){
  $response= file_get_html("https://serpapi.com/search.json?engine=google&q=".urlencode($title)."&location=Saudi+Arabia&google_domain=google.com.sa&gl=sa&hl=ar&ijn=0&tbm=isch&api_key=e1898ddac57114bf5b59e71f890bc10acbc3eaed467445d069bc5ac22100cc8d");
  $json =json_decode($response);
  return $json->{'images_results'}[0]->{'original'};
} 
function rating($path){
  if( $path){
    $str=$path->{'aria-label'};
     return explode(" ",$str)[0];
      }
      else return '0';
}

function price($path) {
    $decoded_string = html_entity_decode($path, ENT_COMPAT | ENT_HTML401, "UTF-8");
    $res = preg_replace('/[^٠-٩0-9٫]/ui', "", $decoded_string);
    $srting1=str_replace('٫','.',$res);
    $western_arabic = array('0','1','2','3','4','5','6','7','8','9');
    $eastern_arabic = array('٠','١','٢','٣','٤','٥','٦','٧','٨','٩');
    $res = str_replace($eastern_arabic,$western_arabic, $srting1);
    return $res;
}


function storeName($path) {
  $path1=$path->find('div.dD8iuc',1);
  $name='';
 if ($path1){
   $result=explode(' ',$path1->plaintext);
   unset($result[0]);
   unset($result[1]);
   unset($result[2]);
   foreach($result as $value){
     $name .= $value." ";
   }
   // echo $str."<br>";
     } else {
       $result=explode(' ',$path->find('div.dD8iuc',0)->plaintext);
       unset($result[0]);
       unset($result[1]);
       unset($result[2]);
       foreach($result as $value){
         $name .= $value." ";
       }
     }
     return $name;
}







?>
