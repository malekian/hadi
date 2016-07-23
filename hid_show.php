<!doctype html>
<html>
<head>
<meta charset="utf-8">
<script src="//code.jquery.com/jquery-3.1.0.min.js"></script>
<script>
$(document).ready(function(){ 
$("#ddColor").change(function () {
        $(this).find("option:selected").each(function(){
            if($(this).attr("value")=="red"){
                $(".box").not(".red").hide().find('input,select').removeAttr('required');
                $(".red").show();
            }
            else if($(this).attr("value")=="green"){
                $(".box").not(".green").hide().find('input,select').removeAttr('required');
                $(".green").show();
            }
            else{
                $(".box").hide();
            }
        });
    }).change();
});
</script>
</head>
<body>
	<form action="" method="POST" >
<div>
	
			<p>
            <select name="adkind" id="ddColor" required >
            <option value="">please choose</option>
            <option value="red">sell</option>
            <option value="green">rent</option>
            </select></p>

</div>
<div class="red box">
  pricerange:<br>
  <input type="text" name="pricerange" required><br>
    case1:<br>
  <select name="case" required>
  <option value="">please choose</option>
  <option value="1">1</option>
  <option value="2">2</option>
  </select><br>
</div>
<div class="green box" >
  rentrange:<br>
  <input type="text" name="rentrange" required><br>
    case2:<br>
  <select name="case" required>
  <option value="">please choose</option>
  <option value="3">3</option>
  <option value="4">4</option>
  </select><br>
</div>
  <p><input name="submit" type="submit" id="submit" value="submit" /></p>
  </form>
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
$pricerange = !empty($_POST['pricerange']) ? $_POST['pricerange'] : '';	
$case1 = !empty($_POST['case1']) ? $_POST['case1'] : '';
$rentrange = !empty($_POST['rentrange']) ? $_POST['rentrange'] : '';
$case2 = !empty($_POST['case2']) ? $_POST['case2'] : '';	

if(isset($_POST['submit'])){
if ($stmt = mysqli_prepare($connect, "INSERT INTO form VALUES ( ?, ?, ?, ?)"))
mysqli_stmt_bind_param($stmt, "ssss",
$pricerange,$case1,$rentrange,$case2);
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