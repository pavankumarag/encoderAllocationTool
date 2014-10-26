<?php


$thisScriptName = 'index.php?content=availableEncoders';
$thisPage = 'availableEncoders';

$addEncoder = $_POST["addEncoder"];
	if(!isset($addEncoder)) {$addEncoder = $_GET["addEncoder"]; }
	
	$deleteEncoder = $_POST["deleteEncoder"];
	if(!isset($deleteEncoder)) {$deleteEncoder = $_GET["deleteEncoder"]; }
	
	
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
$header_ID = '<a href="'.$thisScriptName.'&orderClause=ID"><span class="tableHeader">ID</span></a>';
$header_EncoderIP = '<a href="'.$thisScriptName.'&orderClause=encoderIP"><span class="tableHeader">Encoder IP</span></a>';
$header_EncoderInfo = '<a href="'.$thisScriptName.'&orderClause=encoderInfo"><span class="tableHeader">Description</span></a>';




	echo '<h2>Encoder List</h2>';
				
	echo '<table border="1">';	
		echo '<tr class="tableHeader" height="40px">';		
			echo '<td>'.$header_ID.'</td>';
			echo '<td>'.$header_EncoderIP.'</td>';
			echo '<td>'.$header_EncoderInfo.'</td>';

		echo '</tr>';

		$indx = 0;		
		
		
	
		while ($row = mysql_fetch_array($tCompany_SQLselect_Query, MYSQL_ASSOC)) {
			
			$ID = $row['ID'];
			$encoderIP = long2ip($row['encoderIP']);
			$encoderInfo = $row['encoderInfo'];

			$linkToList = '<a href="index.php?content=listSelectedAllocation&encoderID='.$ID.'">'.$ID.'</a>';
			
			
			if (($indx % 2) == 1) {$rowClass = 'class="trOdd"'; } else { $rowClass = 'class="trEven"'; }
			echo '<tr '.$rowClass.'>';	
			
				echo '<td>'.$linkToList.'&nbsp;</td>'; 
				echo '<td>'.$encoderIP.'&nbsp;</td>'; 
				echo '<td>'.$encoderInfo.'&nbsp;</td>';
				
		
			echo '</tr>';
	  
	  		$indx++;
	   
		}

	echo '</table>';	
	echo ' &nbsp;&nbsp;^ click ID to edit record';
	
	if (isset($accessLevel) AND $accessLevel >= 21)
			 {										
							include_once("includes/addEncoder.php");
							
							}
																							
	
		}



	





?>