<?php

include_once("scripts.inc");



?>
<link rel = "stylesheet" href = "<?php echo $style_sheet_path?>" type = "text/css" />

<div style = 'width:1000px; margin:0 auto;'>

<fieldset style = "background-color:F0F0F0; width:1000px;">
<legend style = "font-weight:bold; font-size:30;">Please Enter The Number of Volunteer Hours:</legend>
<div style = "text-align:center;">

<table><tr><td>

<table><tr>
<th colspan = 2 style ="font-size:30; font-weight:bold;">Number of Hours: </th>

<th id = "display" style ="font-size:30; font-weight:bold;">0</th>
</tr><tr>


<?php 
$buttons = array();

for($i = 1 ; $i <=9 ; $i++){
	$buttons[$i]=$i;
}
$buttons[10] = ".";
$buttons[0] = "0";
$buttons[11] = "<-";

foreach($buttons as $i=>$b){
	
?>
<td>


	<table style = "border-style:solid; width:100; background-color:99CCFF">
	<tr onmouseover = "highlightRow('<?php echo $i?>')" 
	    onmouseout = "unhighlightRow('<?php echo $i?>','99CCFF')" 
	    style = "width:100; height:80;" >
	<td id = "<?php echo $i?>" onclick = "digitSelect('<?php echo $i?>')" 
		style = "text-align:center; font-size:30; font-weight:bold">
	<?php echo $b?>
	</td></tr></table>




</td>
<?php if($i%3 == 0 && $i!=0) echo("</tr><tr>")?>

<?php }?>
</tr></table>


</td><td style = "width:150px;"></td><td>

<form id = "submitHours" method = "POST"> 
<input type = "hidden" id = "hours" name = "hours" value = "0"/>
<input type = "hidden" name = "barcode" value = <?php echo $barcode?> />
</form>
<form id = "cancel" method = "POST"> 
<input type = "hidden" name = "barcode" value = <?php echo $barcode?> />
</form>

<table style = "border-style:solid; width:200; background-color:00FF66">
	<tr onmouseover = "highlightRow('submit')" 
	    onmouseout = "unhighlightRow('submit','00FF66')" 
	    style = "width:100; height:80;" >
	<td id = "submit" onclick = "submitHours()" 
		style = "text-align:center; font-size:30; font-weight:bold">
	Submit
	</td></tr></table>
	
	<br/><br/>
	
	<table style = "border-style:solid; width:200; background-color:CC3333;">
	<tr onmouseover = "highlightRow('back')" 
	    onmouseout = "unhighlightRow('back','CC3333')" 
	    style = "width:100; height:80;" >
	<td id = "back" onclick = "cancel()" 
		style = "text-align:center; font-size:30; font-weight:bold">
	Cancel
	</td></tr></table>




</td></tr></table>


</div>
</fieldset>
</div>
</body>

<script type = "text/javascript">


function digitSelect(d){

	
	var display = document.getElementById("display");
	var currValue = display.innerHTML;

	if(d == 11){
		if(currValue.length == 1)
			 display.innerHTML = "0";
		else{	 
			currValue = currValue.substring(0,currValue.length -1);
			display.innerHTML = currValue;
		}
			
	}
	else if(d == 10){
		if(currValue.indexOf(".") == -1)
			display.innerHTML = currValue+".";

	}
	else{
		if(currValue == "0") display.innerHTML = "";
		display.innerHTML += d;
	}

	document.getElementById("hours").value = display.innerHTML;
}
function cancel(){
	document.forms['cancel'].submit();
	
}
function submitHours(){
	document.forms['submitHours'].submit();
	

}
</script>
