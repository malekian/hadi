<!doctype html> 
<html> 
<head> 
</head> 
<body> 
<?php 
// Create connection 
$db_host="localhost"; 
$db_user="root"; 
$db_pass=""; 
$db_name="realestate"; 
$connect = new mysqli($db_host, $db_user, $db_pass, $db_name); 
if ($connect->connect_error) { 
die("Connection failed: " . $connect->connect_error); 
} 

// sql to create table 
$sql = "CREATE TABLE advertisement ( 
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
address varchar(80) not null, 
caseee varchar(20) not null, 
price int(50) not null, 
name varchar(60) not null, 
phone Bigint(50) not null 
)"; 

if ($connect->query($sql) === TRUE) { 
echo "Table advertisement created successfully"; 
} else { 
echo "Error creating table: " . $connect->error; 
} 

$connect->close(); 
?> 
</body> 
</html>