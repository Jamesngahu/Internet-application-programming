
<?php

require_once 'Classautoload.php';
require_once 'db.php';
require_once 'PHPMailer/Mail.php'; 

$success = "";
$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? "");
    $email = trim($_POST['email'] ?? "");
    if ($username && $email) {
        $stmt = $conn->prepare("INSERT INTO users (username, email) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $email);
        if ($stmt->execute()) {
            $success = "User registered successfully.";
            // Send email
            $mail->clearAddresses();
            $mail->addAddress($email, $username);
            $mail->Subject = 'Welcome!';
            $mail->Body = 'Hello ' . htmlspecialchars($username) . ',<br>Thank you for registering!';
            $mail->AltBody = 'Hello ' . $username . ', Thank you for registering!';
            try {
                $mail->send();
            } catch (Exception $e) {
                           $error = "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            $error = "Failed to register user.";
        }
        $stmt->close();
    } else {
        $error = "All fields are required.";
    }
}

if ($success) echo "<p style='color:green;'>$success</p>";
if ($error) echo "<p style='color:red;'>$error</p>";
echo '<hr><a href="users.php">View Users List</a>';if ($success) echo "<p style='color:green;'>$success</p>";
if ($error) echo "<p style='color:red;'>$error</p>";
echo '<hr><a href="users.php">View Users List</a>';

$layout->header($conf);
print $hello->today();
$form->signup();
$layout->footer($conf);



