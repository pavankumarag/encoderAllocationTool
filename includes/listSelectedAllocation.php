<?php
		

		
	$thisScriptName = 'index.php?content=listSelectedAllocation&encoderID='.$encoderID;
	//include_once('includes/fn_EncoderAllocationEntry_SQL.php');
	
	$parentName = 'listSelectedAllocation'; //used in Add and Edit form
	$thisPage = 'listSelectedAllocation'; //used in delete link,
	
	$encoderID = $_POST["encoderID"];
	if(!isset($encoderID)) {$encoderID = $_GET["encoderID"]; }
	
	$allocationID = $_POST["allocationID"];
	if(!isset($allocationID)) {$allocationID = $_GET["allocationID"]; }
	
	$newAllocation = $_POST["newAllocation"];
	if(!isset($newAllocation)) {$newAllocation = $_GET["newAllocation"]; }
	
	$allocationEdit = $_POST["allocationEdit"];
	if(!isset($allocationEdit)) {$allocationEdit = $_GET["allocationEdited"]; }
	
	$allocationDelete = $_POST["allocationDelete"];
	if(!isset($allocationDelete)) {$allocationDelete = $_GET["allocationDelete"]; }

//echo '<div> ';
		include_once('includes/timeZone.php');
		echo '	<input type="hidden" name="encoderID" value="'.$encoderID.'"/>';
		echo '<input type="hidden" name="content" value="'.$thisPage.'"/>';
		echo '</form>';
			



		{	//		Insert New Person Recor
			if(isset($newAllocation) AND $newAllocation == '1'){
				
				$userID = $_POST["username"];	
				$startDate = strtotime($_POST["startDate"]);	
				$endDate = strtotime($_POST["endDate"]);						
				$insertMsg = allocationInsert($encoderID, $userID, $startDate, $endDate);
				if (!empty($insertMsg)) {
					echo $insertMsg;
				}
				
				unset($newAllocation);
			}		
		//		END:  Insert New Person Record		
		}
		

		{	//		UPDATE Person Record
			if(isset($allocationEdit) AND $allocationEdit == '1'){

				$userID = $_POST["username"];	
				$startDate = strtotime($_POST["startDate"]);	
				$endDate = strtotime($_POST["endDate"]);	
				//$Tel = $_POST["Tel"];	
			
				$updateMsg = allocationUpdate($allocationID, $encoderID, $userID, $startDate, $endDate);
				if (!empty($updateMsg)) {
					echo $updateMsg;
				}
				
				unset($allocationEdit);
			}		
		//		END:  Insert New Person Record		
		}

	{// DELETE allocation record
	if(isset($allocationDelete) AND $allocationDelete == '1'){
		
	$deleteMsg = allocationDelete($allocationID);
	
	if (!empty($deleteMsg)) {
					echo $deleteMsg;
				}
				
				unset($allocationDelete);
	}
	}

		{	//  Get the details of the company selected 
								
				$eEncoder_SQLselect = "SELECT * ";
				$eEncoder_SQLselect .= "FROM ";
				$eEncoder_SQLselect .= "eEncoder ";
				$eEncoder_SQLselect .= "WHERE ID = '".$encoderID."' ";
				
				$eEncoder_SQLselect_Query = mysql_query($eEncoder_SQLselect);	
				
				while ($row = mysql_fetch_array($eEncoder_SQLselect_Query, MYSQL_ASSOC)) {
					$ID = $row['ID'];
					$encoderIP = long2ip($row['encoderIP']);
					$encoderInfo = $row['encoderInfo'];						 
				}		
				
				
		}
		
		{	//  Get the details of all associated Person records
			//		and store in array:  personArray  with key >$indx
			 
				$indx = 0;
			
				$eEncoderAllocation_SQLselect = "SELECT a.ID, a.encoderID, b.username AS user, b.email, a.startDate, a.endDate
																						FROM eEncoderAllocation a
																						LEFT JOIN eUser b ON a.userID = b.ID
																						WHERE a.encoderID = \"$encoderID\"";
																																										
				$eEncoderAllocation_SQLselect_Query = mysql_query($eEncoderAllocation_SQLselect);	
				//date_default_timezone_set('GMT');
				while ($row = mysql_fetch_array($eEncoderAllocation_SQLselect_Query, MYSQL_ASSOC)) {
					
					//		we need this to pass to personEdit.php
					$personArray[$indx]['ID'] = $row['ID'];
					//^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
					
					$personArray[$indx]['user'] = $row['user'];
					$personArray[$indx]['email'] = $row['email'];
					$personArray[$indx]['startDate'] = $row['startDate'];
					$personArray[$indx]['endDate'] = $row['endDate'];
					
						
					$indx++;			 
				}
	
				$numAllocations = sizeof($personArray);
				echo '<p> There are '.$numAllocations.'&nbsp;entries for your request';
		}
	
		{	//		Output 

			{	//		Table to render eEncoder detail	
			echo 	  '<table>
							<tr valign="top">								
								<td style=" font-size: 24; 
												font-weight: bold;" 
												>
										'.$encoderIP.' ==>
								</td>
								
								<td align="right" width="400">
										'.$encoderInfo.'			
								</td>
							</tr>
						</table><br />';
			//		END: Table to render eEncoder detail
			}
											

			{	//		Table of eEncoderAllocation records
			echo '<table  border="1" padding="5">';
				echo '<tr class="tableHeader1">
							<td>User Name</td>
							<td>Email</td>
							<td>Start Date</td>
							<td>Release Date</td>';
							
							
				//		update code:   coPeopleEdit 0807_13_restrict_21
				if (isset($accessLevel) AND $accessLevel >= 21) {
					echo '<td>Action&nbsp;</td>';
				}
				echo '</tr>	';	
														
				for ($indx = 0; $indx < $numAllocations; $indx++) {
					$thisAllocationID = $personArray[$indx]['ID'];
					
				//	$personEditLink = '<a href="personEditForm.php?personID='.$thisID.'">Edit</a>';
					$personEditLink = '<a href="index.php
					?content=allocationEditForm
					&allocationID='.$thisAllocationID.'&parentName='.$parentName.'&timeZone='.$timeZone.'"><u>Edit</u></a>';
					
					$allocationDeleteLink = '<a href="index.php
					?content='.$thisPage.'&allocationID='.$thisAllocationID.'&allocationDelete=1&encoderID='.$encoderID.'"><u>Delete</u></a>';
					
  					if (($indx % 2) == 1) {$rowClass = $tdOdd; } else { $rowClass = $tdEven; }  
 
					echo '<tr '.$rowClass.' height="20">
					
								<td>'.$personArray[$indx]['user'].'&nbsp;</td>
								
								<td>'.$personArray[$indx]['email'].'&nbsp;</td>

								<td>'.date('D M/d/Y H:i:s',$personArray[$indx]['startDate']).'&nbsp;</td>

								<td>'.date('D M/d/Y H:i:s',$personArray[$indx]['endDate']).'&nbsp;</td>';
								//<td>'.$personArray[$indx]['endDate'].'&nbsp;</td>';
								
								

					if (isset($accessLevel) AND $accessLevel >= 21) {
							echo '<td>'.$personEditLink.'&nbsp;&nbsp;&nbsp;'.$allocationDeleteLink.'</td>';
					}
					echo '</tr>	';	
  
				}
			echo '</table>';
			//		END:  Table of eEncoderAllocation records
			}	
																
			if (isset($accessLevel) AND $accessLevel >= 21)
			 {										
							include_once("includes/allocationAddForm.php");
							
							}
																							
	
		}
				

/*unset($allocationID);
unset($encoderID);*/
				
echo '<br /><hr align=left style="width:750px"/><br />';
echo '<a href="index.php?content=availableEncoders">Back to Encoder List</a>';

?>