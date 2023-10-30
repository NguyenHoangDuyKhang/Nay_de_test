<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';
function guimail($email, $tieude, $noidung){
    $mail = new PHPMailer(true);
    $mail-> CharSet = "utf-8";
try {
    $mail->SMTPDebug = 0;
    $mail->isSMTP();

    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure ='ssl';
    $mail->Port = 465;
    $mail->Username = 'khang12a3lqd@gmail.com';
    $mail->Password = 'tzsiqwgipdydxmnt';

    //Recipients
    $mail->setFrom('khang12a3lqd@gmail.com', 'admin');     //Add a recipient
    $mail->addAddress($email);               //Name is optional
    $mail->addReplyTo('khang12a3lqd@gmail.com', 'Information');

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $tieude;
    $mail->Body    = $noidung;
    $mail->AltBody = $noidung;
    $mail->send();
    header('location: thongbaothanhcong.php' );
} catch (Exception $e) {
    echo "Mail không gửi được. Lỗi gửi mail; {$mail->ErrorInfo}";
}
}

function guimail_admin($noidung){
    $mail = new PHPMailer(true);
    $mail-> CharSet = "utf-8";
try {
    $mail->SMTPDebug = 0;
    $mail->isSMTP();

    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure ='ssl';
    $mail->Port = 465;
    $mail->Username = 'khangnhdpc05817@fpt.edu.vn';
    $mail->Password = 'lceuwoqtrqsjcmzg';

    //Recipients
    $mail->setFrom('khangnhdpc05817@fpt.edu.vn', 'admin');     //Add a recipient
    $mail->addAddress('khangnhdpc05817@fpt.edu.vn');               //Name is optional
    $mail->addReplyTo('khangnhdpc05817@fpt.edu.vn', 'Information');

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = "Thông tin đơn hàng từ khách hàng";
    $mail->Body    = $noidung;
    $mail->AltBody = $noidung;
    $mail->send();
    header('location: thongbaothanhcong.php' );
} catch (Exception $e) {
    echo "Mail không gửi được. Lỗi gửi mail; {$mail->ErrorInfo}";
}
}

?>