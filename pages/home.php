<?php

include_once("scripts.inc");

echo("<div style = 'width:580px; margin:0 auto;'>");
echo("<table><tr><td style = 'width:400px'>");
echo ("<h2 style = 'font-size:24px;'>Hello, ".ucfirst(strtolower($result['first_name']))."!</h2>");
echo("</td>");

$admin = false;
if($result['first_name'] == "ADMIN") $admin = true;
?>
<link rel = "stylesheet" href = "<?php echo $style_sheet_path?>" type = "text/css" />
	<td><table class = "button">
	  <tr onmouseover = "highlightRow('vol')" onmouseout = "unhighlightRow('vol','00FF66')" >
	  <td id = "vol" onclick = "volRedirect()" style = "text-align:center;background-color:00FF66;width:150;height:40">
	  	
	  	<b style = "font-style:italic;font-size:20px" >Volunteer&nbsp;Hours</b>
	  	
	  </td></tr></table></td>
	  	
	<td><table class = "button">
	     <tr onmouseover = "highlightRow('logout')" onmouseout = "unhighlightRow('logout','CC3333')" >
	     <td id = "logout" onclick = "window.location = 'barcode-page'" style = "text-align:center;background-color:CC3333;width:50;height:40">
	  	  
	  	  <b style = "font-style:italic;font-size:20px">Logout</b>
	  	  
	    </td></tr>
	  </table></td>	
	
<?php echo("</tr></table>");?>

<fieldset style = "background-color:F0F0F0; width:550px;">
<legend style = "font-weight:bold; font-size:20px;">Your Membership:</legend>

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
			echo("<tr><td><b>Name:</b></td><td>".$result['first_name']." ".$result['last_name']."</td></tr>");		
			echo("<tr><td><b>Email:</b></td><td>".$result['email']."</td></tr>");
			echo("<tr><td><b>Phone:</b></td><td>".$result['phone']."</td></tr>");
			if ($result[$expirationdate_field]!="")
				echo("<tr><td><b>Membership Expires:</b></td><td>".substr($result[$expirationdate_field],0,10)."</td></tr>");
			else echo("<tr><td></td><td>(not a member)</td></tr>");
			echo("</table>");
		}
		
	?>
	</td>
	<td style = 'width:50px;'></td>
	<td>

	
	</td></tr></table>
</fieldset>


<fieldset style = "background-color:F0F0F0; width:550px;">
<?php 
if ($admin) $legend = "Inactive Events";
else $legend = "Sign in for One of Today's Events";
?>
<legend style = "font-weight:bold; font-size:20;"><?php echo $legend?>:</legend>

<?php 
	echo("<table style = 'border-style:hidden;'>");
	$i = 0;
	
	foreach($events as $e){
	
		if($i%2 == 0) echo("<tr>");
		echo("<td style = 'padding:10px;'>");
	?>
	
  <!-- EVENT BUTTON -->
	<table style = "border-style:solid; width:230; background-color:ffe23d">

	  <tr onmouseover = "highlightRow('<?php echo $e['id']?>')" onmouseout = "unhighlightRow('<?php echo $e['id']?>','ffe23d')" style = "width:100; height:100;" >
	  <td id = "<?php echo $e['id']?>" onclick = "eventSelect('<?php echo $e['id']?>')" style = "text-align:center">
		<?php 
		echo("<b>".$e['title']."</b>");
		
		if($admin) $time = $e['event_start'];
		else{
		   $s = strtotime($e['event_start']);
		   $sTime = date("g:i a",$s);
		   $time = $sTime;
		}
		echo("<br><b>".$time."</b>");
		
		//insert any other event information here
		
		?> 
	  </td>
	  </tr>
	</table>
 <!--  END EVENT BUTTON -->


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
<input type = "hidden" name = "name" value = <?php echo $name?> />
<input type = "hidden" name = "phone" value = <?php echo $phone?> />
<input type = "hidden" name = "barcode" id = "barcode" value = "<?php echo $barcode ?>" />
</form>
<form method = "POST" id = "volForm">
<input type = "hidden" name = "volunteer" id = "volunteer" value = "true" />
<input type = "hidden" name = "name" value = <?php echo $name?> />
<input type = "hidden" name = "phone" value = <?php echo $phone?> />
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
