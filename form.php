<!doctype html> 
<html> 
<head> 
<script src="//code.jquery.com/jquery-3.1.0.min.js"></script>
</head> 
<body> 
<form id="realestate-form" action="" method="POST" > 
apartmentadress:<br> 
<input type="text" name="apartmentadress"><br> 
case:<br> 
<select name="case"> 
<option value="">please choose</option> 
<option value="sell">sell</option> 
<option value="rent">rent</option> 
</select><br> 
apartment price:<br> 
<input name="price"></br> 
family name:<br> 
<input type="text" name="name"><br> 
phone number:<br> 
<input name="phone"><br> 
<p><input name="submit" type="submit" id="submit" value="submit" /></p> 
</form> 

<script>
$.fn.serializeObject = function() {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

$('#realestate-form').submit(function(e) {
	var form_json = $(this).serializeObject();
	console.log(form_json);
	
	var form_data_str = JSON.stringify(form_json);
	
	//$.cookie('user' + , form_json);
});
</script>

<!--checkconnection--> 
<?php 
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
?> 
<!--insert data to database--> 
<?php 
$apartmentadress = !empty($_POST['apartmentadress']) ? $_POST['apartmentadress'] : '';	
$case = !empty($_POST['case']) ? $_POST['case'] : ''; 
$price = !empty($_POST['price']) ? $_POST['price'] : ''; 
$name = !empty($_POST['name']) ? $_POST['name'] : '';	
$phone = !empty($_POST['phone']) ? $_POST['phone'] : ''; 
if(isset($_POST['submit'])){ 
if ($stmt = mysqli_prepare($connect, "INSERT INTO $db_table VALUES ('', ?, ?, ?, ?, ?)")) 
mysqli_stmt_bind_param($stmt, "sssss", 
$apartmentadress,$case,$price,$name,$phone); 
if(mysqli_stmt_execute($stmt)) 
{ 
$alert='<p>Information was sent</p>'; 
echo "<font style ='font:14px/21px Arial,tahoma,sans-serif;color:red' >$alert</font>"; 
} 
else 
{ 
echo "Error occurred: " . mysqli_error($connect); 
} 

/* close statement */ 
echo "New record has id: " . mysqli_insert_id($connect); 
mysqli_stmt_close($stmt); 
}	
?> 
</body> 
</html>