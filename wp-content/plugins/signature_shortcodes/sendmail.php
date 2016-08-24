<?php

$receiver = $_POST['receiver'];          //PROVIDE YOUR EMAIL ADDRESS
$subject = $_POST['subject'];            //PROVIDE THE SUBJECT OF THE CONTACT FORM MAIL



$name = $_POST['name'];
$email = $_POST['email'];
$mail_message = $_POST['message'];


$message = "<br/>Name: " . $name .
	"<br/>Email: " . $email ;

$message .= "<br/>Message: " . $mail_message .
	"<br/>";

$siteEmail = $receiver;
$emailTitle = $subject;
$thankYouMessage = "Thank you for contacting us, we'll get back to you shortly.";  
$err_msg =  'Please Try Again';


$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
$headers .='From: ' . $name . ' <' . $email . '>';

if($_POST['website_url'] == '')
{
	if(mail($receiver, $emailTitle, $message, $headers))
		{ echo 'success'; }
	else { echo 'error'; }
}
else
{
	echo 'error';
}


?>
