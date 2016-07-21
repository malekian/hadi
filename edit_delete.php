<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php
 error_reporting(0);
$db_host="localhost";
$db_user="root";
$db_pass="";
$db_name="realestate";
$db_table="advertisement";
$connect = mysqli_connect("$db_host", "$db_user", "$db_pass", "$db_name");
mysqli_query($connect,"SET NAMES 'utf8'");
mysqli_query($connect,"SET character_set_connection='utf8'");
if(mysqli_connect_errno()){
	die("unable to connect".mysqli_connect_errno());
}
(is_numeric($_GET['ID'])) ? $ID = $_GET['ID'] : $ID = 1;
$result = mysqli_query($connect,"SELECT*FROM ".$db_table." WHERE id = $ID");
while($row = mysqli_fetch_array($result)):
$id= $row['id'];
$address=$row['address'];
echo"$address";
echo"<br>";
$caseee=$row['caseee'];
echo"$caseee";
echo"<br>";
$price=$row['price'];
echo"$price";
echo"<br>";
$name=$row['name'];
echo"$name";
echo"<br>";
$phone=$row['phone'];
echo"$phone";
echo"<br>";
$username=$row['username'];
echo"$username";
echo"<br>";
endwhile;
?>  
</body>
</html>