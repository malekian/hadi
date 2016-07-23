<?php
error_reporting(0);
include "algor.php";
$logged = false;
if($_POST['load-content']) {
	if($logged==true) {

?>
<div>Logged in: <?php echo $logged ?></div>
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
	 <div class="modal-header-word">
      <span class="close">×</span>
      <h2>choose your ad kind</h2>
	  </div>
    </div>
    <div class="modal-body">
      <form action="" method="post">
<p dir="rtl"><input onchange="this.form.submit()" value="1" type="checkbox" name="sign[1]" /> case1 </p>   <br>
<p dir="rtl"><input onchange="this.form.submit()" value="2" type="checkbox" name="sign[2]" /> case2</p>   <br>
<p dir="rtl"><input onchange="this.form.submit()" value="3" type="checkbox" name="sign[3]" /> case3</p>  <br>
<p dir="rtl"><input onchange="this.form.submit()" value="4" type="checkbox" name="sign[4]" />case4 </p> <br>
</form>
    </div>
  </div>

</div>
<?php

if (isset($_POST['sign'][1]))
    header("Location: http://localhost/contact.php");
elseif(isset($_POST['sign'][2]))
    header("Location: http://localhost/contact_mashin.php");
elseif(isset($_POST['sign'][3]))
    header("Location: http://localhost/contactelectric.php");
elseif(isset($_POST['sign'][4]))
    header("Location: http://localhost/contacttafrih.php");

} else {

?>
<div>Logged in: <?php echo $logged ?></div>
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
	 <div class="modal-header-word">
      <span class="close">×</span>
      <h2>login to site</h2>
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

}
}
?>