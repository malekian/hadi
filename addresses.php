<!doctype html>
<html>
<head>
<meta charset="utf-8">
<style>
div.img {
    margin: 10px;
    border: 1px solid #ccc;
    float: right;
    width: 220px;
	height:100px;
	background:white;
}

div.img:hover {
    border: 1px solid #777;
}

div.img img {
    width: 100%;
    height: 150px;
}

div.desc {
    padding: 15px;
    text-align: right;
}
@media screen and (max-width: 500px) {

  div.img {
	  margin: 0px;
	  margin-top:5px;
      width: 100%;
	  height:auto;
  }

  div.img img {
    width: 35%;
    float: left;
	height:135px;
  }

  div.desc {
    width: 65%;
    box-sizing: border-box;
    float: left;
  }

}
a{
	text-decoration:none;
}
</style>
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
//اجرای پرس و جوی داینامیک و دریافت مقادیر
$user=$_COOKIE['c_user'];
$quer = "SELECT*FROM ".$db_table." WHERE `username`='" . $user . "'";
$query=mysqli_query($connect,$quer)
or die(mysqli_error());
while($row = mysqli_fetch_array($query)):
$id= $row['id'];
$address=$row['address'];
$caseee=$row['caseee'];
$price=$row['price'];
$name=$row['name'];
$phone=$row['phone'];
$username=$row['username'];?>
          <div class="img">

  <div class="desc">
<?php echo ('<a href="edit_delete.php?ID=' . $id . '" target="_blank">') ?> 
<p>	<?php echo $row['caseee'];?>-<?php echo $row['address'];?> 
<?php echo $row['price'];?>
</div>
</div>
             <?php endwhile;?>                 		   
</body>
</html>