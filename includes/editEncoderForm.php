<?php

$encoderID = $_POST["encoderID"];
	if(!isset($encoderID)) {$encoderID = $_GET["encoderID"]; }

$parentName = $_POST["parentName"];
	if(!isset($parentName)) {$parentName = $_GET["parentName"]; }
	
	$encoderEDIT_SQL = "SELECT * FROM eEncoder WHERE ID=\"$encoderID\"";
	$encoderEDIT_SQL_Query = mysql_query($encoderEDIT_SQL);
	$result = mysql_fetch_assoc($encoderEDIT_SQL_Query);


echo '<form name="editEncoder" action="index.php?content='.$parentName.'" method="post">
			<input type="hidden" name="editEncoder" value="1"/>
			<input type="hidden" name="encoderID" value="'.$encoderID.'" />
			<table>
			<tr>
			<td>Encoder IP &nbsp;</td>
			<td><input type="text" name="encoderIP" value="'.long2ip($result['encoderIP']).'" required/>
			</tr><tr>
			<td>Encoder Info &nbsp;</td>
			<td><input type="text" name="encoderInfo" value="'.$result['encoderInfo'].'" SIZE="70" maxlength="100" required/>
			</tr>
			<tr>
			<td>&nbsp;</td>
			<td align="right"><input type="submit"  value="Update" /></td>
			</tr>	
			</table>
			</form>';
			
	echo '<br /><hr align=left style="width:550px"/><br />';
echo '<a href="index.php?content=availableEncoders">Back to Encoder List</a>';
	
?>