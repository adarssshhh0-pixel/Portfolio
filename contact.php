<?php
// 1. Database config
$host = "localhost";       // stays localhost
$user = "root";            // default XAMPP user
$pass = "";                // default XAMPP password is empty
$db   = "portfolio_db";    // name of your database

// 2. Connect to database
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 3. Handle form submit
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name    = trim($_POST["name"] ?? "");
    $email   = trim($_POST["email"] ?? "");
    $subject = trim($_POST["subject"] ?? "");
    $message = trim($_POST["message"] ?? "");

    if ($name === "" || $email === "" || $subject === "" || $message === "") {
        die("Please fill all fields.");
    }

    $stmt = $conn->prepare(
        "INSERT INTO contact_messages (name, email, subject, message)
         VALUES (?, ?, ?, ?)"
    );

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    if ($stmt->execute()) {
        echo "<h2 style='font-family: sans-serif; color: #00c0ff;'>
                Thank you, your message has been sent!
              </h2>";
        echo "<p style='font-family: sans-serif;'>
                <a href='index.html'>Go back to portfolio</a>
              </p>";
    } else {
        echo 'Error: ' . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
