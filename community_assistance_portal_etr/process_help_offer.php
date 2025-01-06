<?php
session_start();
include('db_connection.php'); // Include your DB connection here

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    $_SESSION['message'] = "You must be logged in to submit an offer.";
    header('Location: profile_management/login.php'); // Redirect to login page if not logged in
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['offerName']);
    $contact = mysqli_real_escape_string($conn, $_POST['offerContact']);
    $details = mysqli_real_escape_string($conn, $_POST['offerDetails']);
    $userid = $_SESSION['user_id']; // Get the user ID from the session

    // Insert the offer into the database
    $sql = "INSERT INTO offers (type, name, contact, details, userid) VALUES ('offer', '$name', '$contact', '$details', '$userid')";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = "Offer submitted successfully!";
    } else {
        $_SESSION['message'] = "Error: " . mysqli_error($conn);
    }
    header('Location: help_request_offers.php');
}
?>
