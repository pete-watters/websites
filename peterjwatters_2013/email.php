<?php

// The request is a JSON request.
// We must read the input.
// $_POST or $_GET will not work!
$data = file_get_contents("php://input");
$objData = json_decode($data); 
$to = "peter@peterjwatters.com";

// define variables and initialize with empty values
$Err = "";
$name= htmlspecialchars($objData->name);            
$subject= htmlspecialchars( $objData->subject);
$body= htmlspecialchars( $objData->message);
$from=htmlspecialchars($objData->email);  	  		


function check_email_address($email) {
	  // First, we check that there's one @ symbol, 
	  // and that the lengths are right.
	  if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
	    // Email invalid because wrong number of characters 
	    // in one section or wrong number of @ symbols.
	    return false;
	  }
	  // Split it into sections to make life easier
	  $email_array = explode("@", $email);
	  $local_array = explode(".", $email_array[0]);
	  for ($i = 0; $i < sizeof($local_array); $i++) {
	    if
	(!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&↪'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$",$local_array[$i])) {
	      return false;
	    }
	  }
	  // Check if domain is IP. If not, it should be valid domain name
	  if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) {
	    $domain_array = explode(".", $email_array[1]);
	    if (sizeof($domain_array) < 2) {
	        return false; // Not enough parts to domain
	    }
	    for ($i = 0; $i < sizeof($domain_array); $i++) {
	      if
	(!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|↪([A-Za-z0-9]+))$",$domain_array[$i])) {
	        return false;
	      }
	    }
	  }
	  return true;
	}

	function check_email_name($name) {
	    if (empty($name)) {
	        $Err = "Missing Name";
	        return false;
	    	}
	        return true;
	}

	function check_email_subject($subject) {
	  if (empty($subject)) {
	        $Err = "Missing Subject";
	        return false;
	    	}
			return true;
	}

	function check_email_body($body) {
	  if (empty($body)) {
	        $Err = "Missing Message";
	        return false;
	    	}
			return true;	   		
	}

	$email_valid = check_email_address($from);
	$body_valid = check_email_body($body);
	$subject_valid = check_email_subject($subject);
	$name_valid = check_email_name($name);

	if($from && $name_valid){	
		$headers = "From:" . $name . "  ". $from;
		$Err = "Invalid header";
	}

	//if (mail($to, $subject, $body, $headers)) {
	if ($email_valid && $subject_valid && $name_valid && $body_valid) {
		// send  the email
	    //	mail($to, $subject, $body, $headers);
	    echo("Your message has been sent successfully");
	  } 
	else {
		if (!$email_valid){
			echo("Invalid Email");
		}elseif (!$subject_valid) {
			echo("Invalid Subject");
		}elseif (!$name_valid) {
			echo("Invalid Name");
		}elseif (!$body_valid) {
			echo("Invalid Body");
		}
		else{
			echo("Request failed");	
		}
	   
}
?>