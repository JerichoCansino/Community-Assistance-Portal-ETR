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

    // Handle profile picture upload
    $profile_picture = 'default.jpg';  // Default profile picture
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $profile_picture = uniqid() . '_' . $_FILES['profile_picture']['name']; // Unique file name
        $target_dir = "../uploads/"; // Corrected path to the 'uploads' folder at the root
        $target_file = $target_dir . basename($profile_picture);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is an actual image
        $check = getimagesize($_FILES['profile_picture']['tmp_name']);
        if ($check === false) {
            $errors[] = "File is not an image.";
        }

        // Allow certain file formats
        if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
            $errors[] = "Only JPG, JPEG, PNG, and GIF files are allowed.";
        }

        // Check file size (max 5MB)
        if ($_FILES['profile_picture']['size'] > 5000000) {
            $errors[] = "Sorry, your file is too large. Maximum size is 5MB.";
        }

        // Try to upload the file if there are no errors
        if (empty($errors) && move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file)) {
            // File uploaded successfully
        } else {
            $errors[] = "Sorry, there was an error uploading your file.";
        }
    }

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
        // No password hashing, storing plain password
        $insert_query = "INSERT INTO users (fullname, username, password, age, sex, address, profile_picture) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("sssssss", $fullname, $username, $password, $age, $sex, $address, $profile_picture);

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
        .btn-green {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-green:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .form-check-input:checked {
            background-color: #28a745;
            border-color: #28a745;
        }

        a {
            color: #28a745;
        }

        a:hover {
            color: #218838;
        }
    </style>
</head>

<body>
    <!-- Background Overlay -->
    <div class="bg-overlay" style="background: url('assets/bgimg.jpg') no-repeat center center fixed; background-size: cover; height: 100vh; position: fixed; top: 0; left: 0; width: 100%; z-index: -1; opacity: 0.6;"></div>

    <!-- Registration Form Section -->
    <section class="py-5">
        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="card shadow-lg p-4" style="max-width: 600px; width: 100%; border-radius: 12px; background-color: rgba(255, 255, 255, 0.8);">
                <!-- Logo -->
                <div class="text-center mb-4">
                    <img src="assets/sblogo.jpg" alt="Logo" width="80" height="80">
                </div>

                <h3 class="text-center mb-4">Create an Account</h3>

                <!-- Display errors if there are any -->
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="" method="POST" enctype="multipart/form-data">
                    <!-- Full Name and Username -->
                    <div class="row mb-3">
                        <div class="col-12 col-md-6">
                            <label for="fullname" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter your full name" value="<?php echo $fullname; ?>" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Choose a username" value="<?php echo $username; ?>" required>
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
                    <!-- Age, Sex, Address, and Profile Picture -->
                    <div class="row mb-3">
                        <div class="col-12 col-md-4">
                            <label for="age" class="form-label">Age</label>
                            <input type="number" class="form-control" id="age" name="age" placeholder="Enter your age" value="<?php echo $age; ?>" required>
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label">Sex</label>
                            <div class="d-flex">
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" id="male" name="sex" value="Male" <?php echo ($sex == 'Male') ? 'checked' : ''; ?> required>
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="female" name="sex" value="Female" <?php echo ($sex == 'Female') ? 'checked' : ''; ?> required>
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter your address" value="<?php echo $address; ?>" required>
                        </div>
                    </div>
                    <!-- Profile Picture -->
                    <div class="mb-3">
                        <label for="profile_picture" class="form-label">Profile Picture (Optional)</label>
                        <input type="file" class="form-control" id="profile_picture" name="profile_picture">
                    </div>
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-success w-100">Register</button>
                </form>

                <p class="text-center mt-3">
                    Already have an account? <a href="login.php">Login here</a>
                </p>
            </div>
        </div>
    </section>

    <!-- Bootstrap 5 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>