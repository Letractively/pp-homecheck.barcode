<?php

include_once("scripts.inc");

echo("<div style = 'width:1000px; margin:0 auto;'>");
echo("<table><tr><td style = 'width:765px'>");
echo ("<h2 style = 'font-size:40px;'>Hello, ".ucfirst(strtolower($result['first_name']))."!</h2>");
echo("</td><td>");

$admin = false;
if($result['first_name'] == "ADMIN") $admin = true;
?>

<link rel = "stylesheet" href = "<?php echo $style_sheet_path?>" type = "text/css" />

<table class = "button">

	  <tr onmouseover = "highlightRow('vol')" onmouseout = "unhighlightRow('vol','99CCFF')" >
	  <td id = "vol" onclick = "volRedirect()" style = "text-align:center;">
	  	<br/>
	  	<b style = "font-size:25px;">Volunteer Hours</b>
	  	<br/><br/>
	  </td></tr></table>

<?php echo("</td></tr></table>");?>

<fieldset style = "background-color:F0F0F0; width:1000px;">
<legend style = "font-weight:bold; font-size:30;">Your Membership:</legend>

	<table><tr>
	<td style = 'width:700px;'>
	<?php 
	
		//if the user is logged in under the ADMIN contact
		if($admin){
			
			echo("<h3>You are currently logged in as an administrator. Below are all inactive events. Select any event to active it in your CivicRM database.</h3>");	
		}
	
		//if the user is a guest and no membership record was found
		elseif(strcmp($result['last_name'], "GUEST") == 0){
			
			echo("<h3>You are currently logged in as a guest. Please see the front desk if you would like to register as a member.</h3>");	
			
		}
		//otherwise, show contact info
		else{
			echo("<table>");
			echo("<tr><th>Name:</th><td>".ucFirst($result['first_name'])." ".$result['last_name']."</td></tr>");
			echo("<tr><th>Email:</th><td>".$result['email']."</td></tr>");
			echo("<tr><th>Phone:</th><td>".$result['phone']."</td</tr>");
			echo("</table>");
		}
		
	?>
	</td>
	<td style = 'width:50px;'></td>
	<td>
	
	  <table class = "button">
	     <tr onmouseover = "highlightRow('logout')" onmouseout = "unhighlightRow('logout','99CCFF')" >
	     <td id = "logout" onclick = "window.location = 'barcode-page'" style = "text-align:center;">
	  	  <br/>
	  	  <b style = "font-size:25px;">Logout</b>
	  	  <br/><br/>
	    </td></tr>
	  </table>	
	
	</td></tr></table>
</fieldset>


<fieldset style = "background-color:F0F0F0; width:1000px;">
<?php 
if ($admin) $legend = "Inactive Events";
else $legend = "Today's Events";
?>
<legend style = "font-weight:bold; font-size:30;"><?php echo $legend?>:</legend>

<?php 
	echo("<table style = 'border-style:hidden;'>");
	$i = 0;
	
	foreach($events as $e){
	
		if($i%2 == 0) echo("<tr>");
		echo("<td style = 'padding:20px;'>");
	?>
	
  <!-- EVENT BUTTON -->
	<table style = "border-style:solid; width:400; background-color:99CCFF">

	  <tr onmouseover = "highlightRow('<?php echo $e['id']?>')" onmouseout = "unhighlightRow('<?php echo $e['id']?>','99CCFF')" style = "width:200; height:200;" >
	  <td id = "<?php echo $e['id']?>" onclick = "eventSelect('<?php echo $e['id']?>')" style = "text-align:center">
		<?php 
		echo("<h1>".$e['title']."</h1>");
		
		if($admin) $time = $e['event_start'];
		else{
		   $s = strtotime($e['event_start']);
		   $sTime = date("g:i a",$s);
		   $time = $sTime;
		}
		echo("<h2>".$time."</h2>");
		
		//insert any other event information here
		
		?> 
	  </td>
	  </tr>
	</table>
 <!--  END EVENT BUTTON -->

<br/><br/>
<?php 
		echo("</td>");
		
		//end row every 2 events
		if($i%2 != 0) echo("</<tr>");
		
		$i++;
	} 
	
	echo("</table>"); ?>


</fieldset>

<form method = "POST" id = "checkinForm">
<input type = "hidden" name = "event" id = "event" value = "0" />
<input type = "hidden" name = "barcode" id = "barcode" value = "<?php echo $barcode ?>" />
</form>
<form method = "POST" id = "volForm">
<input type = "hidden" name = "volunteer" id = "volunteer" value = "true" />
<input type = "hidden" name = "barcode" id = "barcode" value = "<?php echo $barcode ?>" />
</form>


<?php echo("</div>");?>
</body>

<script type = "text/javascript"> 


function eventSelect(target){
	
	var event = document.getElementById("event");
	event.value = target;
	
	document.forms['checkinForm'].submit();
}
function volRedirect(){

	document.forms['volForm'].submit();
}


</script>
