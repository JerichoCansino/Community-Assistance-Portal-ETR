<?php
require 'database/db_connection.php';

$query = "SELECT f.name, f.rating, f.feedback, f.submitted_on, u.username
          FROM feedbacks f
          JOIN users u ON f.user_id = u.id
          ORDER BY f.submitted_on DESC";

$result = $conn->query($query);
$feedbacks = [];

while ($row = $result->fetch_assoc()) {
    $feedbacks[] = $row;
}

echo json_encode($feedbacks);

?>

