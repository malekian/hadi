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
  <p><input name="register" type="submit"  value="register" /></p>
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
error_reporting(0);
if($_POST['register']){
	if($_POST['username'] && $_POST['password']){
       $username=mysql_real_escape_string($_POST['username']);
       $password=mysql_real_escape_string(hash("sha512",$_POST['password']));
	   $check = mysql_fetch_array(mysql_query("SELECT * FROM `signup` WHERE `username`='$username'"));
	   if ($check !='0'){
			die("That username is already exist! Try  <i>$username" . rand(1,50) ."</i> instead! <a href='signup.php'>&larr;Back</a>");
		}
		if (!ctype_alnum($username)){
			die("User name contains speacial characters! only numbers and letters are premitted <a href='signup.php'>&larr;Back</a>");
		}
		if (strlen($username)>20){
			die("User must not contain more that 20 character!<a href='signup.php'>&larr;Back</a>");
		
		}
		$salt=hash("sha512", rand() . rand() . rand());
		mysql_query("INSERT INTO `signup` (`username`,`password`,`salt`) VALUES ('$username','$password','$salt')");
		setcookie("c_user",hash("sha512",$username),time()+24*60*60,"/");
		setcookie("c_salt",$salt,time()+24*60*60,"/");
        die("Your account has been created and now you logged in.");
	}
}

?>
</body>
</html>
