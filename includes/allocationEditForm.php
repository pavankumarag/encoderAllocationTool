<?php

/*		INCLUDE FILE:   allocationEditForm.php
*
*		folder:			includes/
*
*		used in:       index.php
*
*		version:    	0901   date: 2010-07-01
*
*		purpose:			EDIT FORM for selected allocation
*
*	===========================================================================
*/		

		{	//		Get the details of the person selected 
			$allocationID = $_GET["allocationID"];	
			$timeZone = $_GET["timeZone"];
			$parentName = $_POST["parentName"];
	if(!isset($parentName)) {$parentName = $_GET["parentName"]; }			
//echo $timeZone;		

date_default_timezone_set($timezone);
	echo 'The current time zone set is<u> '.date_default_timezone_get().'</u>';		
	
					
			$eAllocation_SQLselect = "SELECT * ";
			$eAllocation_SQLselect .= "FROM ";
			$eAllocation_SQLselect .= "eEncoderAllocation ";
			$eAllocation_SQLselect .= "WHERE ID = '".$allocationID."' ";
			
			$eAllocation_SQLselect_Query = mysql_query($eAllocation_SQLselect);	
			
			while ($row = mysql_fetch_array($eAllocation_SQLselect_Query, MYSQL_ASSOC)) {
				$current_encoderID = $row['encoderID'];
				$current_userID = $row['userID'];
				$current_startDate = date("Y-m-d\TH:i",$row['startDate']);
				$current_endDate = date("Y-m-d\TH:i",$row['endDate']);
				
			}
			
		//  END: Get the details of the person selected 
		}

		{	//		Create form fields 
			$fld_allocationID = '<input type="hidden" name="allocationID" value="'.$allocationID.'"/>';
			$fld_allocationEdit = '<input type="hidden" name="allocationEdit" value="1"/>';
	
			$fld_startDate = '<input type="datetime-local" name="startDate" value="'.$current_startDate.'" required/>';
			$fld_endDate = '<input type="datetime-local" name="endDate" value="'.$current_endDate.'" required/>';
			
		//  END: Create form fields 
		}

		
							{	//	create the username DROPDOWN  FIELD 
										$username_SQL =  "SELECT username,ID FROM eUser WHERE accessLevel = 21 ORDER BY username ";									
										$username_SQL_Query = mysql_query($username_SQL);									
										$fld_username = '<select name="username">';
										//$fld_username .= '<option value="0"  selected="selected">..Select User..</option>';																			 	
										while ($row = mysql_fetch_array($username_SQL_Query, MYSQL_ASSOC)) {
											    $userID = $row['ID'];
											    $userName = $row['username'];
											    if($current_userID == $userID){
											    $fld_username .=  '<option value='.$userID.' selected="selected">'.$userName.'</option>';	
											 }
											 else {
											 $fld_username .= "<option value=".$userID.">".$userName."</option>";	
											 }							   
											}
								
										$fld_username .= '</select>';
										
									//	END: create the Salutation DROPDOWN  FIELD 
								}			
		
		
							{	//	create the encoder DROPDOWN  FIELD 
										$encoderList_SQL =  "SELECT ID,encoderIP FROM eEncoder ORDER BY encoderIP ";									
										$encoderList_SQL_Query = mysql_query($encoderList_SQL);									
										$fld_encoderList = '<select name="encoderID">';
										//$fld_encoderList .= '<option value="0"  selected="selected">..Select Encoder..</option>';																			 	
										while ($row = mysql_fetch_array($encoderList_SQL_Query, MYSQL_ASSOC)) {
											    $encoderID = $row['ID'];
											    $encoderIP = long2ip($row['encoderIP']);
											    if($current_encoderID == $encoderID){
											    $fld_encoderList .= '<option value='.$encoderID.' selected="selected">'.$encoderIP.'</option>';	
											 }	
											 else {
											 	$fld_encoderList .= "<option value=".$encoderID.">".$encoderIP."</option>";	
											 }								   
											}
								
										$fld_encoderList .= '</select>';
										
									//	END: create the Salutation DROPDOWN  FIELD 
								}			
		
		
		{	//	render the FORM 
				echo '<br />';
			echo '<form name="postAllocation" action="index.php?content='.$parentName.'" method="post">';
			echo $fld_allocationEdit;
		
				echo $fld_allocationID;
				//echo $fld_saveClicked;
				echo '
				<table>
					<tr>
						<td>Encoder</td>
						<td>'.$fld_encoderList.'</td>
					</tr>
					<tr>
						<td>User Name</td>
						<td>'.$fld_username.'</td>
					</tr>
					<tr>
						<td>Start Date</td>
						<td>'.$fld_startDate.'</td>
					</tr>
					<tr>
						<td>Release Date</td>
						<td>'.$fld_endDate.'</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td align="right"><input type="submit"  value="Save" /></td>
					</tr>					
				</table>
				';
					
			echo '</form>';
		//		END: render the FORM 
		}

echo '<br /><hr align=left style="width:550px"/><br />';
echo '<a href="index.php?content='.$parentName.'&encoderID='.$current_encoderID.'">Back to Encoder Allocation List</a>';
echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
echo '<a href="index.php?content=availableEncoders">Back to Encoder List</a>';

?>