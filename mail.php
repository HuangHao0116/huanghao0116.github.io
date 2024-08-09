<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';
  $name =$_POST['name'];
  $email =$_POST['email'];
  $subject =$_POST['subject'];
  $message =$_POST['message'];

  $mailheader = "From:".$name."<".$email.">\r\n";
//邮箱服务器 账号
 $email_fa = "312050347@qq.com";
//邮箱服务器 授权码
$email_fa_mm = "mmlszzvcogaibiba";
//收邮箱地址
  $recipient = "hhuang95-c@my.cityu.edu.hk";
try {

// 创建PHPMailer实例
    $mail = new PHPMailer(true); // 异常捕获模式

// SMTP服务器设置，默认为QQ邮箱
    $mail->isSMTP(); // 使用SMTP
    $mail->Host = 'smtp.qq.com'; // SMTP服务器地址
    $mail->SMTPAuth = true; // 启用SMTP身份验证
    $mail->Username = $email_fa; // 发送方邮箱地址
    $mail->Password = $email_fa_mm; // 发送方邮箱密码
    $mail->SMTPSecure = 'ssl'; // 启用SSL加密
    $mail->Port = 465; // SMTP服务器端口号
// 设置发件人和收件人
    $mail->setFrom($email_fa); // 发件人邮箱地址
    $mail->addAddress($recipient); // 收件人邮箱地址
// 邮件主题和正文
    $mail->Subject = $subject;

// 创建HTML邮件内容
    $htmlContent =$message;
    $mail->isHTML(true); // 将邮件内容设置为HTML格式
    $mail->Body =$mailheader. $htmlContent;
// 发送邮件
    $a = $mail->send();
// 注意这里修正了变量名，使用了 $mailheader 而不是$mailheaders
    echo "Message sent";
}catch (Exception $e){
    echo '留意失败,请重试！' . $mail->ErrorInfo;
}



?>