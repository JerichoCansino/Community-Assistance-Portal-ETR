<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    die(json_encode(['status' => 'error', 'message' => 'User not logged in']));
}

require 'database/db_connection.php';

$user_id = $_SESSION['user_id'];
$name = $_POST['name'] ?? null;
$email = $_POST['email'] ?? null;
$rating = intval($_POST['rating']);
$feedback = $_POST['feedback'];

if ($rating < 1 || $rating > 5 || empty($feedback)) {
    die(json_encode(['status' => 'error', 'message' => 'Invalid input']));
}

$query = $conn->prepare("INSERT INTO feedbacks (user_id, name, email, rating, feedback) VALUES (?, ?, ?, ?, ?)");
$query->bind_param("issis", $user_id, $name, $email, $rating, $feedback);

if ($query->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Feedback submitted successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error submitting feedback']);
}
?>
