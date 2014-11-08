<?php
/*$tzlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
//echo $tzlist;
echo '<select name="timeZone">';
echo '<option value="0">Please, select timezone</option>';
foreach ( $tzlist as $key => $value){
echo '<option value="'.$value.'">'.$value.'</option>';	
	
/*echo $key;
echo 	 $value;
echo "\n";
}*/
echo '</select>';


function tz_list() {
  $zones_array = array();
  $timestamp = time();
  foreach(timezone_identifiers_list() as $key => $zone) {
    date_default_timezone_set($zone);
    $zones_array[$key]['zone'] = $zone;
    $zones_array[$key]['diff_from_GMT'] = 'UTC/GMT ' . date('P', $timestamp);
  }
  return $zones_array;
}
?>

<div style="margin-top: 20px;">
  <select name="timeZone">
    <option value="0">Please, select timezone</option>
    <?php foreach(tz_list() as $t) { ?>
      <option value="<?php print $t['zone'] ?>">
        <?php print $t['zone'] . ' &nbsp;&nbsp;&nbsp;- ' .$t['diff_from_GMT']  ?>
      </option>
    <?php } ?>
  </select>
</div>



<?php



echo $_GET['timeZone'];
?> 
<!--
<?php
$timeZone = $_POST['timeZone'];
if(!isset($timeZone)) {$timeZone = $_GET['timeZone']; }
if(!isset($timeZone)) {$timeZone = 'GMT'; }
date_default_timezone_set($timeZone);
echo date("r",time());

$fld_timezone = '<select name="timeZone">';
foreach(timezone_identifiers_list() as $key => $zone) {  	
    $zones_array[$key]['zone'] = $zone;
    $zone_time = 'UTC/GMT ' . date('P', time());
    $fld_timezone .= '<option value="'.$zone.'">'.$zone.'&nbsp;&nbsp;&nbsp;-'.$zone_time.'</option>';
  } 
  $fld_timezone .= '</select>';
  
 
echo '<div align=right><form name="timeZone" action="timeZonetest.php" method="post">
			<table>
			<tr>
			<td>'.$fld_timezone.'</td>
			
			
			<td><input type="submit" value="Set" SIZE="20"></input></td>
			</tr>
			</table>
			</form></div>';



?>
-->
