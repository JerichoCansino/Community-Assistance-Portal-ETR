<?php
// Include database connection
include('../database/db_connection.php');

// Initialize error message variable
$error_message = "";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data and trim to remove any extra spaces
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // SQL query to fetch user from database
    $query = "SELECT id, username, password, role, fullname, profile_picture FROM users WHERE username = ?";

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
            $stmt->bind_result($user_id, $db_username, $db_password, $role, $fullname, $profile_picture);
            $stmt->fetch();

            // Compare plain text password with stored password
            if ($password === $db_password) {
                // Password is correct, set session variables
                session_start();
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $db_username;
                $_SESSION['fullname'] = $fullname;
                $_SESSION['role'] = $role;
                $_SESSION['profile_picture'] = $profile_picture ? $profile_picture : 'default.jpg'; // Set default if no picture

                // Redirect based on user role
                if ($role == 'admin') {
                    header("Location: ../profile_management/admin_management/admin_dashboard.php");
                } elseif ($role == 'staff') {
                    header("Location: staff_dashboard.php");
                } else {
                    header("Location: ../index.php");
                }
                exit();
            } else {
                // Invalid password
                $error_message = "Invalid login credentials.";
            }
        } else {
            // Username not found
            $error_message = "Invalid login credentials.";
        }

        // Close the statement
        $stmt->close();
    }
}
?>

<!-- HTML Code for the login form using Bootstrap -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <div class="bg-overlay position-absolute top-0 start-0 w-100 h-100" style="background: url('assets/bgimg.jpg') no-repeat center center; background-size: cover; opacity: 0.6; z-index: -1;"></div>

    <section class="py-5 d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card shadow-lg p-4" style="width: 100%; max-width: 500px; border-radius: 12px; background-color: rgba(255, 255, 255, 0.8);">
            <div class="text-center mb-4">
                <img src="assets/sblogo.jpg" alt="Logo" width="80" height="80">
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
                        <label class="form-check-label text-success" for="rememberMe">Remember me</label>
                    </div>
                    <a href="#" class="text-decoration-none text-success">Forgot password?</a>
                </div>
                <button type="submit" class="btn btn-success w-100 mt-4">Login</button>
            </form>
            <div class="text-center mt-3">
                <small>Don't have an account? <a href="registration.php" class="text-decoration-none text-success">Sign up</a></small>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>