<?php 
if(isset($_POST['inputEmail'])) {
  $email_to = "jnp8@kent.ac.uk";
  $email_subject = "Message from Jodie Perry";

  function died($error) {
      echo "We are very sorry, but there were error(s) found with the form you submitted. ";
      echo "These errors appear below.<br /><br />";
      echo $error."<br /><br />";
      echo "Please go back and fix these errors.<br /><br />";
      die();
  }

  // ensures data exists
  if(!isset($_POST['name']) ||
      !isset($_POST['inputEmail']) ||
      !isset($_POST['textArea'])) {
      died('We are sorry, but there appears to be a problem with the form you submitted.');       
  }

  $name = $_POST['name'];
  $email_from = $_POST['inputEmail']; 
  $comments = $_POST['textArea']; 
  $error_message = "";
  $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br/>';
  }

  $string_exp = "/^[A-Za-z .'-]+$/";

  if(!preg_match($string_exp,$name)) {
    $error_message .= 'The First Name you entered does not appear to be valid.<br/>';
  }

  if(strlen($comments) < 2) {
    $error_message .= 'The Comments you entered do not appear to be valid.<br />';
  }

  if(strlen($error_message) > 0) {
    died($error_message);
  }

  $email_message = "Form details below.\n\n";

  function clean_string($string) {
    $bad = array("content-type","bcc:","to:","cc:","href");
    return str_replace($bad,"",$string);
  }

  $email_message .= "Name: ".clean_string($name)."\n";
  $email_message .= "Email: ".clean_string($email_from)."\n";
  $email_message .= "Message: ".clean_string($comments)."\n";

  $headers = 'From: '.$email_from."\r\n".'Reply-To: '.$email_from."\r\n" .'X-Mailer: PHP/' . phpversion();
  mail($email_to, $email_subject, $email_message, $headers);  
  ?>
<html>
<head>
  <meta HTTP-EQUIV="REFRESH" content="5; url=http://raptor.kent.ac.uk/~jnp8/Testing/contact.html">
</head>

  <!-- include your own success html here -->



  <p align="center">Thank you for contacting me. I will be in touch with you very soon. You will redirect shortly</p>


</html>
  <?php

}

?>