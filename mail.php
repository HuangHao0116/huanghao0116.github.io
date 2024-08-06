<?php

  $name = $_POST['name'];
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];

  $mailheader = "From:".$name."<".$email.">\r\n";
  
  $recipient = "hhuang95-c@my.cityu.edu.hk";

  mail($recipient, $subject, $message, $mailheaders)
  or die("Error!");
  

  echo "message send";

?>