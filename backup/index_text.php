


<?php

/* 
<html>
<head>
<title>Encoder Usage Management</title>
<link href="encoder_main.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="header">
<h2 id="headerh">Encoder Allocation Tool(EAT)</h2>
</div>
<div id="content">





<div id="content_right">
	<?php
									if (file_exists($contentFile)) {include($contentFile);} 
									if (!empty($contentMsg)) { echo $contentMsg; }
								?>
		
</div>


<div id="content_left">

<?php      				
								    if (file_exists($menuFile)) {include($menuFile);} 
								?>

</div>
<div id="footer">

<p id="footerp">© 2014 Copyright . All rights reserved.</p>

</div>

</div>
*/





/*
<div id="outerWrapper">
				<div id="header">
				<p>Encoder Allocation Tool(EAT)</p>
				</div>				
				<div id="innerWrapper">		
								<div id="menuColumn">							
								<?php      				
								    if (file_exists($menuFile)) {include($menuFile);} 
								?>	
								</div>		
								<div id="contentColumn">
								<?php
									if (file_exists($contentFile)) {include($contentFile);} 
									if (!empty($contentMsg)) { echo $contentMsg; }
								?>
								</div>							
									
				</div>
				<div id="footer">				
				<p id="footerp">Copyright &copy; 2014 Akamai Technologies, inc.  All rights reserved.</p>
				</div>

</div>
*/
?>

