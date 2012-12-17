<script type = "text/javascript"> 

function highlightRow(rowID){
	document.getElementById(rowID).style.backgroundColor = "Yellow";
}
function unhighlightRow(rowID, c){
	document.getElementById(rowID).style.backgroundColor = c;
}

//places the cursor in the barcode input field and clears the field
function barcodeFocus(){
	document.getElementById('barcode').value = "";
	document.getElementById('barcode').focus();
}
function guestRedirect(){
	document.forms['guestForm'].submit();
}

</script>