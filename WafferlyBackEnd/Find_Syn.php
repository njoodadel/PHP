<?php

include 'database_connection.php';
$con ->set_charset("utf8");

$is_arabic = preg_match('/\p{Arabic}/u', $keyword);
if($is_arabic == 1){
$k = 0;
if ( strpos( $keyword, 'أ' ) !== false ) {
     
    $keyword = str_replace('أ', 'ا', $keyword);
   
  
  } elseif( strpos( $keyword, 'إ' ) !== false ) {
          $keyword = str_replace('إ', 'ا', $keyword);
          
  }
  elseif( strpos( $keyword, 'آ' ) !== false ) {
          $keyword = str_replace('آ', 'ا', $keyword);
        
        }

        elseif( strpos( $keyword, 'ة' ) !== false ) {
            $keyword = str_replace('ة', 'ه', $keyword);
          
          }
          elseif( strpos( $keyword, 'ئ' ) !== false ) {
            $keyword = str_replace('ئ', 'ي', $keyword);
          
          }
          elseif( strpos( $keyword, 'ؤ' ) !== false ) {
            $keyword = str_replace('ؤ', 'و', $keyword);
          
          }

$qry1 = "SELECT * FROM `words` WHERE `word` = '$keyword' ";
$result1= mysqli_query($con, $qry1);

$count = mysqli_num_rows($result1);

if($count == 0){
    
    $qry4 = "SELECT * FROM `words`";
    $result4= mysqli_query($con, $qry4);
    $count = mysqli_num_rows($result4);

    $k = $count+2;
    $qry = "INSERT INTO  `words` (`ID`,`word`) VALUES('$k','".$keyword."')";
    $result = mysqli_query($con, $qry);
    
echo SearchByKeywords($keyword,"","");
    
}

elseif($count>0){
       
       $qry2 = "SELECT * FROM `words` WHERE  `word` = '$keyword'";
       $result2 = mysqli_query($con, $qry2);

        $info = mysqli_fetch_array( $result2);
        $i = $info["ID"];
        $qry3 = "SELECT * FROM `synonyms` WHERE `ID1` = $i";
        $result3 = mysqli_query($con, $qry3);
        $count = mysqli_num_rows($result3);
       
        while($info1 = mysqli_fetch_array( $result3)){
        
        if($info1['Weight'] >= 3)
          $ID[] = $info1['ID2'];
      }

      
      if(!empty($ID)){
        
        foreach($ID as $id){
        
          $qry5 = "SELECT * FROM `words` WHERE `ID` = $id";
          $result5 = mysqli_query($con, $qry5);
          $info2 = mysqli_fetch_array( $result5);

          
          
           $keyword .=" ";
           $keyword .= $info2['word'];
           $keyword .=" ";

        }
      }
        
        
        $qry4 = "SELECT * FROM `synonyms` WHERE `ID2` = $i";
        $result4 = mysqli_query($con, $qry4);
        $count = mysqli_num_rows($result4);
       
        while($info1 = mysqli_fetch_array( $result3)){
        
        if($info1['Weight'] >= 3)
          $ID[] = $info1['ID1'];
      }

      if(!empty($ID)){

        foreach($ID as $id){
        
          $qry5 = "SELECT * FROM `words` WHERE `ID` = $id";
          $result5 = mysqli_query($con, $qry5);
          $info2 = mysqli_fetch_array( $result5);

          
          if(strpos($keyword, $info2['word']) == false){
           $keyword .=" ";
           $keyword .= $info2['word'];
           $keyword .=" ";}

        }
      }


     echo SearchByKeywords($keyword,"","");
     
        }}
        elseif($is_arabic ==0){
        echo SearchByKeywords($keyword,"","");
         
        }


       

    
 
 


?>