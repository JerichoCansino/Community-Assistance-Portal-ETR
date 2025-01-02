<?php
session_start(); // Start the session

// Include database connection
include '../database/db_connection.php'; // Adjust this to your actual database connection file

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted username and password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL query to fetch user from database
    $query = "SELECT id, username, password, role FROM users WHERE username = ?";
    
    if ($stmt = $conn->prepare($query)) {
        // Bind parameters to the SQL query
        $stmt->bind_param("s", $username);
        
        // Execute the query
        $stmt->execute();
        
        // Store the result
        $stmt->store_result();
        
        // Check if username exists in the database
        if ($stmt->num_rows > 0) {
            // Bind result variables
            $stmt->bind_result($user_id, $db_username, $db_password, $role);
            $stmt->fetch();
            
            // Verify password
            if ($password) {
                // Password is correct, set session variables
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $db_username;
                $_SESSION['role'] = $role;
                
                // Redirect based on user role
                if ($role == 'admin') {
                    header("Location: ../profile_management/admin_management/admin_dashboard.php"); // Redirect to admin dashboard
                } elseif ($role == 'staff') {
                    header("Location: staff_dashboard.php"); // Redirect to staff dashboard
                } else {
                    header("Location: ../index.php"); // Redirect to user dashboard
                }
                exit();
            } else {
                // Invalid password
                $error_message = "Incorrect password.";
            }
        } else {
            // Username not found
            $error_message = "No user found with that username.";
        }
        
        // Close the statement
        $stmt->close();
    } else {
        $error_message = "Database query failed.";
    }
    
    // Close the database connection
    $conn->close();
}
?>

<!-- HTML Code for the login form (same as provided earlier) -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .bg-overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: url('assets/bgimg.jpg') no-repeat center center; background-size: cover; opacity: 0.6; z-index: -1; }
        .login-container { height: 100vh; display: flex; justify-content: center; align-items: center; }
        .card { width: 100%; max-width: 500px; border-radius: 12px; background-color: rgba(255, 255, 255, 0.8); box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); }
        .form-control { border-radius: 8px; box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.12); }
        .btn { border-radius: 8px; font-weight: 600; }
        h3 { font-weight: 600; color: #333; }
        .text-center img { width: 80px; height: 80px; }
    </style>
</head>
<body>
    <div class="bg-overlay"></div>
    <section class="py-5 login-container">
        <div class="container d-flex justify-content-center align-items-center">
            <div class="card shadow p-4">
                <div class="text-center mb-4">
                    <img src="assets/sblogo.jpg" alt="Logo">
                </div>

                <h3 class="text-center mb-4">Login</h3>
                <?php if (!empty($error_message)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $error_message; ?>
                    </div>
                <?php endif; ?>
                <form action="login.php" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="rememberMe" name="remember">
                            <label class="form-check-label" for="rememberMe">Remember me</label>
                        </div>
                        <a href="#" class="text-decoration-none">Forgot password?</a>
                    </div>
                    <button type="submit" class="btn btn-success w-100 mt-4">Login</button>
                </form>
                <div class="text-center mt-3">
                    <small>Don't have an account? <a href="registration.php" class="text-decoration-none">Sign up</a></small>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
