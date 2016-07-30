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
$db_name="realstate";
$connect = mysqli_connect("$db_host", "$db_user", "$db_pass", "$db_name");
mysqli_query($connect,"SET NAMES 'utf8'");
mysqli_query($connect,"SET character_set_connection='utf8'");
if(mysqli_connect_errno()){
	die("unable to connect".mysqli_connect_errno());
}
$quer = "SELECT*FROM realestate";
$query=mysqli_query($connect,$quer)
or die(mysqli_error($connect));

ini_set("curl.cainfo", "C:/wamp/www/real-estate/certificates/cacert.pem");

date_default_timezone_set('Etc/UTC');
require './vendor/autoload.php';

function sendMail($fromName, $toEmail, $subject, $body) {
	$clientEmail = 'hadimalekian1370@gmail.com';
	$clientId = '353593535968-rpuvkgj19cubg9mhbr6oe96m0lu58o1d.apps.googleusercontent.com';
	$clientSecret = 'jizAkrFnIAaT6SUY6LNdvTme';
	$clientRefreshToken = '1/8qyw3Hh2tkFP7r9C5fioXmczOjsRA1RMSAeOFjLGD8o';
	
	//Create a new PHPMailer instance
	$mail = new PHPMailerOAuth;
	//Tell PHPMailer to use SMTP
	$mail->isSMTP();
	//Enable SMTP debugging
	// 0 = off (for production use)
	// 1 = client messages
	// 2 = client and server messages
	$mail->SMTPDebug = 0;
	//Ask for HTML-friendly debug output
	$mail->Debugoutput = 'html';
	//Set the hostname of the mail server
	$mail->Host = 'smtp.gmail.com';
	//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
	$mail->Port = 587;
	//Set the encryption system to use - ssl (deprecated) or tls
	$mail->SMTPSecure = 'tls';
	//Whether to use SMTP authentication
	$mail->SMTPAuth = true;
	//Set AuthType
	$mail->AuthType = 'XOAUTH2';
	//User Email to use for SMTP authentication - Use the same Email used in Google Developer Console
	
	$mail->oauthUserEmail = $clientEmail;
	//Obtained From Google Developer Console
	$mail->oauthClientId = $clientId;
	//Obtained From Google Developer Console
	$mail->oauthClientSecret = $clientSecret;
	//Obtained By running get_oauth_token.php after setting up APP in Google Developer Console.
	//Set Redirect URI in Developer Console as [https/http]://<yourdomain>/<folder>/get_oauth_token.php
	// eg: http://localhost/phpmail/get_oauth_token.php
	$mail->oauthRefreshToken = $clientRefreshToken;
	//Set who the message is to be sent from
	//For gmail, this generally needs to be the same as the user you logged in as
	
	$mail->setFrom($clientEmail, $fromName);
	//Set who the message is to be sent to
	$mail->addAddress($toEmail);
	//Set the subject line
	$mail->Subject = $subject;
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
	$mail->Body = $body;
	//Replace the plain text body with one created manually
	//$mail->AltBody = 'This is a plain-text message body';
	//Attach an image file
	//$mail->addAttachment('images/phpmailer_mini.png');
	//send the message, check for errors
	
	if (!$mail->send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		echo "Message sent!";
	}
}

/* Test
sendMail(
	"slayther.morderclaw@gmail.com",
	"Hi there Slayther!",
	"Just wanted to let you know that this works perfectly!!!"
);
*/

while($row = mysqli_fetch_array($query)):
if (!empty($row["email"])){
	sendMail(
		"telejarat.ir",
		$row["email"],
		"$row[family] Welcome to our services!",
		"Hello there, " . $row["username"] . "!\n $row[family] Just wanted to welcome you to our real estate services!"
	);
}
endwhile;
?>
 </body>
 </html>