<?php	

								{	//		Create the personAdd form fields
								
								$dateVal = date("Y-m-d\TH:i",time());
								
								$fld_name = '<input type="text" name="name" placeholder="name" size="10" maxlength="20" required/>';
								//$fld_email = '<input type="email" name="email"  placeholder="yourname@mail.com" size="10" maxlength="50"/>';
								$fld_startDate = '<input type="datetime-local" name="startDate"  value="'.$dateVal.'" " size="20" maxlength="50" required/>';
								$fld_endDate = '<input type="datetime-local" name="endDate"   size="20" maxlength="50" required/>';			
								//		END: Create the personAdd form fields
								}						

								{	//	create the username DROPDOWN  FIELD 
										$username_SQL =  "SELECT username,ID FROM eUser WHERE accessLevel = 21 ORDER BY username ";									
										$username_SQL_Query = mysql_query($username_SQL);									
										$fld_username = '<select name="username" >';
										$fld_username .= '<option value="0"  selected="selected">..Select User..</option>';																			 	
										while ($row = mysql_fetch_array($username_SQL_Query, MYSQL_ASSOC)) {
											    $userID = $row['ID'];
											    $userName = $row['username'];
											    $fld_username .= "<option value=".$userID.">".$userName."</option>";										   
											}
								
										$fld_username .= '</select>';
										
									//	END: create the Salutation DROPDOWN  FIELD 
								}	
							echo '<form name="allocationInsert" action="index.php?content='.$parentName.'" method="post">';
							echo '<input type="hidden" name="newAllocation" value="1" />';
							echo '<input type="hidden" name="timeZone" value="'.date_default_timezone_get().'"/>';
								echo '<input type="hidden" name="encoderID" value="'.$encoderID.'" />';
								
								echo '<table>';										
											echo ' <br /><br /><tr style="font-variant:small-caps">
														<td>User</td>
														<td>Start Date</td>
														<td>Release Date</td>
														</tr>';
										echo '<tr>
												<td>'.$fld_username.'</td>
												<td>'.$fld_startDate.'</td>
												<td>'.$fld_endDate.'</td>
												<td>&nbsp;&nbsp;<input type="submit" value="Add" /></td>
											</tr>	';	
								echo '</table>';
							echo '</form>';
								
?>							