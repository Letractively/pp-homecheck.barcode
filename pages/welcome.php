<html>
<?php 
include_once("scripts.inc");

$image_path = "sites/all/modules/barcode/pages/welcome.jpg";


?>
<link rel = "stylesheet" href = "<?php echo $style_sheet_path?>" type = "text/css" />
<script> 
//places the cursor in the barcode input field and clears the field
function barcodeFocus(){
	document.getElementById('barcode').value = "";
	document.getElementById('barcode').focus();
}
function guestRedirect(){

	document.forms['guestForm'].submit();
}
</script>

<form method = "POST" id = "guestForm">
<input type = "hidden" name = "guest" value = "true" />
</form>

<!-- GUEST SIGN IN BUTTON -->
<table class = "button">

	  <tr onmouseover = "highlightRow('guest')" onmouseout = "unhighlightRow('guest','99CCFF')" >
	  <td id = "guest" onclick = "guestRedirect()" style = "text-align:center;">
	  	<br/>
	  	<b style = "font-size:25px;">Sign in as Guest</b>
	  	<br/><br/>
	  </td></tr>
</table>


<!-- BARCODE INPUT FORM -->
<br/><br/><br/>
<form method = "POST">
<input type = "text" id = "barcode" name = "barcode" />
</form>

<!-- WELCOME IMAGE -->
<img onclick = "barcodeFocus()" src = "<?php echo $image_path?>"
style = "width:100% ; position:absolute; top:100px; left:0px" />
<script>barcodeFocus();</script>





</html>