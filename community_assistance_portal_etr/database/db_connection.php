<?php
$host = 'localhost'; 
$dbname = 'community_portal'; 
$username = 'root'; 
$password = ''; 

try {
    $conn = new mysqli($host, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
} catch (Exception $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}
?>