﻿<!doctype html>
<html>
<head>
<script src="//code.jquery.com/jquery-3.1.0.min.js"></script>
</head>
<body>
<!--check login connection-->
<?php
error_reporting(0);
$db_host="localhost";
$db_user="root";
$db_pass="";
$db_name="realestate";
$db_table="signup";
$connect = mysql_connect("$db_host", "$db_user", "$db_pass") or die("could not connect to the server");
mysql_select_db("realestate",$connect) or die("could not connect to the database");
include "algor.php";
if ($logged==true){
	?>
	<form action="" method="POST" >
  apartmentadress:<br>
  <input type="text" name="apartmentadress"><br>
  case:<br>
  <select name="case">
  <option value="">please choose</option>
  <option value="sell">sell</option>
  <option value="rent">rent</option>
  </select><br>
  apartment price:<br>
  <input  name="price"></br>
  family name:<br>
  <input type="text" name="name"><br>
  phone number:<br>
  <input name="phone"><br>
  <p><input name="submit" type="submit" id="submit" value="submit" /></p>
</form>
<?php
}	
else {
	die("That username does not exist!  <a href='login.php'>&larr;Back</a>");
}
?>
<?php
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
?>
<!--insert data to database-->
<?php
$apartmentadress = !empty($_POST['apartmentadress']) ? $_POST['apartmentadress'] : '';	
$case = !empty($_POST['case']) ? $_POST['case'] : '';
$price = !empty($_POST['price']) ? $_POST['price'] : '';
$name = !empty($_POST['name']) ? $_POST['name'] : '';	
$phone = !empty($_POST['phone']) ? $_POST['phone'] : '';
if(isset($_POST['submit'])){
if ($stmt = mysqli_prepare($connect, "INSERT INTO $db_table VALUES ('', ?, ?, ?, ?, ?)"))
mysqli_stmt_bind_param($stmt, "sssss",
$apartmentadress,$case,$price,$name,$phone);
if(mysqli_stmt_execute($stmt))
    {
		$alert='<p>Information was sent</p>';
        echo "<font style ='font:14px/21px Arial,tahoma,sans-serif;color:red' >$alert</font>";
    }
    else
    {
        echo "Error occurred: " . mysqli_error($connect);
    }

    /* close statement */
	$id = mysqli_insert_id($connect);
	echo "New record has id: " . $id;
	setcookie("id", $value);
    mysqli_stmt_close($stmt);
}	
?>
</body>
</html>
