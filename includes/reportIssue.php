<?php

//		eMail_test_html.php

//$pageStyle = pageStyle();							

$Get_email_SQL = "SELECT email from eUser WHERE ID = \"$userID\"";
$Get_email_SQL_Query = mysql_query($Get_email_SQL);
$result = mysql_fetch_assoc($Get_email_SQL_Query);
$email = $result['email'];

$SMTPserver = 'smtp-mail.outlook.com';
$FromMail = $email;
$ToMail = "pgovindr@akamai.com";





$sendWasClicked = 0;
$sendWasClicked = $_POST['sendWasClicked'];

		


if (isset($sendWasClicked) AND $sendWasClicked == 1) {
	
			//		if $sendWasClicked 

							echo $FromMail;
				
				$MailCC = $_POST['MailCC'];								
				$subject = $_POST['subject'];
				$message = $_POST['message'];

			
			$templateURL = 'mailing/reportIssueMailFormat.html';	
         $templateString = file_get_contents($templateURL);
         $htmlMessage = str_replace("[ontent]",$content, $templateString); 
         
         $headers =   'From: '.$FromMail."\r\n";
         $headers .=  'Reply-To: '.$FromMail."\r\n";
         if (check_email($email)) { $headers .=  'CC: '.$MailCC."\r\n"; }
         $headers .=  'Content-Type: text/html'."\r\n";			
         $headers .=  'X-Mailer: PHP/' . phpversion();
         
         ini_set("SMTP",$SMTPserver);
         //$mailSent = mail($ToMail, $subject, $htmlMessage, $headers);	

				
		}
		
 else {
	
		{	//		FORM to get eMail details 

					
				$sendWasClicked_fld = '<input type="hidden" name="sendWasClicked" value=1/>';

					$MailCC_fld = '<input type="email" name="MailCC" size="25"/>';
					$From_fld = "<input type=\"email\" name=\"From_fld\" value=$FromMail size=\"25\" readonly/>";
					
		
		
				$subject_fld = '<input type="text" name="subject" size="25" required/>';
				$message_fld = '<textarea name="message" cols="50" rows="10" required></textarea>';
		
				$submit_fld = '<input type="submit" value="Send" size="15"/>';
						
				echo '<form method="post" action="index.php?content=reportIssue">';
				//echo $thisScriptname;
						echo $sendWasClicked_fld;
						echo '<table>';
						echo '<tr>';
							echo '<td>From:</td>';
							echo '<td>'.$From_fld.'</td>';			
						echo '</tr>';
						echo '<tr>';
							echo '<td>CC:</td>';
							echo '<td>'.$MailCC_fld.'</td>';			
						echo '</tr>';
						echo '<tr>';
							echo '<td>Subject:</td>';
							echo '<td>'.$subject_fld.'</td>';
						echo '</tr>';
						echo '<tr>';
							echo '<td valign="top">Message:</td>';
							echo '<td>'.$message_fld.'</td>';
						echo '</tr>';
						echo '<tr>';
							echo '<td></td>';
							echo '<td align="right">'.$submit_fld.'</td>';
						echo '</tr>';
				
						echo '</table>		';
				echo '</form>';
				
			//		END: FORM to get eMail details			
		} 
} 

function pageStyle() {
			echo'	
			<style type="text/css">
			body {
				font-family: Arial, Helvetica, sans-serif;
			}
			td {
				color: maroon;	
			}
			.scriptcolour {
				color: maroon;	
			}
			
			</style>
			';
}  

function check_email($email) {  
 	if( (preg_match('/(@.*@)|(\.\.)|(@\.)|(\.@)|(^\.)/', $email)) || 
 		(preg_match('/^.+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/',$email)) ) { 
		 return true;
 	} else {
		 return false;
	}    	
 }
      
?>