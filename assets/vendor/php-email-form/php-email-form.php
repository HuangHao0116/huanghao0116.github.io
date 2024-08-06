<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];

  $to = "hhuang95-c@my.cityu.edu.hk"; // 目标邮箱
  $subject = "Contact Form Submission from $name";
  $headers = "From: $email";

  $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";

  if (mail($to, $subject, $body, $headers)) {
    echo "Your message has been sent. Thank you!";
  } else {
    echo "There was an error sending your message. Please try again later.";
  }
} else {
  echo "Invalid request method.";
}

?>