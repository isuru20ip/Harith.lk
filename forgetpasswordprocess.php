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
        $mail->Username = 'your email here';
        $mail->Password = 'app password here';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('email here ', 'any title');
        $mail->addReplyTo('email here', 'any title');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'any text';
        $bodyContent = 'content';
        $mail->Body    = $bodyContent;

        if (!$mail->send()) {
            echo ("sending faile");
        } else {
            echo ("sending sucsess");
            
        }
    } else {
        echo ("Invalid user email");
    }
}
