<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'mailer/Exception.php';
require 'mailer/PHPMailer.php';
require 'mailer/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullName = $_POST['fullName'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';

    $package = $_POST['package'] ?? '';
    $departureDate = $_POST['departureDate'] ?? '';
    $returnDate = $_POST['returnDate'] ?? '';
    $adults = $_POST['adults'] ?? '';
    $children = $_POST['children'] ?? '';

    $accommodation = $_POST['accommodation'] ?? '';
    $transportation = isset($_POST['transportation']) ? (is_array($_POST['transportation']) ? implode(', ', $_POST['transportation']) : $_POST['transportation']) : '';
    $specialRequests = $_POST['specialRequests'] ?? '';

    $mail = new PHPMailer(true);

    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'patrasagarika654@gmail.com'; // Your Gmail
        $mail->Password   = 'jshf iluj zotb yatn';         // App password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Sender & recipient
        $mail->setFrom('patrasagarika654@gmail.com', 'Booking Form');
        $mail->addAddress('patrasagarika654@gmail.com');

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'New Travel Booking Form Submission';
        $mail->Body    = "
            <h2>New Booking Request</h2>
            <h3>Personal Information:</h3>
            <p><strong>Full Name:</strong> {$fullName}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Phone:</strong> {$phone}</p>
            <p><strong>Address:</strong> {$address}</p>
            
            <h3>Travel Details:</h3>
            <p><strong>Package Type:</strong> {$package}</p>
            <p><strong>Departure Date:</strong> {$departureDate}</p>
            <p><strong>Return Date:</strong> {$returnDate}</p>
            <p><strong>Adults:</strong> {$adults}</p>
            <p><strong>Children:</strong> {$children}</p>
            
            <h3>Additional Preferences:</h3>
            <p><strong>Accommodation:</strong> {$accommodation}</p>
            <p><strong>Transportation:</strong> {$transportation}</p>
            <p><strong>Special Requests:</strong> {$specialRequests}</p>
        ";

        $mail->send();
        header('Location: thankyou.html'); // Redirect on success
        exit();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request.";
}
?>
