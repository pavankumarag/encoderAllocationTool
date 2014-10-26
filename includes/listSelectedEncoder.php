<?php


// $thisScriptName separated out as it's now used several times
$thisScriptName = 'index.php?content=selectEncoder';
//date_default_timezone_set('GMT');
$thisPage = 'selectEncoder'; //used in delete link,

		$parentName = 'selectEncoder'; //used in Add and Edit form		
		
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
		//		END:  update Person Record		
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
		
		
		if (isset($encoderID) AND $encoderID > 0){

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
						
					//	$fullCoyName = trim($preName." ".$companyName." ".$RegType);
														 
					}					
					mysql_free_result($eEncoder_SQLselect_Query);			
			}
			
			{	//  Get the details of all associated Person records
				//		and store in array:  allocationArray  with key >$indx
				 
					$indx = 0;
				
					$eEncoderAllocation_SQLselect = "SELECT a.ID, a.encoderID, b.username AS user, b.email, a.startDate, a.endDate
																						FROM eEncoderAllocation a
																						LEFT JOIN eUser b ON a.userID = b.ID
																						WHERE a.encoderID = \"$encoderID\"";
					
					$eEncoderAllocation_SQLselect_Query = mysql_query($eEncoderAllocation_SQLselect);	
					
					while ($row = mysql_fetch_array($eEncoderAllocation_SQLselect_Query, MYSQL_ASSOC)) {
						
						//		we need this to pass to personEdit.php
						$allocationArray[$indx]['ID'] = $row['ID'];
						//^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
						
						$allocationArray[$indx]['user'] = $row['user'];
						$allocationArray[$indx]['email'] = $row['email'];
						$allocationArray[$indx]['startDate'] = $row['startDate'];
						$allocationArray[$indx]['endDate'] = $row['endDate'];
						
							
						$indx++;			 
					}
		
					$numAllocations = sizeof($allocationArray);
					echo '<p> There are '.$numAllocations.'&nbsp;entries for your request';
							
					mysql_free_result($eEncoderAllocation_SQLselect_Query);			
			}
		
			{	//		Output 

					$tdOdd = 'style = "background-color: #FF8F8F;"';
					$tdEven = 'style = "background-color: #76E9FF;"';
					
					echo '<div style=" font-family: arial, helvetica, sans-serif; ">';
		
							{	//		Table to render eEncoder detail	
							echo 	  '<table>
											<tr valign="top">								
												<td style=" font-size: 24; 
																font-weight: bold;" 
																>
														'.$encoderIP.'
												</td>
												
												<td align="right" width="400">
														'.$encoderInfo.'			
												</td>
											</tr>
										</table>';
							//		END: Table to render eEncoder detail
							}
															
							echo '<div style="margin-left: 100; ">';
				
							{	//		Table of eEncoderAllocation records
							echo '<table border="1" padding="5">';
								echo '<tr  style="font-variant: small-caps">
											
											<td>User</td>
											<td>Email</td>
											<td>Start Date</td>
											<td>Release Date</td>
											<td>Action</td>
										</tr>	';	
									$accessLevel = $_COOKIE["accessLevel"];		
									//checkAccess = "if (isset($accessLevel) AND $accessLevel >= 21) {"							
								for ($indx = 0; $indx < $numAllocations; $indx++) {
									$thisID = $allocationArray[$indx]['ID'];
									$allocationEditLink = '<a href="index.php
									?content=allocationEditForm&allocationID='.$thisID.'&parentName='.$parentName.'"><u>Edit</u></a>';
									$allocationDeleteLink = '<a href="index.php
									?content='.$thisPage.'&allocationID='.$thisID.'&allocationDelete=1&encoderID='.$encoderID.'"><u>Delete</u></a>';
					
		        					if (($indx % 2) == 1) {$rowClass = $tdOdd; } else { $rowClass = $tdEven; }  
		 
									echo '<tr '.$rowClass.' height="20">
									
													
												
												<td>'.$allocationArray[$indx]['user'].'</td>
		
												<td>'.$allocationArray[$indx]['email'].'</td>
		
												<td>'.date('D M/d/Y H:i:s',$allocationArray[$indx]['startDate']).'</td>
												
												<td>'.date('D M/d/Y H:i:s',$allocationArray[$indx]['endDate']).'</td>';
												if (isset($accessLevel) AND $accessLevel >= 21) {
											echo '<td>'.$allocationEditLink.'&nbsp;&nbsp;&nbsp;&nbsp;'.$allocationDeleteLink.'</td>';
									}
												echo '</tr>	';		
												//<td>'.$allocationEditLink.'</td>.
												
												     
								}
							echo '</table>';
							//		END:  Table of eEncoderAllocation records
							}	
										
										
							//		update code:   coPeopleEdit 0807_12_include
							if (isset($accessLevel) AND $accessLevel >= 21) {										
							{	//		FORM to INSERT person		

								include_once("includes/allocationAddForm.php");
							//		END: FORM to INSERT person		
							}
														
						}										
							echo '</div>';		//		END:  <div style="margin-left: 100; ">
							
					echo '</div>';				//		END:	<div style=" font-family...">
		
			//		END: Output section 
			}
				
		} else {

			{	//	Select company from dropdowm
				
				$eEncoder_SQLselect = "SELECT  ";
				$eEncoder_SQLselect .= "ID, encoderIP ";	
				$eEncoder_SQLselect .= "FROM ";
				$eEncoder_SQLselect .= "eEncoder ";
				$eEncoder_SQLselect .= "Order By encoderIP ";
					
				$eEncoder_SQLselect_Query = mysql_query($eEncoder_SQLselect);	
				
				echo '<form action="'.$thisScriptName.'" method="post">';
				
				echo '<select name="encoderID">';
				
					echo '<option value="0"  selected="selected">..Select Encoder..</option>';
			 	
						while ($row = mysql_fetch_array($eEncoder_SQLselect_Query, MYSQL_ASSOC)) {
						    $ID = $row['ID'];
						    $encoderIP = long2ip($row['encoderIP']);						    						    
						    
						    echo '<option value="'.$ID.'">'.$encoderIP.'</option>';
						}
					
						mysql_free_result($eEncoder_SQLselect_Query);		
				
						echo '</select>';
				echo '&nbsp;&nbsp;&nbsp;&nbsp;';
						echo '<input type="submit" />';
						
				echo '</form>';
				//	END:  Select company from dropdowm
			}
			
		}
		
//		END:	if ($dbSuccess)


echo "<br /><hr /><br />";

unset($encoderID);
echo '<a href="'.$thisScriptName.'"><span class="header ">Select Another</span></a>';
echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
echo '<a href="index.php"><span class="header ">Quit - to homepage</span></a>';

?>