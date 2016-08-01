<!DOCTYPE html>
<html>
<body>

<form action="" method="POST" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload[]" id="fileToUpload" multiple>
    <input type="submit" value="Upload Image" name="submit">
</form>

<?php
if((isset($_POST["submit"]))&&(!empty($_FILES['fileToUpload'])) ){
foreach($_FILES['fileToUpload']['name'] as $key => $name){
 $filename[] = $_FILES['fileToUpload']['name'][$key];
	}
echo implode($filename, ",");
}
?>