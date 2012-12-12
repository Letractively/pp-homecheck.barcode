<link rel = "stylesheet" href = "<?php echo $style_sheet_path?>" type = "text/css" />
<?php
if($admin){
	$message = "<h1>You have successfully activated ".$event['event_title']."</h1>";
	
	
}
elseif($event['is_monetary']){
	
	//check to see if the member has paid for this event
	$registration = get_registration($result['contact_id'], $eventID);
	
	//no registration found
	if(!$registration)
		$message = "<h1>To check in for this event, please pay the event fee at the front desk. </h1>";
		
	//otherwise, check them in	
	else{
		
		$message  = "<h1>Thanks for checking in for ".$event['event_title']."</h1>";
    	$message .= "<h2>Enjoy your visit!</h2>";
		
    	//if we just created the participant result, we don't have to update the status
		if(!array_key_exists("values",$result)){
			
		
    	/*
    	 * This section should change the status of a pre-registered participant from "registered" to "attended"
    	 * There is a bug in version 3.4.0 of civicrm that prevents the api from changing the status
    	 */
			$params = array(
                      'id'    => $registration['participant_id'],
                      'status_id'     => 2,
                      'register_date' => date("Y-m-d"),
					  'fee_amount'	=> $registration['fee_amount'],
                      'version' 		=> 3
                      );
         
        	 $result = civicrm_api('participant','update',$params );

		}
		
	}
	
}
//otherwise, the event is free, so just check them in
else{
	
	create_participant_record($result['contact_id'], $eventID);


    $message  = "<h1>Thanks for checking in for ".$event['event_title']."</h1>";
    $message .= "<h2>Enjoy your visit!</h2>";
    
    
}
	echo("<div style = 'text-align:center;'");
	  for($i = 0 ; $i < 12 ; $i++)
    	  echo("<br/>");
	
      echo($message);
	
    echo("</div>");

    
/**
 * 
 * Creates a participant record with no payment record for free or pre-paid events.
 * The participant is recorded as having attended the event.
 * @param  $contactID the civicrm database contact ID of the participant
 * @param  $eventID the civicrm database event ID 
 */    
    
function create_participant_record($contactID, $eventID){
	
	$params = array(
                    'contact_id'    => $contactID,
                    'event_id'      => $eventID,
                    'status_id'     => 2,
                    'role_id'       => 1,
                    'register_date' => date("Y-m-d"),
                    'version' 		=> 3
                    );
 
              
    $result = civicrm_api('participant','create',$params );
	return $result;
	
}
/**
 * 
 * This function is used to check whether a contact has registered and paid for a
 * monetary event. The functino will use the api to get all participant records
 * for a given contact for a particular event. It will then loop through
 * these records. If it finds an instance of a paid registration of 
 * fee level type "Session", it will create a new participant record to mark
 * this instance of attendance. If it finds an instance of a paid registration of 
 * fee level type "Single Day", it will return this instance so its status can be changed
 * from "registered" to "attended". If no valid pre-registration is found, it will return false.
 * 
 * @param  $contactID the civicrm database contact ID
 * @param  $eventID	the civicrm database event ID
 */
function get_registration($contactID, $eventID){
	
	//check if member has registered for the event
	$params = array(
                    'contact_id'    => $contactID,
                    'event_id'      => $eventID,
                    'version' 		=> 3
                    );
 
                
    $result = civicrm_api('participant','get', $params);
    $values = $result['values'];
    
    
    //no registrations found
    if(sizeof($values) == 0) return false;
   
    foreach ($values as $v)
    {
    	if(array_key_exists('participant_fee_amount',$v)){
    		
    		 
    		
    		//paid for a single day, return registration to mark as "attended"
    		if($v['participant_fee_level'] == "Single Day" && $v['participant_status_id'] == 1){
    	    	return $v;
    		}
    		
    		//paid for full session
    	    if($v['participant_fee_level'] == "Session"){
    	    	
    	    		
    	    	//create new participant record to store this instance of attendance
    	    	$result = create_participant_record($contactID, $eventID);    	    	
    	    	return $result;
    	    }
    	    
    	}
    }
   
    
    return false;
	
	
}
    
?>

<script type = "text/javascript">

//redirect back to the welcome page after 5000 ms (5 sec)
redirectWait();

function redirectWait(){
	var t = setTimeout("window.location = 'barcode-page'",5000);
	
}

</script>