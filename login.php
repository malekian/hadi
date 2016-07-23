<!doctype html>
<html>
<head>
</head>
<body>
<form action="" method="POST" >
  username:<br>
  <input type="text" name="username"><br>
  password:<br>
  <input  type="password" name="password"></br>
  <p><input name="login" type="submit" id="submit" value="Login" /></p>
  	<input name="logout" type="submit"  value="Logout" />
  No account?<a href="signup.php">sign up</a>
</form>
<!--checkconnection-->
<?php
error_reporting(0);
$db_host="localhost";
$db_user="root";
$db_pass="";
$db_name="realestate";
$db_table="signup";
$connect = mysql_connect("$db_host", "$db_user", "$db_pass") or die("could not connect to the server");
mysql_select_db("realestate",$connect) or die("could not connect to the database");
?>
<!--insert data to database-->
<?php

if($_POST['login']){
	if($_POST['username'] && $_POST['password']){
       $username=mysql_real_escape_string($_POST['username']);
       $password=mysql_real_escape_string(hash("sha512",$_POST['password']));
       $user=mysql_fetch_array(mysql_query("SELECT*FROM `signup` WHERE `username`='$username'")); 
		if ($user=='0'){
			die("That username does not exist! Try making <i>$username</i> today! <a href='login.php'>&larr;Back</a>");
		}
		if ($user['password']!=$password){
			die("Incorrect password  <a href='login.php'>&larr;Back</a>");
		}
		$salt=hash("sha512", rand() . rand() . rand());
		setcookie("c_user",$username,time()+24*60*60,"/");
		setcookie("c_salt",$salt,time()+24*60*60,"/");
		$userID=$user['id'];
		mysql_query("UPDATE `signup` SET `salt`='$salt' WHERE `id`='$userID'");
		
		if ($_GET['last_page']) {
			header("Location: http://" . $_GET['lastpage']);
		} else {
			echo"you are logged in";
			echo"<br>";
		}
	}
}	
if($_POST['logout']){
	setcookie("c_salt","",time()-24*60*60,"/");
	setcookie("c_user","",time()-24*60*60,"/");
	die("you are logged out");
}
$saltt=$_COOKIE['c_salt'];
if (!empty($saltt)){
include "algor.php";
if ($logged==true){
	die("You are already logged in.");
}
}
?>
</body>
</html>
