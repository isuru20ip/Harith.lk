<?php

require "conection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

$email = $_POST["email"];
$tile = $_POST["title"];
$msg = $_POST["msg"];
// $id = $_POST["id"];



$user = Database::search("SELECT * FROM `user` WHERE `email` = '" . $email . "';");
$user_count = $user->num_rows;

if ($user_count == 1) {

    $code = uniqid();
    Database::iud("UPDATE `user` SET `verification_code`='" . $code . "' WHERE `email` = '" . $email . "' ");

    $mail = new PHPMailer;
    $mail->IsSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'all.test.free.mail@gmail.com';
    $mail->Password = 'gjhl mkyt hwca uotg';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('all.test.free.mail@gmail.com', 'Ayuna.lk');
    $mail->addReplyTo('all.test.free.mail@gmail.com', 'Reset Password');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = $tile;
    $bodyContent = '<h1 style="color:black;">' . $msg . '</h1>';
    $mail->Body    = $bodyContent;

    if (!$mail->send()) {
        echo ("Email Sending Faild");
    } else {
        echo ("Good");
    }
} else {
    echo ("Invalid user email");
}
