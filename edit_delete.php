<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php
 error_reporting(0);
$db_host="localhost";
$db_user="root";
$db_pass="";
$db_name="realestate";
$db_table="advertisement";
$connect = mysqli_connect("$db_host", "$db_user", "$db_pass", "$db_name");
mysqli_query($connect,"SET NAMES 'utf8'");
mysqli_query($connect,"SET character_set_connection='utf8'");
if(mysqli_connect_errno()){
	die("unable to connect".mysqli_connect_errno());
}
(is_numeric($_GET['ID'])) ? $ID = $_GET['ID'] : $ID = 1;
$result = mysqli_query($connect,"SELECT*FROM ".$db_table." WHERE id = $ID");
while($row = mysqli_fetch_array($result)):
$id= $row['id'];
$address=$row['address'];
$caseee=$row['caseee'];
$price=$row['price'];
$name=$row['name'];
$phone=$row['phone'];
$username=$row['username'];
endwhile;
?>  
<form action="" method="POST" >
  apartmentadress:<br>
  <input type="text" name="apartmentadress" value="<?php echo "$address"; ?>"><br>
  case:<br>
  <select name="case">
  <option value="">please choose</option>
  <option value="sell" <?php if ($caseee=="sell") {echo "selected";}; ?>>sell</option>
  <option value="rent" <?php if ($caseee=="rent") {echo "selected";}; ?>>rent</option>
  </select><br>
  apartment price:<br>
  <input  name="price" value="<?php echo "$price"; ?>"></br>
  family name:<br>
  <input type="text" name="name" value="<?php echo "$name"; ?>"><br>
  phone number:<br>
  <input name="phone" value="<?php echo "$phone"; ?>"><br>
  <p><input name="delete" type="submit" id="submit" value="delete" /></p>
   <p><input name="edit" type="submit" id="submit" value="edit" /></p>
</form>
<?php
if(isset($_POST['delete'])){
$sql = "DELETE FROM advertisement WHERE `id`='$id'";

if ($connect->query($sql) === TRUE) {
header("Location: submitmassage.php");
} else {
    echo "Error deleting record: " . $conn->error;
}

$connect->close();
}
?>
<?php
$apartmentadress = !empty($_POST['apartmentadress']) ? $_POST['apartmentadress'] : '';
$price = !empty($_POST['price']) ? $_POST['price'] : '';
$name = !empty($_POST['name']) ? $_POST['name'] : '';	
$phone = !empty($_POST['phone']) ? $_POST['phone'] : '';
if(isset($_POST['edit'])){
$sql = "UPDATE advertisement SET
address='$apartmentadress',
price='$price',
name='$name',
phone='$phone'
WHERE `id`='$id'";

if ($connect->query($sql) === TRUE) {
header("Location: submitmassage.php");
} else {
    echo "Error deleting record: " . $conn->error;
}

$connect->close();
}
?>
<?php
$date_clicked = date('Y-m-d H:i:s');
if(isset($_POST['extension'])){
$sql = "UPDATE advertisement SET
date='$date_clicked'
WHERE `id`='$id'";

if ($connect->query($sql) === TRUE) {
header("Location: submitmassage.php");
} else {
    echo "Error deleting record: " . $connect->error;
}

$connect->close();
}
?>
</body>
</html>