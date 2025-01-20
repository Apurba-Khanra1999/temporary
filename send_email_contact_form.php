<?php
// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
header('Content-Type: text/plain; charset=utf-8'); // Ensure response is plain text


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $feedback = htmlspecialchars($_POST['feedback']);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    // Create an instance of PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'apurbakhanra09@gmail.com'; // Your Gmail address
        $mail->Password = 'fhoe xeve ajpz brgf';   // Your Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Set the sender (user's email from the form)
        $mail->setFrom($email, $first_name);

        // Recipient email (your email to receive the form data)
        $mail->addAddress('apurbakhanra09@gmail.com'); // Replace with client mail id email

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Temporary. Webapp- Feedback Form';
        $mail->Body    = "You have received a new message:<br><br>
                          <b>Full Name : </b> $name<br>
                          <b>Email ID : </b> $email<br>
                          <b>Valuable Feedback : </b> $feedback<br>
                          ";

        // Send the email
        $mail->send();
        echo 'ok';
    } catch (Exception $e) {
        echo "error {$mail->ErrorInfo}";
    }
}
else {
    echo "error";
}
?>
