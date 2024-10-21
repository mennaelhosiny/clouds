<?php
$conn = new mysqli("localhost", "u706526857_menna", "Mennnnna12345#", "u706526857_survey");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

header("Access-Control-Allow-Origin: *");
header("Content-Type: text/html; charset=UTF-8");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);
    
    $to = "mennaelhosiny3@gmail.com";

    $sql = "INSERT INTO platinum (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        $subject = "New Form Submission Notification";
        $message = "A new record has been added to your database.\n\n" .
                   "Name: $name\n" .
                   "Email: $email\n" .
                   "Message: $message";

        $headers = "From: noreply@yourwebsite.com\r\n" .
                   "Reply-To: noreply@yourwebsite.com\r\n" .
                   "X-Mailer: PHP/" . phpversion();

        if (mail($to, $subject, $message, $headers)) {
            $status_message = "Record added and email sent!";
        } else {
            $status_message = "Record added but failed to send email.";
        }
    } else {
        $status_message = "Error: " . $conn->error;
    }
    
    $conn->close();
} else {
    $status_message = "";
}
?>

