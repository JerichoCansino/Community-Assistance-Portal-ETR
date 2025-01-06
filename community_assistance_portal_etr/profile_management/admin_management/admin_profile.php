<?php
// Include the database connection file
include '../../database/db_connection.php';

// Start the session
session_start();

// Check if the user is logged in as admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch admin details from the database
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
    echo "Admin not found!";
    exit();
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <!-- Logo and Portal Name (No Link) -->
            <span class="navbar-brand">
                <img src="../../assets/sblogo.jpg" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
                Sta. Barbara Community Assistance Portal
            </span>
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

    <div class="container my-5">
        <h2 class="text-center mb-5">Admin Profile</h2>

        <!-- Profile Section (Image on Left, Details on Right) -->
        <div class="row">
            <!-- Profile Picture -->
            <div class="col-md-4 d-flex justify-content-center mb-4">
                <?php
                // Ensure the profile picture exists in the uploads folder
                $profilePicturePath = '../../uploads/' . (isset($user['profile_picture']) && $user['profile_picture'] ? $user['profile_picture'] : 'default.jpg');
                if (!file_exists($profilePicturePath)) {
                    $profilePicturePath = '../../uploads/default.jpg';
                }
                ?>
                <img src="<?php echo $profilePicturePath; ?>" alt="Profile Picture"
                    class="img-fluid rounded-circle border border-5 border-white shadow-sm" style="width: 150px; height: 150px;">
            </div>

            <!-- Profile Information (Card) -->
            <div class="col-md-8">
                <div class="card p-4 shadow-lg border-light rounded-3">
                    <h4 class="text-center mb-3"><?php echo htmlspecialchars($user['fullname']); ?></h4>

                    <div class="row mb-2">
                        <div class="col-4"><strong>Age:</strong></div>
                        <div class="col-8"><?php echo $user['age']; ?></div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-4"><strong>Sex:</strong></div>
                        <div class="col-8"><?php echo $user['sex']; ?></div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-4"><strong>Address:</strong></div>
                        <div class="col-8"><?php echo htmlspecialchars($user['address']); ?></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Profile Button -->
        <div class="row mt-4">
            <div class="col-md-4 d-flex justify-content-center">
                <a href="admin_edit_profile.php" class="btn btn-success w-50">
                    <i class="bi bi-pencil-square me-2"></i> Edit Profile
                </a>
            </div>
        </div>
        <!-- Back to Admin Dashboard Button -->
        <div class="row mt-4">
            <div class="col-md-4 d-flex justify-content-center">
                <a href="admin_dashboard.php" class="btn btn-primary w-50">
                    <i class="bi bi-arrow-left-circle me-2"></i> Back to Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>