<html>

<head>  
<title>استبانة المرادفات</title>
<meta charset="UTF-8">



<style>

*{
    font-family: Roboto,Arial,sans-serif;
}
#a{
   
    height:auto;
    width:auto;
    background-color:#ede7f6 ;
    padding:3%;
    text-align:center;
    
}

#b{
    height:auto;
    width:53%;
    background-color:#ffffff ;
    border-style: solid;
    border-color: rgb(103, 58, 183);;
    border-radius: 25px;
    margin-left:27%; 
    font-size:200%;
    text-align:center;
    margin-top:5%;
   

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




input[type=text]{
  
  width: 40%;
    background: transparent;
    border: none;
    border-bottom: 1px solid #000000;
    margin-bottom: 7%;
   text-align:center;
   font-size:100%;
   
    
    
  
}

input[type=submit] {
  width: 25%;
  background-color: #9999ff;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4%;
  cursor: pointer;
  font-size:200%;
  margin-top:3%;
  margin-left:4%

}

h2{
  color:red;
  font-size:120%;
  margin-top:1%;
  margin-bottom:1%;
  margin-left:37%;


}


input[type=submit]:hover {
  background-color: #8080ff;
}
</style>

</head>


<body>



<div id="a">


<div id="c">

<h1>
جمع المرادفات
<img src="waffer.jpg"  width="95" height="85">
</h1> 

<p>السلام عليكم ورحمة الله وبركاته

نحن طالبات جامعة الملك سعود تخصص تقنية المعلومات ، نهدف إلى عمل تطبيق للهواتف الذكية قائم على مقارنة الأسعار لأكثر من متجر إلكتروني بحيث ننمي ثقافة الادخار للأشخاص.
نرجو منك/منكِ المساهمة في تعبئة هذه الاستبانة لمساعدتنا كمطورين لمعرفة أكبر قدر من المرادفات المحتملة للمنتج وذلك لتوسيع مجال البحث للمنتج.

شاكرين لكم / لكن حسن تعاونكم.</p>
</div>

<h2>مفردة واحدة لكل كلمة**</h2>
<h2>في حال لا يوجد لديك مرادفة لكلمة يمكنك تركها **</h2>
<form action="insert.php" method="post" >

<?php
include 'database_connection.php';
$con ->set_charset("utf8");
$qry="SELECT  * FROM `words` order by RAND() limit 12";
$result= mysqli_query($con, $qry);


if($result) {
    
    while($info = mysqli_fetch_array( $result ))
    {
   
    $output[] = $info['word'];
    
  
    }} 
 
  
?> 


<div id="b">
<h4><?php echo $output[0]?></h4>
<input type="text" name="word1" placeholder="إجابتك" >
</div>

<div id="b">
<h4><?php echo $output[1]?></h4>
<input  type="text" name="word2" placeholder="إجابتك" >
</div>

<div id="b">
<h4><?php echo $output[2]?></h4>
<input  type="text" name="word3" placeholder="إجابتك" >
</div>

<div id="b">
<h4><?php echo $output[3]?></h4>
<input  type="text" name="word4" placeholder="إجابتك" >
</div>

<div id="b">
<h4><?php echo $output[4]?></h4>
<input  type="text" name="word5" placeholder="إجابتك" >
</div>

<div id="b">
<h4><?php echo $output[5]?></h4>
<input  type="text" name="word6" placeholder="إجابتك" >
</div>

<div id="b">
<h4><?php echo $output[6]?></h4>
<input  type="text" name="word7" placeholder="إجابتك" >
</div>

<div id="b">
<h4><?php echo $output[7]?></h4>
<input  type="text" name="word8" placeholder="إجابتك" >
</div>

<div id="b">
<h4><?php echo $output[8]?></h4>
<input  type="text" name="word9" placeholder="إجابتك" >
</div>

<div id="b">
<h4><?php echo $output[9]?></h4>
<input  type="text" name="word10" placeholder="إجابتك" >
</div>

<div id="b">
<h4><?php echo $output[10]?></h4>
<input  type="text" name="word11" placeholder="إجابتك" >
</div>



<input type='hidden' name="input_name1" value=" <?php  echo $output[0]; ?>" >
<input type='hidden' name="input_name2" value=" <?php  echo $output[1]; ?>" >
<input type='hidden' name="input_name3" value=" <?php  echo $output[2]; ?>" >
<input type='hidden' name="input_name4" value=" <?php  echo $output[3]; ?>" >
<input type='hidden' name="input_name5" value=" <?php  echo $output[4]; ?>" >
<input type='hidden' name="input_name6" value=" <?php  echo $output[5]; ?>" >
<input type='hidden' name="input_name7" value=" <?php  echo $output[6]; ?>" >
<input type='hidden' name="input_name8" value=" <?php  echo $output[7]; ?>" >
<input type='hidden' name="input_name9" value=" <?php  echo $output[8]; ?>" >
<input type='hidden' name="input_name10" value=" <?php  echo $output[9]; ?>" >
<input type='hidden' name="input_name11" value=" <?php  echo $output[10]; ?>" >

<?php mysqli_close($con); ?>


<input type="submit" value="إرسال">
</form>




</div>




</body>



</html>
