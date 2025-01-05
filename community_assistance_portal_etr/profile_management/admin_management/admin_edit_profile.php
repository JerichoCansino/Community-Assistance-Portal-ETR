<?php
// Include the database connection file
include '../../database/db_connection.php';

// Start the session
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Determine the user to edit (either the admin's own profile or another user)
$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : $_SESSION['user_id'];

// Fetch the current user details from the database
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if user is found
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    // Handle case where user is not found
    echo "User not found!";
    exit();
}

$stmt->close();

// Initialize variables
$fullname = $age = $sex = $address = $username = $password = $profile_picture = "";
$error_message = $success_message = "";

// Handle form submission for profile update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data and sanitize input
    $fullname = htmlspecialchars(trim($_POST['fullname']));
    $age = intval($_POST['age']);  // Ensure age is an integer
    $sex = htmlspecialchars(trim($_POST['sex']));
    $address = htmlspecialchars(trim($_POST['address']));
    $username = htmlspecialchars(trim($_POST['username']));

    // Basic validation: Ensure all fields are filled
    if (empty($fullname) || empty($age) || empty($sex) || empty($address) || empty($username)) {
        $error_message = "All fields are required!";
    } else {
        // If no new password is provided, retain the existing password
        if (empty($_POST['password'])) {
            $password = $user['password'];
        } else {
            $password = $_POST['password']; // Use plain text password for testing
        }

        // Handle file upload (profile picture)
        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
            $upload_dir = '../../uploads/';
            $profile_picture = basename($_FILES['profile_picture']['name']);
            $target_file = $upload_dir . $profile_picture;

            // Check file type (optional: restrict file types, e.g., only allow image files)
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
            if (in_array($_FILES['profile_picture']['type'], $allowed_types)) {
                if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file)) {
                    // Successfully uploaded
                } else {
                    $error_message = "Sorry, there was an error uploading your file.";
                }
            } else {
                $error_message = "Invalid file type. Only JPEG, PNG, and GIF files are allowed.";
            }
        } else {
            // If no new profile picture is uploaded, retain the existing one
            $profile_picture = $user['profile_picture'];
        }

        // Update the database with the new profile information if there are no errors
        if (empty($error_message)) {
            $query = "UPDATE users SET fullname = ?, age = ?, sex = ?, address = ?, username = ?, password = ?, profile_picture = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sisssssi", $fullname, $age, $sex, $address, $username, $password, $profile_picture, $user_id);

            if ($stmt->execute()) {
                $success_message = "Profile updated successfully!";
                // Redirect to the admin profile page after successful update
                header("Location: admin_profile.php"); // Redirect to admin profile page
                exit(); // Don't forget to call exit to stop further code execution
            }


            $stmt->close();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="../../index.php">
                <img src="../../assets/sblogo.jpg" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
                Sta. Barbara Community Assistance Portal
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="btn btn-danger text-white ms-2" href="../../logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-sm my-5">
        <h2 class="text-center text-success mb-4">Edit Profile</h2>

        <!-- Success or Error Messages -->
        <?php if ($success_message): ?>
            <div class="alert alert-success"><?php echo $success_message; ?></div>
        <?php endif; ?>
        <?php if ($error_message): ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <!-- Edit Profile Form in a smaller Card -->
        <div class="card shadow-lg p-3">
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">

                    <!-- Profile Picture Section -->
                    <div class="text-center mb-4">
                        <?php if (!empty($user['profile_picture'])): ?>
                            <img src="../../uploads/<?php echo htmlspecialchars($user['profile_picture']); ?>" alt="Profile Picture" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
                        <?php else: ?>
                            <img src="../../assets/default-profile.png" alt="Profile Picture" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
                        <?php endif; ?>
                        <div class="mb-3 mt-2">
                            <input type="file" class="form-control" name="profile_picture" id="profile_picture">
                        </div>
                    </div>

                    <!-- Form Fields -->
                    <div class="row">
                        <div class="col-md-6">
                            <label for="fullname" class="form-label fw-bold">Full Name</label>
                            <input type="text" id="fullname" name="fullname" class="form-control" value="<?php echo htmlspecialchars($user['fullname']); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="age" class="form-label fw-bold">Age</label>
                            <input type="number" id="age" name="age" class="form-control" value="<?php echo htmlspecialchars($user['age']); ?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="sex" class="form-label fw-bold">Sex</label>
                            <select id="sex" name="sex" class="form-select" required>
                                <option value="Male" <?php echo ($user['sex'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                                <option value="Female" <?php echo ($user['sex'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="address" class="form-label fw-bold">Address</label>
                            <input type="text" id="address" name="address" class="form-control" value="<?php echo htmlspecialchars($user['address']); ?>" required>
                        </div>
                    </div>

                    <!-- Username and Password fields -->
                    <div class="row">
                        <div class="col-md-6">
                            <label for="username" class="form-label fw-bold">Username</label>
                            <input type="text" id="username" name="username" class="form-control" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label fw-bold">Password (Leave empty to keep current password)</label>
                            <input type="password" id="password" name="password" class="form-control">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success w-100 mt-4">Update Profile</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>