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

if($_POST['load-content']) {
	if($logged==true) {

?>
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
header("Location: http://localhost/real-estate/login.php");
}
}
?>