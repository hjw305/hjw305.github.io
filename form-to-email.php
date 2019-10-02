<?php
if(!isset($_POST['submit']))
{
	//This page should not be accessed directly. Need to submit the form.
	echo "error; you need to submit the form!";
}
$name = $_POST['name'];
$rating = $_POST['rating'];
$message = $_POST['message'];


//Validate first
if(empty($name))
{
    echo "Please enter a name";
    exit;
}
    
//if(empty($message))
//    {
//        echo "You haven't left any comments!";
 //       exit;
 //   }

$email_date=''.date('m-d-Y_hia').'';
$email_from = 'huw.wells@icloud.com';
$email_subject = "New Form submission";
$email_body = "You have received a new review from the user $name.\n\n".
    "Date: $email_date\n\nRating: $rating\n\nReview: $message\n\n".
    
$to = "huw.wells@icloud.com";
$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $visitor_email \r\n";
//Send the email!
mail($to,$email_subject,$email_body,$headers);
//done. redirect to thank-you page.
header('Location: thank-you.html');

$fname='review_'.date('m-d-Y_hia').'.txt';
file_put_contents($fname,$email_body);


// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
   
?> 