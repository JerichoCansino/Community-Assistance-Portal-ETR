<?php
include('database/db_connection.php');

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['eventTitle']);
    $date = $_POST['eventDate'];
    $time = $_POST['eventTime'];
    $location = trim($_POST['eventLocation']);
    $description = trim($_POST['eventDescription']);


    // Validate required fields
    if (!empty($title) && !empty($date) && !empty($time) && !empty($location) && !empty($description)) {
        // Insert the event into the database
        $stmt = $conn->prepare("INSERT INTO events (title, date, time, location, description) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $title, $date, $time, $location, $description);

        if ($stmt->execute()) {
            // Redirect back to the previous page with a success message
            header("Location: " . $_SERVER['HTTP_REFERER'] . "?success=1");
            exit();
        } else {
            // Redirect back to the previous page with an error message
            header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=" . urlencode("Error: " . $stmt->error));
            exit();
        }
        $stmt->close();
    } else {
        $error_message = "Please fill out all required fields.";
    }
}else {
    // Redirect back to the previous page with an error message
    header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=" . urlencode("Please fill out all required fields."));
    exit();
}

$conn->close();
?>
