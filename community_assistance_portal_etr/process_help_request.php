<?php
session_start();
include('database/db_connection.php');

if (!isset($_SESSION['user_id'])) {
    $_SESSION['message'] = "You must be logged in to submit a request.";
    header('Location: profile_management/login.php'); 
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['requestName']);
    $contact = mysqli_real_escape_string($conn, $_POST['requestContact']);
    $details = mysqli_real_escape_string($conn, $_POST['requestDetails']);
    $userid = $_SESSION['user_id']; 

    $sql = "INSERT INTO offers (type, name, contact, details, userid) VALUES ('request', '$name', '$contact', '$details', '$userid')";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = "Request submitted successfully!";
    } else {
        $_SESSION['message'] = "Error: " . mysqli_error($conn);
    }
    header('Location: help_request_offers.php');
}
?>
