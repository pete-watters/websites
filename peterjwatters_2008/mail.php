<?php
// The request is a JSON request.
// We must read the input.
// $_POST or $_GET will not work!
 
$data = file_get_contents("php://input");
 
$objData = json_decode($data);
 
//	echo "name: " . $data;
//	echo $objData;
// echo $objData->name;
// echo $objData->email;
// echo $objData->message;

 $to = "peter@peterjwatters.com";
 $subject = "Hi!";
 $name="peter";    
 $from="mcudar@gmail.com";  
 $body="hopefully i make it!";
 $subject="hopefully i make it!";

 if (mail($to, $subject, $body, $from)) {
    echo("<p>Message successfully sent!</p>");
  } 
  else {
   echo("<p>Message delivery failed...</p>");
}

?>