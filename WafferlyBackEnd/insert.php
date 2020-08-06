<?php

include 'database_connection.php';
$con ->set_charset("utf8");

$input1 = $_POST['input_name1'];
$input2 = $_POST['input_name2'];
$input3 = $_POST['input_name3'];
$input4 = $_POST['input_name4'];
$input5 = $_POST['input_name5'];
$input6 = $_POST['input_name6'];
$input7 = $_POST['input_name7'];
$input8 = $_POST['input_name8'];
$input9 = $_POST['input_name9'];
$input10 = $_POST['input_name10'];
$input11 = $_POST['input_name11'];


$stripped1 = preg_replace('/\s/','',$input1);
$stripped2= preg_replace('/\s/','', $input2);
$stripped3 = preg_replace('/\s/','',$input3);
$stripped4= preg_replace('/\s/','', $input4);
$stripped5 = preg_replace('/\s/','',$input5);
$stripped6= preg_replace('/\s/','', $input6);
$stripped7 = preg_replace('/\s/','',$input7);
$stripped8 = preg_replace('/\s/','', $input8);
$stripped9 = preg_replace('/\s/','',$input9);
$stripped10= preg_replace('/\s/','', $input10);
$stripped11 = preg_replace('/\s/','',$input11);

$inputs = [$stripped1,$stripped2,$stripped3,$stripped4,$stripped5,$stripped6,$stripped7,$stripped8,$stripped9,$stripped10,$stripped11];


$word1 = $_POST['word1'];
$word2 = $_POST['word2'];
$word3 = $_POST['word3'];
$word4 = $_POST['word4'];
$word5 = $_POST['word5'];
$word6= $_POST['word6'];
$word7 = $_POST['word7']; 
$word8 = $_POST['word8'];
$word9 = $_POST['word9'];
$word10 = $_POST['word10'];
$word11 = $_POST['word11'];

$Vaues = [$word1,$word2,$word3,$word4,$word5,$word6,$word7,$word8,$word9,$word10,$word11];
//$words = [];
 foreach ($inputs as $word) {
  
    $qry1 = "SELECT * FROM `words` WHERE `word` = '$word'";
    $result1= mysqli_query($con, $qry1);
    $count = mysqli_num_rows($result1); 
    //echo $count;
   
    while($info = mysqli_fetch_array( $result1 ))
        {
       
        $ID[] = $info['ID'];
        }
    
    }
   for ($i=0; $i <count($ID) ; $i++) { 
      if(!empty($Vaues[$i])){
         $words[$ID[$i]] = $Vaues[$i];
      }
  

   }
  
 
        $w = 1;
        $num =0;

        for ($i=0; $i <count($inputs) ; $i++) { 
          $is_arabic = preg_match('/\p{Arabic}/u', $Vaues[$i]);
          if($is_arabic == 1){
          if(!empty($Vaues[$i])){

            

            

             
        if ( strpos( $Vaues[$i], 'أ' ) !== false ) {
           
          $Vaues[$i] = str_replace('أ', 'ا', $Vaues[$i]);
         
        
        } elseif( strpos( $Vaues[$i], 'إ' ) !== false ) {
          $Vaues[$i] = str_replace('إ', 'ا', $Vaues[$i]);
                
        }
        elseif( strpos( $Vaues[$i], 'آ' ) !== false ) {
          $Vaues[$i] = str_replace('آ', 'ا', $Vaues[$i]);
              
              }
      
              elseif( strpos( $Vaues[$i], 'ة' ) !== false ) {
                $Vaues[$i] = str_replace('ة', 'ه',$Vaues[$i]);
                
                }
                elseif( strpos( $Vaues[$i], 'ئ' ) !== false ) {
                  $Vaues[$i] = str_replace('ئ', 'ي',$Vaues[$i]);
                
                }
                elseif( strpos( $Vaues[$i], 'ؤ' ) !== false ) {
                  $Vaues[$i] = str_replace('ؤ', 'و',$Vaues[$i]);
                
                }

             

           $word1 = $inputs[$i];
           $word2 =$Vaues[$i];

           $qry1 = "SELECT  * FROM `words` WHERE `word` = '$word2'";
           $result1= mysqli_query($con, $qry1);
           $count = mysqli_num_rows($result1);
           $info = mysqli_fetch_array($result1);
             

         if($count == 0){ // if not found
      
          $qry2 = "SELECT * FROM `words`";
          $result2 =  mysqli_query($con, $qry2);
          $count1 = mysqli_num_rows($result2);
           
           $count1 = $count1+2;
           $qry3= "INSERT INTO  `words` (`ID`,`word`) VALUES('".$count1."','".$word2."')";
           $result3 = mysqli_query($con, $qry3);
      
           
            $qry4 = "SELECT  * FROM `words` WHERE `word` = '$word1'";
            $result4 = mysqli_query($con, $qry4);
            $info = mysqli_fetch_array($result4);

            $key = $info['ID'];
            
            $qry5 = "INSERT INTO  `synonyms` (`ID1`,`ID2`,`Weight`) VALUES('".$key."','".$count1."','".$w."')";
            $result5 = mysqli_query($con, $qry5);

            $qry51 = "INSERT INTO  `synonyms` (`ID1`,`ID2`,`Weight`) VALUES('".$count1."','".$key."','".$w."')";
            $result51 = mysqli_query($con, $qry51);

    

          
           } // end if 

           elseif($count > 0){ // if found

            $qry6 = "SELECT  * FROM `words` WHERE `word` = '$word1'";
            $result6 = mysqli_query($con, $qry6);
            $info1 = mysqli_fetch_array($result6);

            $qry7 = "SELECT  * FROM `words` WHERE `word` = '$word2'";
            $result7 = mysqli_query($con, $qry7);
            $info2 = mysqli_fetch_array($result7);
            

            $num1 = $info1['ID'];
            $num2 = $info2['ID'];
           

            $qry8 = "SELECT  * FROM `synonyms` WHERE `ID1` = '$num1' AND `ID2` = '$num2'";
            $result8 = mysqli_query($con, $qry8);
            

            $count1 = mysqli_num_rows($result8);

            if ($count1 == 0) { // if not found

            $qry9 = "INSERT INTO  `synonyms` (`ID1`,`ID2`,`Weight`) VALUES('".$num1."','".$num2."','".$w."')";
            $result9 = mysqli_query($con, $qry9);

            
             
            } // end not found


            elseif($count1 > 0){ // if found

            $qry10 = "SELECT  * FROM `words` WHERE `word` = '$word1'";
            $result10 = mysqli_query($con, $qry10);
            $info3 = mysqli_fetch_array($result10);

            $qry11 = "SELECT  * FROM `words` WHERE `word` = '$word2'";
            $result11 = mysqli_query($con, $qry11);
            $info4 = mysqli_fetch_array($result11);
            

            $num1 = $info3['ID'];
            $num2 = $info4['ID'];
            

            $qry12 = "SELECT `Weight` FROM `synonyms` WHERE `ID1` = '$num1' AND `ID2` = '$num2'";
            $result12 = mysqli_query($con, $qry12);
            $info5 = mysqli_fetch_array($result12);


            $count3 = 1+$info5['Weight'];
            $qry13 = "UPDATE `synonyms` SET `Weight`='$count3' WHERE `ID1` = '$num1' AND `ID2` = '$num2'";
            $result13 = mysqli_query($con, $qry13);

            } // end found


            //---------------------------------------------------------------------------

            

            $qry81 = "SELECT  * FROM `synonyms` WHERE `ID1` = '$num2' AND `ID2` = '$num1'";
            $result81 = mysqli_query($con, $qry81);
            

            $count11 = mysqli_num_rows($result81);

            if ($count11 == 0) { // if not found

            $qry91 = "INSERT INTO  `synonyms` (`ID1`,`ID2`,`Weight`) VALUES('".$num2."','".$num1."','".$w."')";
            $result91 = mysqli_query($con, $qry91);

            
             
            } // end not found


            elseif($count11 > 0){ // if found

              $qry100 = "SELECT  * FROM `words` WHERE `word` = '$word1'";
              $result100 = mysqli_query($con, $qry100);
              $info33 = mysqli_fetch_array($result100);
  
              $qry111 = "SELECT  * FROM `words` WHERE `word` = '$word2'";
              $result111 = mysqli_query($con, $qry111);
              $info44 = mysqli_fetch_array($result111);
              
  
              $num1 = $info33['ID'];
              $num2 = $info44['ID'];
              
  
              $qry122 = "SELECT `Weight` FROM `synonyms` WHERE `ID1` = '$num2' AND `ID2` = '$num1'";
              $result122 = mysqli_query($con, $qry122);
              $info55 = mysqli_fetch_array($result122);
  
  
              $count33 = 1+$info55['Weight'];
              $qry133 = "UPDATE `synonyms` SET `Weight`='$count33' WHERE `ID1` = '$num2' AND `ID2` = '$num1'";
              $result133 = mysqli_query($con, $qry133);
  
              } // end found


           } // end if 




          }
           
          }
        }

      mysqli_close($con); 


?>


<html>

<head>  
<title>استبانة المرادفات</title>
<meta charset="UTF-8">

<style>

*{
    font-family: Roboto,Arial,sans-serif;
}
#a{
   
    height:100%;
    width:auto;
    background-color:#ede7f6 ;
    padding:3%;
    text-align:center;
    
}


h1{
    text-align:right;
    margin-right:3%;
    

}

#c{
    height:auto;
    width:53%;
    /* margin-left:18%; */
    background-color:#ffffff ;
    border-style: solid;
    border-color: rgb(103, 58, 183);
    border-radius: 25px;
    margin-left:27%; 
    font-size:90%;
    text-align:center;
    margin-top:-1%;
    

}











</style>

</head>


<body>






<div id="c">

<h1>
جمع المرادفات
<img src="waffer.jpg"  width="95" height="85">
</h1> 

<h2>شكرا لكم</h2>
</div>






</body>



</html>

