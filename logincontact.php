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
      <form action="" method="post">
<p dir="rtl"><input onchange="this.form.submit()" value="1" type="checkbox" name="sign[1]" /> املاک </p>   <br>
<p dir="rtl"><input onchange="this.form.submit()" value="2" type="checkbox" name="sign[2]" /> وسایل نقلیه  </p>   <br>
<p dir="rtl"><input onchange="this.form.submit()" value="3" type="checkbox" name="sign[3]" /> لوازم الکترونیکی  </p>  <br>
<p dir="rtl"><input onchange="this.form.submit()" value="4" type="checkbox" name="sign[4]" /> آموزشی و سرگرمی  </p> <br>
<p dir="rtl"><input onchange="this.form.submit()" value="5" type="checkbox" name="sign[5]" /> پوشاک و جواهرآلات  </p>  <br>
<p dir="rtl"><input onchange="this.form.submit()" value="6" type="checkbox" name="sign[6]" /> لوازم خانگی  </p>  <br>
<p dir="rtl"><input onchange="this.form.submit()" value="7" type="checkbox" name="sign[7]" /> استخدام </p>   <br>
</form>
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
} else {
	?>
<script type="text/javascript">
    function update_content() {
window.location =("http://localhost/real-estate/login.php?lastpage=" + encodeURIComponent(window.location.href));
	}
</script> 
<?php
}
?>
</body>
</html>