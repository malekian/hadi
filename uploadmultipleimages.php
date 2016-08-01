<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>upload multiple image</title>
</head>
<body>
<form action="" method="POST" enctype="multipart/form-data" name="contactform" id="contactform"  autocomplete="on"> 
<div>
            <fieldset>
            <legend>upload your image</legend><br><br><br><br>
		    <p dir="rtl"><label>iamge</label>
	        <input type="file" name="image[]" multiple><br><br>
			</fieldset>
</div>
<div>			
			<fieldset>
			<p dir="rtl"><input name="submit" type="submit" class="submit" id="submit" value="upload" /></p>
	        </fieldset>	
</div>	
</form>
<?php
$db_host="localhost";
$db_user="root";
$db_pass="";
$db_name="realestate";
$db_table="upload";
$connect = mysqli_connect("$db_host", "$db_user", "$db_pass", "$db_name");
mysqli_query($connect,"SET NAMES 'utf8'");
mysqli_query($connect,"SET character_set_connection='utf8'");
if(mysqli_connect_errno()){
	die("unable to connect".mysqli_connect_errno());
}
include('function.php');

// settings
$max_file_size = 10240*2000; // 200kb
$valid_exts = array('jpeg', 'jpg', 'png', 'gif');
// thumbnail sizes
$sizes = array( 600 => 600);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if(isset($_FILES['image'])) {
		foreach($_FILES['image']['name'] as $index => $image_name) {
			$image_size = $_FILES['image']['size'][$index];
			$image_path = $_FILES['image']['tmp_name'][$index];
			
			if ($image_size < $max_file_size) {
				$image[] = addslashes($image_name);
				$ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
				if (in_array($ext, $valid_exts)) {
					// resize image
					foreach ($sizes as $w => $h) {
						$files[] = resize($image_path, $image_name, $w, $h);
					}
				} else {
					$msg = 'Unsupported file';
				}
			} else {
				$msg = 'Please upload image smaller than 200KB';
			}
		}
	} else {
		$msg = 'Image too big to fetch.';
	}
}

if(isset($_POST['submit'])){ 
//insert to database
if ($stmt = mysqli_prepare($connect, "INSERT INTO $db_table VALUES ('', ?)"))
{
	/* bind parameters for markers */
    mysqli_stmt_bind_param($stmt, "s", implode($image, ","));
    /* execute query */
    if(mysqli_stmt_execute($stmt))
    {
echo"your image has been send successfully";
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