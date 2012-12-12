<?php
include_once("scripts.inc");
?>
<link rel = "stylesheet" href = "<?php echo $style_sheet_path?>" type = "text/css" />

<div style = 'width:1000px; margin:0 auto;'>

<fieldset style = "background-color:F0F0F0; width:1050px;">


<?php 
if(array_key_exists('name',$_POST)){

	//if name has been entered, enter phone number
	include("guestPhoneForm.inc");

}
else{
	//enter name
	include("guestNameForm.inc");
}
?>

</fieldset>
</div>


<script type = "text/javascript">


function letterSelect(d){

	
	var display = document.getElementById("display");
	var currValue = display.innerHTML;

	if(d == 26){
		if(currValue.length != 0){
			currValue = currValue.substring(0,currValue.length -1);
			display.innerHTML = currValue;
		}
	}
	else{
		var letter = document.getElementById(d).innerHTML;
		display.innerHTML +=letter;
	}

	document.getElementById("name").value = display.innerHTML;
}
function digitSelect(d){

	var display = document.getElementById("display");
	var currValue = display.innerHTML;

	if(d == 11){
		if(currValue.length != 0){

			var back = 1;
			if(currValue.length == 6) back = 3;
			else if (currValue.length == 10) back = 2;
			
			currValue = currValue.substring(0,currValue.length -back);
			display.innerHTML = currValue;
		}
	}

	else{

		if(display.innerHTML.length < 14){

			if(display.innerHTML.length == 0)
				display.innerHTML += '(';

			if(display.innerHTML.length == 4)
				display.innerHTML += ') ';

			if(display.innerHTML.length == 9)
				display.innerHTML += '-';
		
			display.innerHTML += d;
		
		}
		
	}
	
	document.getElementById("phone").value = display.innerHTML;


	
}
function submitName(){
	document.forms['submitName'].submit();

}

function submitGuest(){
	document.forms['guestForm'].submit();
}
                       
</script>
