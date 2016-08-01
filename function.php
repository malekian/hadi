<?php
/**
 * Image resize while uploading
 * @author Resalat Haque
 * @link http://www.w3bees.com/2013/03/resize-image-while-upload-using-php.html
 */
 
/**
 * Image resize
 * @param int $width
 * @param int $height
 */
function resize($index, $width, $height){
	$name = $_FILES['image']['name'][$index];
	$tmpname = $_FILES['image']['tmp_name'][$index];
	$type = $_FILES['image']['type'][$index];
	
	/* Get original image x y*/
	list($w, $h) = getimagesize($tmpname);
	/* calculate new image size with ratio */
	$ratio = max($width/$w, $height/$h);
	$h = ceil($height / $ratio);
	$x = ($w - $width / $ratio) / 2;
	$w = ceil($width / $ratio);
	/* new file name */
	$path = 'photo/'.$name;
	/* read binary data from image file */
	$imgString = file_get_contents($tmpname);
	/* create image from string */
	$image = imagecreatefromstring($imgString);
	$tmp = imagecreatetruecolor($width, $height);
	imagecopyresampled($tmp, $image,
  	0, 0,
  	$x, 0,
  	$width, $height,
  	$w, $h);
	/* Save image */
	switch ($type) {
		case 'image/jpeg':
			imagejpeg($tmp, $path, 40);
			break;
		case 'image/png':
			imagepng($tmp, $path, 0);
			break;
		case 'image/gif':
			imagegif($tmp, $path);
			break;
		default:
			break;
	}
	/* cleanup memory */
	imagedestroy($image);
	imagedestroy($tmp);
	
	return $path;
}
?>