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
$connect = mysql_connect("$db_host", "$db_user", "$db_pass") or die("could not connect to the server");
mysql_select_db("realestate",$connect) or die("could not connect to the database");

include "logincontact-data";
?>
<div id="content">

</div>
<script type="text/javascript">
function update_content() {
	if (update_content.debounce) {
		update_content.debounce = false;
		
		// Get the modal
		var modal = document.getElementById('myModal');
		// When the user clicks the button, open the modal
		modal.style.display = "block";
	} else {
		update_content.debounce = true;
		$('#content').load('logincontact-data.php', {"load-content": true}, () => {
			// Get the modal
			var modal = document.getElementById('myModal');

			// Get the button that opens the modal
			var btn = document.getElementById("myBtn");

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
		});
	}
}
update_content.debounce = false;
</script>
</body>
</html>