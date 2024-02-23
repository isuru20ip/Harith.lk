<?php

require "conection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

$email = $_GET["e"];

if (empty($email)) {
    echo ("Please enter your email");
} elseif (strlen($email) > 100) {
    echo ("email must have less than 100 Charactres.");
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("invalid email");
} else {

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
        $mail->Subject = 'Forgot Password Verification Code';
        $bodyContent = '<h1 style="color:green;">Your verification code is ' . $code . '</h1>';
        $mail->Body    = $bodyContent;

        if (!$mail->send()) {
            echo ("Verification Code Sending Failed.");
        } else {
            echo ("Good");
            
        }
    } else {
        echo ("Invalid user email");
    }
}
