<!doctype html>
<html>
<head>
<title>ارسال ایمیل</title>
<meta charset="utf-8">
</head>
<body>
<?php
$db_host="localhost";
$db_user="root";
$db_pass="";
$db_name="realestate";
$connect = mysqli_connect("$db_host", "$db_user", "$db_pass", "$db_name");
mysqli_query($connect,"SET NAMES 'utf8'");
mysqli_query($connect,"SET character_set_connection='utf8'");
if(mysqli_connect_errno()){
	die("unable to connect".mysqli_connect_errno());
}
$quer = "SELECT*FROM realestate WHERE  date < DATE_SUB(NOW() , INTERVAL 1 DAY)";
$query=mysqli_query($connect,$quer)
or die(mysqli_error());
while($row = mysqli_fetch_array($query)):
$mailto=$row['email'];
$subject = "test";
$txt = "Hello!";
$headers = "From: telejarat.ir" . "\r\n" .
"CC: somebodyelse@example.com";
mail($mailto,$subject,$txt,$headers);
endwhile;
?>
 </body>
 </html>