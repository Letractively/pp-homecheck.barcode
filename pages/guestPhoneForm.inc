<legend style = "font-style:italic; font-size:30;">Please Enter Your Phone Number:</legend>
<div style = "text-align:center;">



<table><tr><td>

<table><tr>
<th colspan = 2 style ="font-size:30; font-style:italic;">Name: </th>

<th id = "nameDisplay" style ="font-size:30; font-style:italic;"><?php echo $_POST['name']?></th>
</tr>
</table>

<table><tr>
<th colspan = 2 style ="font-size:30; font-style:italic;">Phone Number: </th>

<th id = "display" style ="font-size:30; font-style:italic; width:200px"></th>
</tr></table>
<br/>
<table><tr>

<?php 
$buttons = array();

for($i = 1 ; $i <=9 ; $i++){
	$buttons[$i]=$i;
}

$buttons[0] = "0";
$buttons[11] = "<-";

foreach($buttons as $i=>$b){
	
?>
<td>

<?php if ($i == 0) echo ("</td><td>")?>

	<table style = "border-style:solid; width:100; background-color:ffe23d">
	<tr onmouseover = "highlightRow('<?php echo $i?>')" 
	    onmouseout = "unhighlightRow('<?php echo $i?>','ffe23d')" 
	    style = "width:50; height:40;" >
	<td id = "<?php echo $i?>" onclick = "digitSelect('<?php echo $i?>')" 
		style = "text-align:center; font-size:30; font-weight:bold">
	<?php echo $b?>
	</td></tr></table>




</td>
<?php if($i%3 == 0 && $i!=0) echo("</tr><tr>")?>

<?php }?>
</tr></table>

<form id = "guestForm" method = "POST"> 
<input type = "hidden" id = "name" name = "name" value = "<?php echo $_POST['name']?>" />
<input type = "hidden" id = "phone" name = "phone" value ="" />
<input type = "hidden" name = "guest" value = "true" />
</form>
<form id = "cancel" method = "POST"> 
<input type = "hidden" name = "barcode" value = <?php echo $barcode?> />
</form>


</td><td>

<br/><br/><br/>

<table style = "border-style:solid; width:100; background-color:00FF66">
	<tr onmouseover = "highlightRow('submit')" 
	    onmouseout = "unhighlightRow('submit','00FF66')" 
	    style = "width:50; height:40;" >
	<td id = "submit" onclick = "submitGuest()" 
		style = "text-align:center; font-size:30; font-style:italic">
	Submit
	</td></tr></table>
	
	
	<br/>
	
	
	<table style = "border-style:solid; width:100; background-color:CC3333;">
	<tr onmouseover = "highlightRow('back')" 
	    onmouseout = "unhighlightRow('back','CC3333')" 
	    style = "width:50; height:40;" >
	<td id = "back" onclick = "window.location = 'barcode-page'" 
		style = "text-align:center; font-size:30; font-style:italic">
	Cancel
	</td></tr></table>



</td></tr></table>




</div>