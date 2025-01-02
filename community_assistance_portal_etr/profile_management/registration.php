<?php
include '../database/db_connection.php'; // Update with your database name


// Initialize variables to store form input data
$fullname = $username = $password = $confirm_password = $age = $sex = $address = '';
$errors = [];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate form data
    $fullname = trim($_POST['fullname']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $age = (int)$_POST['age'];
    $sex = $_POST['sex'];
    $address = trim($_POST['address']);

    // Basic validation
    if (empty($fullname) || empty($username) || empty($password) || empty($confirm_password) || empty($age) || empty($sex) || empty($address)) {
        $errors[] = "All fields are required.";
    }

    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    if (!filter_var($age, FILTER_VALIDATE_INT) || $age < 18) {
        $errors[] = "Please enter a valid age (18 or older).";
    }

    // Check if username already exists
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $errors[] = "Username is already taken.";
    }

    // If there are no errors, insert the user into the database
    if (empty($errors)) {
        $insert_query = "INSERT INTO users (fullname, username, password, age, sex, address) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("ssssss", $fullname, $username, $password, $age, $sex, $address);

        if ($stmt->execute()) {
            echo "<script>alert('Registration successful!'); window.location.href='login.php';</script>";
        } else {
            $errors[] = "An error occurred. Please try again.";
        }
    }

    $stmt->close();
}
// Close the database connection
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .bg-overlay {
            background: url('assets/bgimg.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: -1;
            opacity: 0.6;
        }

        .container {
            position: relative;
            z-index: 1;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 12px;
        }
    </style>
</head>

<body>
    <!-- Background Overlay -->
    <div class="bg-overlay"></div>

    <!-- Registration Form Section -->
    <section class="py-5">
        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="card shadow-lg p-4" style="max-width: 600px; width: 100%; border-radius: 12px;">
                <!-- Logo -->
                <div class="text-center mb-4">
                    <img src="assets/sblogo.jpg" alt="Logo" width="80" height="80">
                </div>

                <h3 class="text-center mb-4">Create an Account</h3>
                <form action="" method="POST">
                    <!-- Full Name and Email -->
                    <div class="row mb-3">
                        <div class="col-12 col-md-6">
                            <label for="fullname" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter your full name" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Choose a username" required>
                        </div>
                    </div>
                    <!-- Password and Confirm Password -->
                    <div class="row mb-3">
                        <div class="col-12 col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter a password" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>
                        </div>
                    </div>
                    <!-- Age, Sex, and Address -->
                    <div class="row mb-3">
                        <div class="col-12 col-md-4">
                            <label for="age" class="form-label">Age</label>
                            <input type="number" class="form-control" id="age" name="age" placeholder="Enter your age" required>
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label">Sex</label>
                            <div class="d-flex">
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" id="male" name="sex" value="Male" required>
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="female" name="sex" value="Female" required>
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter your address" required>
                        </div>
                    </div>
                    <!-- Submit -->
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-success w-100">Sign Up</button>
                    </div>
                </form>
                <!-- Login Link -->
                <div class="text-center mt-3">
                    <small>Already have an account? <a href="login.php" class="text-decoration-none">Log in</a></small>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
