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

		if (!empty($userID)) {
			if (mysql_query($eAllocation_SQLinsert))  {	
				$errorMsg = "";
			} else {
				$errorMsg = "FAILED to add new Allocation.".mysql_error();
			}
		} else {
			$errorMsg = '<p style="color:red;font-weight:bolder">ERROR: Cannot add allocation with no UserName.</p>';
		}		
		return $errorMsg;
	}	

	function personUpdate($personID, $Salutation, $FirstName, $LastName, $Tel, $eMail, $companyID) {
		
		$eAllocation_SQLupdate = "UPDATE eAllocation SET ";			
		$eAllocation_SQLupdate .=  "CompanyID = '".$companyID."', "; 
		
		$eAllocation_SQLupdate .=  "Salutation = '".$Salutation."', ";
		$eAllocation_SQLupdate .=  "FirstName = '".$FirstName."', ";
		$eAllocation_SQLupdate .=  "LastName = '".$LastName."', ";
		$eAllocation_SQLupdate .=  "Tel = '".$Tel."', ";
		$eAllocation_SQLupdate .=  "eMail = '".$eMail."' ";
		$eAllocation_SQLupdate .=  "WHERE ID = '".$personID."' "; 	
	
		if (!empty($LastName)) {
			if (mysql_query($eAllocation_SQLupdate))  {	
				$errorMsg = "";
			} else {
				$errorMsg = "FAILED to update person.";
			}
		} else {
			$errorMsg = "Cannot make Lastname empty.";
		}		
		
		return $errorMsg;
	}	


?>