<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>

<form action="" method="POST" >
  apartmentadress:<br>
  <input type="text" name="apartmentadress" ><br>
  case1:<br>
<select name="caseee">
<option value="">please select an option</option>
  <option value="volvo">Volvo</option>
  <option value="saab">Saab</option>
</select><br><br>
 case2:<br>
<select name="caseee">
<option value="">please select an option</option>
  <option value="mercedes">Mercedes</option>
  <option value="audi">Audi</option>
</select><br><br>
  apartment price:<br>
  <input  name="price"></br>
  family name:<br>
  <input type="text" name="name" ><br>
  phone number:<br>
  <input name="phone"> <br>
  <p><input name="submit" type="submit" id="submit" value="submit" /></p>
</form>


<?php
///////////////////////////////////////////Insert Data
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
$apartmentadress = !empty($_POST['apartmentadress']) ? $_POST['apartmentadress'] : '';
$price = !empty($_POST['price']) ? $_POST['price'] : '';
$name = !empty($_POST['name']) ? $_POST['name'] : '';	
$phone = !empty($_POST['phone']) ? $_POST['phone'] : '';
$caseee = !empty($_POST['caseee']) ? $_POST['caseee'] : '';
$username=hadi;
if(isset($_POST['submit'])){ 
//insert to database
if ($stmt = mysqli_prepare($connect, "INSERT INTO $db_table VALUES ('', ?, ?, ?, ?, ?,? )"))
{
	/* bind parameters for markers */
    mysqli_stmt_bind_param($stmt, "ssssss",
	$apartmentadress, $caseee,$price,$name,$phone,$username);
    /* execute query */
    if(mysqli_stmt_execute($stmt))
    {
    echo"data inserted";
    }
    else
    {
        echo "Error occurred: " . mysqli_error($connect);
    }

    /* close statement */
    mysqli_stmt_close($stmt);
}
}
?>

</body>
</html>