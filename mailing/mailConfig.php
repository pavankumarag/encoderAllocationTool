<?php


function sendMail($content,$subject)
{
$SMTPserver = 'smtp-mail.outlook.com';
$FromMail = "noreply@encodermanage.com";
$ToMail = "pgovindr@akamai.com";
$MailCC = "sabanerj@akamai.com";

$templateURL = 'mailing/mailFormat.html';	
$templateString = file_get_contents($templateURL);
$htmlMessage = str_replace("[ontent]",$content, $templateString); 

$headers =   'From: '.$FromMail."\r\n";
$headers .=  'Reply-To: '.$FromMail."\r\n";
//$headers .=  'CC: '.$MailCC."\r\n";
$headers .=  'Content-Type: text/html'."\r\n";			
$headers .=  'X-Mailer: PHP/' . phpversion();

ini_set("SMTP",$SMTPserver);
$mailSent = mail($ToMail, $subject, $htmlMessage, $headers);


}
?>