<?php

class PHP_Email_Form {
  public $to = '';
  public $from_name = '';
  public $from_email = '';
  public $subject = '';
  public $smtp = array();
  public $messages = array();
  public $attachments = array();
  public $ajax = false;
  public $honeypot = '';
  public $recaptcha_secret_key = '';

  public function add_message($content, $label = '', $order = 0) {
    $this->messages[] = array('content' => $content, 'label' => $label, 'order' => $order);
  }

  public function add_attachment($field_name, $max_size, $allowed_types) {
    if (isset($_FILES[$field_name]) && $_FILES[$field_name]['error'] == UPLOAD_ERR_OK) {
      $file = $_FILES[$field_name];
      $file_size = $file['size'] / 1024 / 1024; // size in MB
      $file_ext = pathinfo($file['name'], PATHINFO_EXTENSION);

      if ($file_size <= $max_size && in_array($file_ext, $allowed_types)) {
        $this->attachments[] = $file;
      } else {
        die('File upload error: Invalid file type or size.');
      }
    }
  }

  public function send() {
    if ($this->honeypot) {
      return false;
    }

    if (!empty($this->recaptcha_secret_key)) {
      $recaptcha_response = $_POST['g-recaptcha-response'];
      $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $this->recaptcha_secret_key . "&response=" . $recaptcha_response);
      $response_keys = json_decode($response, true);
      if (intval($response_keys["success"]) !== 1) {
        return false;
      }
    }

    $headers = "From: " . $this->from_name . " <" . $this->from_email . ">\r\n";
    $headers .= "Reply-To: " . $this->from_email . "\r\n";

    $subject = $this->subject;

    $message = '';
    foreach ($this->messages as $msg) {
      $message .= $msg['label'] . ": " . $msg['content'] . "\n";
    }

    if (!empty($this->smtp)) {
      return $this->send_smtp($subject, $message, $headers);
    } else {
      return mail($this->to, $subject, $message, $headers);
    }
  }

  private function send_smtp($subject, $message, $headers) {
    // SMTP sending logic here
    // This is a placeholder for actual SMTP implementation
    // You may use libraries like PHPMailer or SwiftMailer
    return false;
  }
}

?>