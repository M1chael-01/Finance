<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../../vendor/PHPMailer/src/Exception.php';
require_once '../../vendor/PHPMailer/src/PHPMailer.php';
require_once '../../vendor/PHPMailer/src/SMTP.php';

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['fName'], $data['lName'], $data['email'], $data['message'])) {
    echo json_encode(['status' => 'error', 'message' => 'Missing required fields.']);
    exit;
}

$fName   = htmlspecialchars(trim($data['fName']));
$lName   = htmlspecialchars(trim($data['lName']));
$email   = htmlspecialchars(trim($data['email']));
$message = htmlspecialchars(trim($data['message']));

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'tvrdikmichael@gmail.com'; // Move to ENV in production
    $mail->Password   = 'cual kyxg rbca meuc';      // Move to ENV in production
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;
    $mail->CharSet    = 'UTF-8';

    $mail->setFrom('tvrdikmichael@gmail.com', 'Cloudflow Bank');
    $mail->addAddress($email);
    $mail->addReplyTo($email, "$fName $lName");

    $mail->isHTML(true);
    $mail->Subject = 'Rodinné finance – Váš dotaz';

    $mail->Body = "
    <html>
    <head>
        <style>
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background-color: #f4f6f9;
                margin: 0;
                padding: 0;
            }
            .email-wrapper {
                max-width: 650px;
                margin: 0 auto;
                background-color: #ffffff;
                border-radius: 10px;
                overflow: hidden;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            }
            .email-header {
                background-color: #003366;
                color: #ffffff;
                padding: 30px 20px;
                text-align: center;
            }
            .email-header h1 {
                margin: 0;
                font-size: 24px;
                letter-spacing: 1px;
            }
            .email-body {
                padding: 30px 20px;
                color: #333333;
                font-size: 16px;
                line-height: 1.6;
            }
            .email-body p {
                margin-bottom: 15px;
            }
            .email-footer {
                text-align: center;
                background-color: #f0f2f5;
                color: #666666;
                font-size: 12px;
                padding: 15px;
            }
            .divider {
                border-top: 1px solid #e0e0e0;
                margin: 20px 0;
            }
        </style>
    </head>
    <body>
        <div class='email-wrapper'>
            <div class='email-header'>
                <h1>Rodinné finance</h1>
                <p>Váš dotaz byl přijat</p>
            </div>
            <div class='email-body'>
                <p><strong>Jméno:</strong> {$fName}</p>
                <p><strong>Příjmení:</strong> {$lName}</p>
                <p><strong>Zpráva:</strong><br>" . nl2br($message) . "</p>

                <div class='divider'></div>

                <p>Dobrý den,</p>
                <p>Vaše zpráva byla úspěšně přijata. Děkujeme, že jste nás kontaktovali. Naši specialisté se vám ozvou co nejdříve.</p>
                <p>S úctou,<br><strong>Vaše finance</strong></p>
            </div>
            <div class='email-footer'>
                &copy; " . date("Y") . " Rodinné finance. Všechna práva vyhrazena.
            </div>
        </div>
    </body>
    </html>
    ";

    $mail->send();
    echo json_encode(['status' => 'success', 'message' => 'Email was sent successfully.']);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Mailer Error: ' . $mail->ErrorInfo]);
}
