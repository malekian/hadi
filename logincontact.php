<!doctype html>
<html>
<head>
<script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
<meta charset="utf-8">
<link rel="stylesheet" href="css/pop-op.css">
</head>
<body>
<!--start infowmation box-->
<div id="agahi">
<button id="myBtn" class="btn circular" onClick="update_content()">post your ad</button>
</div>
<?php
error_reporting(0);
$db_host="localhost";
$db_user="root";
$db_pass="";
$db_name="realestate";
$db_table="signup";
$saltt=$_COOKIE['c_salt'];
$connect = mysql_connect("$db_host", "$db_user", "$db_pass") or die("could not connect to the server");
mysql_select_db("realestate",$connect) or die("could not connect to the database");
$check = mysql_fetch_array(mysql_query("SELECT * FROM `signup` WHERE `salt`='$saltt'"));
$username=$check['username'];
include "algor.php";

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
<script type="text/javascript">
function update_content() {
	// Get the modal
	var modal = document.getElementById('myModal');

	// Get the button that opens the modal
	var btn = document.getElementById("myBtn");

	btn.onclick = function() {
		modal.style.display = "block";
	}
	
	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];

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
	
	document.getElementById("myBtn").click();
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

} else {
header("Location: http://localhost/real-estate/login.php?lastpage=" . urlencode($_SERVER['REQUEST_URI']));
}
?>
</body>
</html>