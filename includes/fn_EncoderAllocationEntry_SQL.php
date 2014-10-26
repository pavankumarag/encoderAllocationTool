<?php

/*		INCLUDE FILE:   fn_EncoderAllocationEntry_SQL.php
*
*		folder:			includes/
*
*		used in:       index.php
*
*		version:    	0901   date: 2010-07-01
*
*		purpose:			FUNCTIONS:
*							personInsert - INSERTS new eAllocation record
*							personUpdate - UPDATES edits from tp_personEditForm.php
*
*	===========================================================================
*/		

	function allocationInsert($encoderID, $userID, $startDate, $endDate) {

	/*echo $encoderID;
	echo $userID;
	echo $startDate;
	echo $endDate;*/
		$eAllocation_SQLinsert = "INSERT INTO eEncoderAllocation (";			
		$eAllocation_SQLinsert .=  "encoderID, ";
		$eAllocation_SQLinsert .=  "userID, ";		
		$eAllocation_SQLinsert .=  "startDate, ";	
		$eAllocation_SQLinsert .=  "endDate ";
		$eAllocation_SQLinsert .=  ") ";
		
		$eAllocation_SQLinsert .=  "VALUES (";
		$eAllocation_SQLinsert .=  "'".$encoderID."', ";
		$eAllocation_SQLinsert .=  "'".$userID."', ";
		$eAllocation_SQLinsert .=  "'".$startDate."', ";	
		$eAllocation_SQLinsert .=  "'".$endDate."' ";
		$eAllocation_SQLinsert .=  ") ";

if(!empty($startDate) && !empty($endDate))
{
			if ($startDate < $endDate)
			 {
					if (!empty($userID)) {
						if (mysql_query($eAllocation_SQLinsert))  {	
							$errorMsg = "";
						} else {
							$errorMsg = '<p style="color:red;font-weight:bolder">FAILED to add new Allocation.</p>'.mysql_error();
						}
					} else {
						$errorMsg = '<p style="color:red;font-weight:bolder">ERROR: Cannot add allocation with no UserName.</p>';
					}	
			}
			else
			{
					$errorMsg = '<p style="color:red;font-weight:bolder">ERROR: StartDate cannot be later than ReleaseDate .</p>';
			}
}
else {	
$errorMsg = '<p style="color:red;font-weight:bolder">ERROR: StartDate or Release Date empty .</p>';
}	
			
		return $errorMsg;
	}	

	function allocationUpdate($allocationID, $encoderID, $userID, $startDate, $endDate) {
		
		$eAllocation_SQLupdate = "UPDATE eEncoderAllocation SET ";			
		$eAllocation_SQLupdate .=  "encoderID = '".$encoderID."', "; 
		
		$eAllocation_SQLupdate .=  "userID = '".$userID."', ";
		$eAllocation_SQLupdate .=  "startDate = '".$startDate."', ";
		$eAllocation_SQLupdate .=  "endDate = '".$endDate."' ";
		$eAllocation_SQLupdate .=  "WHERE ID = '".$allocationID."' "; 	
	
	if(!empty($startDate) && !empty($endDate))
	{
				if ($startDate < $endDate)
				 {
						if (mysql_query($eAllocation_SQLupdate))  
						{	
							$errorMsg = "";
						} else 
						{
							$errorMsg = '<p style="color:red;font-weight:bolder">FAILED to update Allocation.</p>'.mysql_error();
						}
				} 
				else
				 {
						$errorMsg = '<p style="color:red;font-weight:bolder">ERROR: StartDate cannot be later than ReleaseDate .</p>';
				}										
	}
	else {
		$errorMsg = '<p style="color:red;font-weight:bolder">ERROR: StartDate or Release Date empty .</p>';
		}
		return $errorMsg;
	
	}	


function allocationDelete($allocationID) {

$eAllocation_SQLdelete = "DELETE FROM eEncoderAllocation WHERE ID = \"$allocationID\"";

if (mysql_query($eAllocation_SQLdelete))  
						{	
							$errorMsg = "";
						} else 
						{
							$errorMsg = '<p style="color:red;font-weight:bolder">FAILED to DELETE Allocation.</p>'.mysql_error();
						}
return $errorMsg;
}

function insertEncoder($IP, $info) {
	
		$encoderIP = ip2long($IP);
		$encoderInfo = $info;
		
		if(!empty($encoderIP) && !empty($encoderInfo))
		{
				$encoder_SQLinsert = "INSERT INTO eEncoder (encoderIP,encoderInfo) VALUES (\"$encoderIP\",\"$encoderInfo\")";
				if(mysql_query($encoder_SQLinsert))
				 {
						$errorMsg = "";
					}
					else
					{
							$errorMsg = '<p style="color:red;font-weight:bolder">FAILED to Add Encoder.</p>'.mysql_error();
						}
		} 
		else
		 {
		
	 $errorMsg = '<p style="color:red;font-weight:bolder">ERROR: Encoder IP  or Information not entered .</p>';
		}
		return $errorMsg;
}

?>