<?php

$userID = $_POST["userID"];
	if(!isset($userID)) {$userID = $_GET["userID"]; }

$parentName = $_POST["parentName"];
	if(!isset($parentName)) {$parentName = $_GET["parentName"]; }
	
	$userEDIT_SQL = "SELECT * FROM eUser WHERE ID=\"$userID\"";
	$userEDIT_SQL_Query = mysql_query($userEDIT_SQL);
	$result = mysql_fetch_assoc($userEDIT_SQL_Query);


      $access_SQL =  "SELECT accessLevel, userType FROM eAccessControl ";
				$access_SQL .= "ORDER By accessLevel ";
				
				$access_SQL_Query = mysql_query($access_SQL);	
	
				$fld_access = '<select name="accessLevel">';		 
				//$fld_access .= '<option value="0"> -- access level -- </option>';	
					while ($row = mysql_fetch_array($access_SQL_Query, MYSQL_ASSOC)) {
            					    $ID = $row['ID'];
            					    $accessLevel = $row['accessLevel'];
            					    $userType = $row['userType'];
            					    if($row['accessLevel']==$result['accessLevel'])
            					    {
                                       	$fld_access .= '<option value="'.$accessLevel.'"selected="selected">'.$userType.'</option>';
            					    }
            					    else {
            					       
            					    $fld_access .= '<option value="'.$accessLevel.'">'.$userType.'</option>';
            					 }
					}			
					mysql_free_result($access_SQL_Query);			
				$fld_access .= '</select>';				
				
				  

echo '<form name="editUser" action="index.php?content='.$parentName.'" method="post">
			<input type="hidden" name="userEdit" value="1"/>
			<input type="hidden" name="userID" value="'.$result['ID'].'" />
			<table>
			<tr>
			<td>Username &nbsp;</td>
			<td><input type="text" name="userName" value="'.$result['username'].'" required/>
			</tr><tr>
			<td>Email</td>
			<td><input type="email" name="email" value="'.$result['email'].'" SIZE="30" maxlength="100" required/>
			</tr>
			<tr>
			<td>access level &nbsp;</td>
         <td>'.	$fld_access.'</td>		
			</tr>
			<tr>
			<td>&nbsp;</td>
			<td align="right"><input type="submit"  value="Update" /></td>
			</tr>	
			</table>
			</form>';
			
	echo '<br /><hr align=left style="width:550px"/><br />';
echo '<a href="index.php?content=listUsers">List Users</a>';
	
?>