<?php
// The request is a JSON request.
// We must read the input.
// $_POST or $_GET will not work!
 
$data = file_get_contents("php://input");
$objData = json_decode($data);
 
$to = "peter@peterjwatters.com";
$body=$objData->message;
$subject=$objData->subject;
$name= $objData->name;    
$from=$objData->email;  
$headers = "From:" $name . "  ". $from;

if (mail($to, $subject, $body, $headers)) {
    echo("<p>Message successfully sent!</p>");
  } 
else {
   echo("<p>Message delivery failed...</p>");
}
?>