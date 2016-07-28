<!doctype html>
<html>
<head>
<title>ارسال ایمیل</title>
<meta charset="utf-8">
</head>
<body>
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
$quer = "SELECT*FROM advertisement";
$query=mysqli_query($connect,$quer)
or die(mysqli_error($connect));

date_default_timezone_set('Etc/UTC');
require 'vendor/phpmailer/phpmailer/PHPMailerAutoload.php';

function sendMail($gmail, $pass, $to, $subject, $body) {
	$mail = new PHPMailer(); // create a new object
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 2; // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true; // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 465; // or 587
	$mail->IsHTML(true);
	$mail->Username = $gmail;
	$mail->Password = $pass;
	$mail->SetFrom($gmail);
	$mail->Subject = $subject;
	$mail->Body = $body;
	$mail->AddAddress($to);

	if(!$mail->Send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		echo "Message has been sent";
	}
}

while($row = mysqli_fetch_array($query)):
	sendMail(
		"slayther.morderclaw@gmail.com", // Must be real gmail account
		"slayingtheringmorderingclawing25111996", // Must be valid password for above gmail account
		"bozo.stojkovic@gmail.com",
		"test",
		"wellcome"
	);
endwhile;
?>
 </body>
 </html>