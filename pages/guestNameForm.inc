<legend style = "font-style:italic; font-size:30;">Please Enter Your First Name:</legend>
<div style = "text-align:center;">



<table><tr>
<th colspan = 2 style ="font-size:30; font-style:italic;"></th>

<th id = "display" style ="font-size:30; font-style:italic;"></th>
</tr>
</table>


<?php 
$row1 = array('Q','W','E','R','T','Y','U','I','O','P');
$row2 = array('A','S','D','F','G','H','J','K','L');
$row3 = array('Z','X','C','V','B','N','M','<-');

$rows = array();
$rows[] = $row1;
$rows[] = $row2;
$rows[] = $row3;


$i=0;
foreach($rows as $r=>$row){
	?>
	<table><tr>
	<?php 
	echo("<td style = 'width:".($r*50)."';></td>");
	foreach($row as $l){
	
?>
<td>


	<table style = "border-style:solid; width:50; background-color:ffe23d">
	<tr align="center" onmouseover = "highlightRow('<?php echo $i?>')" 
	    onmouseout = "unhighlightRow('<?php echo $i?>','ffe23d')" 
	    style = "width:50; height:40;" >
	<td id = "<?php echo $i?>" onclick = "letterSelect('<?php echo $i?>')" 
		style = "text-align:center; font-size:30; font-weight:bold"
	><?php echo($l)?></td>
	</tr></table>




</td>


<?php
	 $i++;
	}
	?>
	</tr></table>
<?php
}
?>




<form id = "submitName" method = "POST"> 
<input type = "hidden" id = "name" name = "name" value = "0"/>
<input type = "hidden" name = "guest" value = "true" />
</form>
<form id = "cancel" method = "POST"> 
<input type = "hidden" name = "barcode" value = <?php echo $barcode?> />
</form>


<table style = 'width:600'><tr>
<td style = 'width:200'></td>	
<td>
<table style = "border-style:solid; width:100; background-color:00FF66">
	<tr onmouseover = "highlightRow('submit')" 
	    onmouseout = "unhighlightRow('submit','00FF66')" 
	    style = "width:50; height:40;" >
	<td id = "submit" onclick = "submitName()" 
		style = "text-align:center; font-size:30; font-style:italic">
	Submit
	</td></tr></table>
	
<td style = 'width:200'></td>	
	
</td><td>
	
	
	<table style = "border-style:solid; width:100; background-color:CC3333;">
	<tr onmouseover = "highlightRow('back')" 
	    onmouseout = "unhighlightRow('back','CC3333')" 
	    style = "width:50; height:40;" >
	<td id = "back" onclick = "window.location = 'barcode-page'" 
		style = "text-align:center; font-size:30; font-style:italic">
	Cancel
	</td></tr></table>



<td style = 'width:300'>
</td></tr></table>



</div>