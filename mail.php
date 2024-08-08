<?php

  $name =$_POST['name'];
  $email =$_POST['email'];
  $subject =$_POST['subject'];
  $message =$_POST['message'];

  $mailheader = "From:".$name."<".$email.">\r\n";

  $recipient = "hhuang95-c@my.cityu.edu.hk";

// 注意这里修正了变量名，使用了 $mailheader 而不是$mailheaders
  mail($recipient,$subject, $message,$mailheader) 
  or die("Error sending email!");

  echo "Message sent"; // 这里应该是 "Message sent"，为了保持语句的准确性

?>