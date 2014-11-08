<?php
function tz_list() {
  $zones_array = array();
  $timestamp = time();
  foreach(timezone_identifiers_list() as $key => $zone) { 	
    date_default_timezone_set($zone);
    $zones_array[$key]['zone'] = $zone;
    $zones_array[$key]['diff_from_GMT'] = 'UTC/GMT '. date('P', $timestamp);
  }
  return $zones_array;
  }
  
  
  
 $timeStamp  = time();
$fld_timezone = '<select name="timeZone">
									<option value="0" selected="selected">Please, select timezone</option>';
									
									
									//date_default_timezone_set('GMT');
foreach(timezone_identifiers_list() as $key => $zone) {  	
	date_default_timezone_set($zone);
    $zone_time = 'UTC/GMT '. date('P', $timeStamp);
    $fld_timezone .= '<option value="'.$zone.'">'.$zone.'&nbsp;&nbsp;&nbsp;-'.$zone_time.'</option>';
  } 
  
  date_default_timezone_set($timeZoneSet);
 /* foreach( tz_list() as $t) {
 $fld_timezone .=  '<option value="'.$t['zone'].'">'.$t['zone'].' -&nbsp;&nbsp;'.$t['diff_from_GMT'].'</option>';
  	}*/
 // echo $fld_timezone;
  
  
$fld_timezone .= '</select>';
echo '<form name="timeZone" action="index.php" method="post">
			<table>
			<tr>
			<td>The current time zone set is<u> '.date_default_timezone_get().'</u>&nbsp;&nbsp;</td>
			<td>'.$fld_timezone.'</td>						
			<td><input type="submit" value="Set" SIZE="20"></input></td>
			</tr>
			</table>
			';
			
?>			