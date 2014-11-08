<?php


$thisScriptName = 'index.php?content=availableEncoders';
$thisPage = 'availableEncoders';


$encoderID = $_POST["encoderID"];
	if(!isset($encoderID)) {$encoderID = $_GET["encoderID"]; }
	

$addEncoder = $_POST["addEncoder"];
	if(!isset($addEncoder)) {$addEncoder = $_GET["addEncoder"]; }
	
	$deleteEncoder = $_POST["deleteEncoder"];
	if(!isset($deleteEncoder)) {$deleteEncoder = $_GET["deleteEncoder"]; }
	
	$editEncoder = $_POST["editEncoder"];
	if(!isset($editEncoder)) {$editEncoder = $_GET["editEncoder"]; }
	
	
	{	//		Insert New encoder Record
			if(isset($addEncoder) AND $addEncoder == '1'){
				
				$encoderIP = $_POST["encoderIP"];	
				$encoderInfo = $_POST["encoderInfo"];							
				$insertMsg = insertEncoder($encoderIP,$encoderInfo);
				if (!empty($insertMsg)) {
					echo $insertMsg;
				}
				
				unset($addEncoder);
			}		
		//		END:  Insert New Person Record		
		}
		
		{	//		Delete New encoder Record
			if(isset($deleteEncoder) AND $deleteEncoder == '1'){
							
				$deleteMsg = deleteEncoder($encoderID);
				if (!empty($deleteMsg)) {
					echo $deleteMsg;
				}
				
				unset($deleteEncoder);
			}		
		//		END:  Insert New Person Record		
		}
		
		{	//		Update New encoder Record
			if(isset($editEncoder) AND $editEncoder == '1'){
							
				$encoderIP = ip2long($_POST["encoderIP"]);	
				$encoderInfo = $_POST["encoderInfo"];	
				$updateMsg = updateEncoder($encoderID,$encoderIP,$encoderInfo);
				if (!empty($updateMsg)) {
					echo $updateMsg;
				}
				
				unset($deleteEncoder);
			}		
		//		END:  Insert New Person Record		
		}

//		Get the sortorder with GET but default to Name
$orderClause = $_GET["orderClause"];	
if (!isset($orderClause)) {$orderClause = "ID"; }

{	
	$tCompany_SQLselect = "SELECT * ";
	$tCompany_SQLselect .= "FROM ";
	$tCompany_SQLselect .= "eEncoder ";	
	$tCompany_SQLselect .= "ORDER BY ";
	$tCompany_SQLselect .= "eEncoder.".$orderClause;

	$tCompany_SQLselect_Query = mysql_query($tCompany_SQLselect); 	
	$num_rows = mysql_num_rows($tCompany_SQLselect_Query);
	echo '<p> There are '.$num_rows.'&nbsp;entries for your request';
	

}

{	//		Output 

//		make each header a link to $thisScriptName and ADD the  querystring for orderclause 

$header_ID = '<a href="'.$thisScriptName.'&orderClause=ID"><u>ID</u></a>';
$header_EncoderIP = '<a href="'.$thisScriptName.'&orderClause=encoderIP"><u>Encoder IP</u></a>';
$header_EncoderInfo = '<a href="'.$thisScriptName.'&orderClause=encoderInfo"><u>Description</u></a>';



  
	echo '<h2>Encoder List</h2>';
	 echo ' &nbsp;&nbsp;\/ click on the  headings to sort based on the column '; 			
	echo '<table border="1">';	
		echo '<tr class="tableHeader1" height="40px">';		
			echo '<td>'.$header_ID.'</td>';
			echo '<td>'.$header_EncoderIP.'</td>';
			echo '<td>'.$header_EncoderInfo.'</td>';
			echo '<td><a href=""><u>Action</u></td>';

		echo '</tr>';

		$indx = 0;		
		
		
	
		while ($row = mysql_fetch_array($tCompany_SQLselect_Query, MYSQL_ASSOC)) {
			
			$ID = $row['ID'];
			$encoderIP = long2ip($row['encoderIP']);
			$encoderInfo = $row['encoderInfo'];

			$linkToList = '<a href="index.php?content=listSelectedAllocation&encoderID='.$ID.'"><u>'.$ID.'</u></a>';
			$encoderEditLink = '<a href="index.php?content=editEncoderForm&encoderID='.$ID.'&parentName='.$thisPage.'"><u>Edit</u></a>';
			$encoderDeleteLink = '<a href="index.php?content=availableEncoders&deleteEncoder=1&encoderID='.$ID.'"><u>Delete</u></a>';
			
			
			//if (($indx % 2) == 1) {$rowClass = 'class="trOdd"'; } else { $rowClass = 'class="trEven"'; }
			echo '<tr '.$rowClass.'>';	
			
				echo '<td>'.$linkToList.'&nbsp;</td>'; 
				echo '<td>'.$encoderIP.'&nbsp;</td>'; 
				echo '<td>'.$encoderInfo.'&nbsp;</td>';
				
				if (isset($accessLevel) AND $accessLevel >= 21) {
				echo '<td>'.$encoderEditLink.'&nbsp;&nbsp;&nbsp;'.$encoderDeleteLink.'</td>';
				
				}
		
			echo '</tr>';
	  
	  		$indx++;
	   
		}

	echo '</table>';	
	echo ' &nbsp;&nbsp;<br />^ click ID to see allocation for the encoder';
	
	if (isset($accessLevel) AND $accessLevel >= 21)
			 {										
							include_once("includes/addEncoder.php");
							
							}
																							
	
		}



	





?>