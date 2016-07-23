<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/pop-op.css">
</head>
<body>
<!--start infowmation box-->
<div id="agahi">
<button id="myBtn" class="btn circular">ثبت رایگان آگهی</button>
<div class="dropdown">
  <input class="dropdown-toggle" type="text">
  <div class="dropdown-text">پنل کاربری</div>
  <ul class="dropdown-content">
    <li><a href="cookieresult.php">پسندیده ها</a></li>
    <li><a href="#">آگهی های من</a></li>
    <li><a href="login.php">ورود</a></li>
	 <li><a href="signup.php">ثبت نام</a></li>
  </ul>
</div>
</div>
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
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
	 <div class="modal-header-word">
      <span class="close">×</span>
      <h2>انتخاب نوع آگهی</h2>
	  </div>
    </div>
    <div class="modal-body">
      <form action="" method="post">
<p dir="rtl"><input onchange="this.form.submit()" value="1" type="checkbox" name="sign[1]" /> املاک </p>   <br>
<p dir="rtl"><input onchange="this.form.submit()" value="2" type="checkbox" name="sign[2]" /> وسایل نقلیه  </p>   <br>
<p dir="rtl"><input onchange="this.form.submit()" value="3" type="checkbox" name="sign[3]" /> لوازم الکترونیکی  </p>  <br>
<p dir="rtl"><input onchange="this.form.submit()" value="4" type="checkbox" name="sign[4]" /> آموزشی و سرگرمی  </p> <br>
<p dir="rtl"><input onchange="this.form.submit()" value="5" type="checkbox" name="sign[5]" /> پوشاک و جواهرآلات  </p>  <br>
<p dir="rtl"><input onchange="this.form.submit()" value="6" type="checkbox" name="sign[6]" /> لوازم خانگی  </p>  <br>
<p dir="rtl"><input onchange="this.form.submit()" value="7" type="checkbox" name="sign[7]" /> استخدام </p>   <br>
</form>
    </div>
  </div>

</div>

<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
<?php
if (isset($_POST['sign'][1]))
    header("Location: http://localhost/contact.php");
elseif(isset($_POST['sign'][2]))
    header("Location: http://localhost/contact_mashin.php");
elseif(isset($_POST['sign'][3]))
    header("Location: http://localhost/contactelectric.php");
elseif(isset($_POST['sign'][4]))
    header("Location: http://localhost/contacttafrih.php");
elseif(isset($_POST['sign'][5]))
    header("Location: http://localhost/contactpooshak.php");
elseif(isset($_POST['sign'][7]))
    header("Location: http://localhost/contactestekhdam.php");
	?>
	<?php
}	
else {
?>
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
	 <div class="modal-header-word">
      <span class="close">×</span>
      <h2>ورود به سایت</h2>
	  </div>
    </div>
    <div class="modal-body">
	<form action="" method="POST" >
  username:<br>
  <input type="text" name="username"><br>
  password:<br>
  <input  type="password" name="password"></br>
  <p><input name="login" type="submit" id="submit" value="Login" /></p>
  No account?<a href="signup.php">sign up</a>
</form>
<?php
error_reporting(0);
$db_host="localhost";
$db_user="root";
$db_pass="";
$db_name="realestate";
$db_table="signup";
$connect = mysql_connect("$db_host", "$db_user", "$db_pass") or die("could not connect to the server");
mysql_select_db("realestate",$connect) or die("could not connect to the database");
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
		echo"you are logged in";
		echo"<br>";
		}
}	
?>
    </div>
  </div>
</div>
<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

<?php
}
?>
</body>
</html>