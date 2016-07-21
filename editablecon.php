<!doctype html>
<html>
<head>
<script src="//code.jquery.com/jquery-3.1.0.min.js"></script>
<script>
	function setCookie(cname, cvalue, exdays) {
		var d = new Date();
		d.setTime(d.getTime() + (exdays*24*60*60*1000));
		var expires = "expires="+d.toUTCString();
		document.cookie = cname + "=" + cvalue + "; " + expires;
	}

	function getCookie(cname) {
		var name = cname + "=";
		var ca = document.cookie.split(';');
		for(var i = 0; i < ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0) == ' ') {
				c = c.substring(1);
			}
			if (c.indexOf(name) == 0) {
				return c.substring(name.length, c.length);
			}
		}
		return "";
	}

	function checkCookie() {
		var user = getCookie("username");
		if (user != "") {
			alert("Welcome again " + user);
		} else {
			user = prompt("Please enter your name:", "");
			if (user != "" && user != null) {
				setCookie("username", user, 365);
			}
		}
	}
</script>
</head>
<body>
<!--check login connection-->
<?php
error_reporting(0);
$saltt=$_COOKIE['c_salt'];
$db_host="localhost";
$db_user="root";
$db_pass="";
$db_name="realestate";
$db_table="signup";
$connect = mysql_connect("$db_host", "$db_user", "$db_pass") or die("could not connect to the server");
mysql_select_db("realestate",$connect) or die("could not connect to the database");
$check = mysql_fetch_array(mysql_query("SELECT * FROM `signup` WHERE `salt`='$saltt'"));
$username=$check['username'];
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
<script>
	var form_str = "";
	$('form').submit(function() {
		form_str = JSON.stringify($(this).serialize());
		console.log(form_str);
	});
</script>
<?php
}	
else {
header("Location: login.php");
}
?>
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
$apartmentadress = !empty($_POST['apartmentadress']) ? $_POST['apartmentadress'] : '';	
$case = !empty($_POST['case']) ? $_POST['case'] : '';
$price = !empty($_POST['price']) ? $_POST['price'] : '';
$name = !empty($_POST['name']) ? $_POST['name'] : '';	
$phone = !empty($_POST['phone']) ? $_POST['phone'] : '';

if(isset($_POST['submit'])){
if ($stmt = mysqli_prepare($connect, "INSERT INTO advertisement VALUES ('', ?, ?, ?, ?, ? ,?)"))
mysqli_stmt_bind_param($stmt, "ssssss",
$apartmentadress,$case,$price,$name,$phone,$username);
if(mysqli_stmt_execute($stmt))
    {
			$id = mysqli_insert_id($connect);
	echo "New record has id: " . $id;

    }
    else
    {
        echo "Error occurred: " . mysqli_error($connect);
    }
/* second table  */
if ($stmt = mysqli_prepare($connect, "INSERT INTO post VALUES (?, ?)"))
mysqli_stmt_bind_param($stmt, "ss",
$username,$id);
if(mysqli_stmt_execute($stmt))
    {
			$id = mysqli_insert_id($connect);
	echo "New record has id: " . $id;
		header("Location: submitmassage.php");

    }
    else
    {
        echo "Error occurred: " . mysqli_error($connect);
    }
    /* close statement */


	
    mysqli_stmt_close($stmt);
}	
?>
</body>
</html>
