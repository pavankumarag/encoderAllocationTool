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

function getUserAndEncoder($encoderID){
            $userID = $_COOKIE["userID"];
				$Get_username_SQL = "SELECT username from eUser WHERE ID = \"$userID\"";
				$Get_username_SQL_Query = mysql_query($Get_username_SQL);
				$result = mysql_fetch_assoc($Get_username_SQL_Query);
				$userName = $result['username'];
				
				$Get_encoderIP_SQL = "SELECT encoderIP,encoderInfo from eEncoder WHERE ID = \"$encoderID\" ";
				$Get_encoderIP_SQL_Query = mysql_query($Get_encoderIP_SQL);
				$result = mysql_fetch_assoc($Get_encoderIP_SQL_Query);
				$encoderIP = $result['encoderIP'];
				$encoderInfo = $result['encoderInfo'];
				return array($userName,$encoderIP,$encoderInfo);

}

function getAllocationDetails($allocationID) {

            $get_SQL = "SELECT encoderID,userID,startDate,endDate from eEncoderAllocation WHERE ID = \"$allocationID\"";
            $result = mysql_query($get_SQL);
            $get_name_SQL = 
            $resultAssoc = mysql_fetch_assoc($result);
            $encoderID = $resultAssoc['encoderID'];
            $startDate = $resultAssoc['startDate'];
            $endDate = $resultAssoc['endDate'];
            $userID =  $resultAssoc['userID'];
            $Get_username_SQL = "SELECT username from eUser WHERE ID = \"$userID\"";
				$Get_username_SQL_Query = mysql_query($Get_username_SQL);
				$result_name = mysql_fetch_assoc($Get_username_SQL_Query);
				$userName = $result_name['username'];
            return array($encoderID,$startDate,$endDate,$userName);

}
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
      $user_SQLselect = "SELECT username FROM eUser WHERE ID = $userID";
      $user_SQLselect_Query = mysql_query($user_SQLselect);
		$result = mysql_fetch_assoc($user_SQLselect_Query);
		$user = $result['username'];
				
				
if(!empty($startDate) && !empty($endDate))
{
			if ($startDate < $endDate)
			 {
					if (!empty($userID)) {
						if (mysql_query($eAllocation_SQLinsert))  {	
						list($userName,$encoderIP,$encoderInfo) = getUserAndEncoder($encoderID);
						$content = "The encoder ".long2ip($encoderIP)." allocation is added  by $userName .&nbsp; Refer below for the changes<br />
                     <br />Added : <br />
                     <p style='font-color:blue;'>
                     <table border='1'><tr style='font-weight:bolder;'><td>Encoder IP</td><td>User</td><td>StartDate</td><td>ReleaseDate</td></tr>
                     <tr><td>".long2ip($encoderIP)."</td><td>$user</td><td>$startDate</td><td>$endDate</td></tr></table>	</p>					
						";
						$subject = "The encoder" .long2ip($encoderIP)." allocation has been added  by $userName";
						
					sendMail($content,$subject);
						
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
		list($encoderID,$beforeStartDate,$beforeEndDate,$beforeAllocationUserName) = getAllocationDetails($allocationID);
      list($userName,$encoderIP,$encoderInfo) = getUserAndEncoder($encoderID);
	
	if(!empty($startDate) && !empty($endDate))
	{
				if ($startDate < $endDate)
				 {
						if (mysql_query($eAllocation_SQLupdate))  
						{	
						list($encoderID,$startDate,$endDate,$allocationUserName) = getAllocationDetails($allocationID);
					 $content = "The encoder ".long2ip($encoderIP)." &nbsp; allocation is Modified  by $userName .&nbsp; Refer below for the changes<br /><br />
                     Before Change :
                     <br />
                     <table border='1'><tr style='font-weight:bolder;'><td>Encoder IP</td><td>User</td><td>StartDate</td><td>ReleaseDate</td></tr>
                     <tr><td>".long2ip($encoderIP)."</td><td>$beforeAllocationUserName</td><td>$beforeStartDate</td><td>$beforeEndDate</td></tr></table>
                     				
                     <br />After Change : <br />
                     <p style='font-color:blue;'>
                     <table border='1'><tr style='font-weight:bolder;'><td>Encoder IP</td><td>User</td><td>StartDate</td><td>ReleaseDate</td></tr>
                     <tr><td>".long2ip($encoderIP)."</td><td>$allocationUserName</td><td>$startDate</td><td>$endDate</td></tr></table>	</p>					
						";
						$subject = "The encoder" .long2ip($encoderIP)."  allocation has been modified  by $userName";						
					   sendMail($content,$subject);
									
							
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
list($encoderID,$startDate,$endDate,$allocationUserName) = getAllocationDetails($allocationID);
list($userName,$encoderIP,$encoderInfo) = getUserAndEncoder($encoderID);

if (mysql_query($eAllocation_SQLdelete))  
						{	
						     // list($userName,$encoderIP,$encoderInfo) = getUserAndEncoder($encoderID);
						    $content = "The encoder ".long2ip($encoderIP)." allocation is DELETED  by $userName .&nbsp; Refer below for the changes<br />
                     <br />Deleted : <br />
                     <p style='font-color:blue;'>
                     <table border='1'><tr style='font-weight:bolder;'><td>Encoder IP</td><td>User</td><td>StartDate</td><td>ReleaseDate</td></tr>
                     <tr><td>".long2ip($encoderIP)."</td><td>$allocationUserName</td><td>$startDate</td><td>$endDate</td></tr></table>	</p>					
						";
						$subject = "The encoder" .long2ip($encoderIP)." allocation has been DELETED  by $userName";
						
					sendMail($content,$subject);
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
				    $content = "The encoder ".long2ip($encoderIP)." is added  by $userName .&nbsp; Refer below for the changes<br />
                     <br />Added : <br />
                     <p style='font-color:blue;'>
                     <table border='1'><tr style='font-weight:bolder;'><td>Encoder IP</td><td>Description</td></tr>
                     <tr><td>".long2ip($encoderIP)."</td><td>$encoderInfo</td></tr></table>	</p>					
						";
						$subject = "The encoder" .long2ip($encoderIP)."  has been added  by $userName";
						
					sendMail($content,$subject);
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

function deleteEncoder($encoderID) {


$eEncoder_SQLdelete = "DELETE FROM eEncoder WHERE ID = \"$encoderID\"";
list($userName,$encoderIP,$encoderInfo) = getUserAndEncoder($encoderID);	

if (mysql_query($eEncoder_SQLdelete))  
						{	
						
                     						
                     $content = "The encoder ".long2ip($encoderIP)." is DELETED  by $userName .&nbsp; Refer below for the changes<br />
                     <br />Deleted : <br />
                     <p style='font-color:blue;'>
                     <table border='1'><tr style='font-weight:bolder;'><td>Encoder IP</td><td>Description</td></tr>
                     <tr><td>".long2ip($encoderIP)."</td><td>$encoderInfo</td></tr></table>	</p>					
						";
						$subject = "The encoder" .long2ip($encoderIP)."  has been DELETED  by $userName";
						
					sendMail($content,$subject);
												
							$errorMsg = "";
						} else 
						{
							$errorMsg = '<p style="color:red;font-weight:bolder">FAILED to DELETE Allocation.</p>'.mysql_error();
						}
return $errorMsg;
}

function updateEncoder($encoderID, $encoderIP, $encoderInfo) {
		
		$eEncoder_SQLupdate = "UPDATE eEncoder SET encoderIP =\"$encoderIP\",encoderInfo = \"$encoderInfo\" WHERE ID = \"$encoderID\" ";	
		list($userName,$beforeEncoderIP,$beforeEncoderInfo) = getUserAndEncoder($encoderID);		         
		   
	if(!empty($encoderIP) && !empty($encoderInfo))
	{
				
						if (mysql_query($eEncoder_SQLupdate))  
						{	
							
						   	list($userName,$encoderIP,$encoderInfo) = getUserAndEncoder($encoderID);		
                     $content = "The encoder ".long2ip($encoderIP)." is Modified  by $userName .&nbsp; Refer below for the changes<br /><br />
                     Before Change :
                     <br />
                     <table border='1'><tr style='font-weight:bolder;'><td>Encoder IP</td><td>Description</td></tr>
                     <tr><td>".long2ip($beforeEncoderIP)."</td><td>$beforeEncoderInfo</td></tr></table>	
                     				
                     <br />After Change : <br />
                     <p style='font-color:blue;'>
                     <table border='1'><tr style='font-weight:bolder;'><td>Encoder IP</td><td>Description</td></tr>
                     <tr><td>".long2ip($encoderIP)."</td><td>$encoderInfo</td></tr></table>	</p>					
						";
						$subject = "The encoder" .long2ip($encoderIP)."  has been modified  by $userName";						
					   sendMail($content,$subject);
							
							$errorMsg = "";
						} else 
						{
							$errorMsg = '<p style="color:red;font-weight:bolder">FAILED to update Encoder.</p>'.mysql_error();
						}
												
	}
	else {
		$errorMsg = '<p style="color:red;font-weight:bolder">ERROR: Encoder IP or Encoder Info is empty. Both are needed to be filled.</p>';
		}
		return $errorMsg;
	
	}	

?>