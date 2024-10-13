<?php
// Database connection
$conn = new mysqli("localhost", "u706526857_menna", "Mennnnna12345#", "u706526857_survey");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Allow CORS if needed
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/html; charset=UTF-8");

// Check if the request is for form submission (MySQL insertion)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name'])) {
    // Sanitize and store form data
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);
    
    // Set the recipient email address
    $to = "mennaelhosiny3@gmail.com";

    // Prepare and execute the insert statement
    $sql = "INSERT INTO platinum (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        // Email notification setup
        $subject = "New Form Submission Notification";
        $message = "A new record has been added to your database.\n\n" .
                   "Name: $name\n" .
                   "Email: $email\n" .
                   "Message: $message";

        // Email headers
        $headers = "From: noreply@yourwebsite.com\r\n" .
                   "Reply-To: noreply@yourwebsite.com\r\n" .
                   "X-Mailer: PHP/" . phpversion();

        // Try sending the email
        if (mail($to, $subject, $message, $headers)) {
            $status_message = "Record added and email sent!";
        } else {
            $status_message = "Record added but failed to send email.";
        }
    } else {
        // Error with database insertion
        $status_message = "Error: " . $conn->error;
    }
    
    // Close the database connection
    $conn->close();
} else {
    // No form submission yet
    $status_message = "";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        /* Add your styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        
        .contactUs {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 50px;
        }

        .contact-container {
            display: flex;
            width: 100%;
            max-width: 1000px;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .form-container, .illustration-container {
            padding: 20px;
            flex: 1;
        }

        .form-container {
            background: #f9f9f9;
        }

        .form-container h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .contact-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .input-container {
            position: relative;
        }

        .input-container i {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #888;
        }

        .input-container input, .input-container textarea {
            width: 100%;
            padding: 10px 15px 10px 40px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            outline: none;
        }

        .input-container textarea {
            resize: vertical;
            height: 100px;
        }

        .send-button {
            padding: 15px;
            border: none;
            border-radius: 5px;
            background-color: #007BFF;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .send-button:hover {
            background-color: #0056b3;
        }

        .illustration-container img {
            width: 100%;
            object-fit: contain;
        }

        .status-message {
            text-align: center;
            font-size: 16px;
            margin-top: 20px;
            color: green;
        }

        .status-message.error {
            color: red;
        }
    </style>
</head>
<body>

    <!-- header -->
    <header>
        <a href="index.html" class="brand">Anime</a>
        <div class="menu-btn"></div>
        <div class="navigation">
            <div class="navigation-items">
                <a href="contact.html">Contact</a>
                <a href="#">Explore</a>
                <a href="#">About</a>
                <a href="#">Home</a>
            </div>
        </div>
    </header>

    <!-- contactUs -->
    <section class="contactUs">
        <div class="contact-container">
            <div class="form-container">
                <h2>Contact us</h2>
                <form action="" method="POST" class="contact-form">
                    <div class="input-container">
                        <i class="fas fa-user"></i>
                        <input type="text" name="name" placeholder="Name" required>
                    </div>
                    <div class="input-container">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="input-container">
                        <i class="fas fa-comment"></i>
                        <textarea name="message" placeholder="Message" required></textarea>
                    </div>
                    <button type="submit" class="send-button">Send Message</button>
                </form>
                <?php if (!empty($status_message)): ?>
                    <div class="status-message <?php echo strpos($status_message, 'Error') !== false ? 'error' : ''; ?>">
                        <?php echo htmlspecialchars($status_message); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="illustration-container">
                <img src="https://via.placeholder.com/300x300?text=Illustration" alt="Contact Illustration">
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>