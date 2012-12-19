<html>
<?php 
include_once("scripts.inc");
$image_path = "sites/all/modules/barcode/pages/welcome.jpg";
?>
<link rel = "stylesheet" href = "<?php echo $style_sheet_path?>" type = "text/css" />

<form method = "POST" id = "guestForm">
<input type = "hidden" name = "guest" value = "true" />
</form>

<!-- GUEST SIGN IN BUTTON -->
<table class = "button">

	  <tr onmouseover = "highlightRow('guest')" onmouseout = "unhighlightRow('guest','ffe23d')" >
	  <td id = "guest" onclick = "guestRedirect()" style = "text-align:center;">
	  	
	  	<i style = "font-size:15px;">No ID tag?  Sign in here.</i>
	  	<br/>
	  </td></tr>
</table>


<!-- BARCODE INPUT FORM -->
<br/><br/><br/>
<form method = "POST">
<input type = "text" id = "barcode" name = "barcode" />
</form>

<!-- WELCOME IMAGE -->
<img onclick = "barcodeFocus()" src = "<?php echo $image_path?>"
style = "width:90% ; position:absolute; top:50px; left:10px" />
<script>barcodeFocus();</script>


</html>