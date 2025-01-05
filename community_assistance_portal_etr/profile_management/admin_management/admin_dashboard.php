<?php
// Start the session
session_start();

// Assuming admin name and profile picture are already set in session (this part can be modified later when you have the backend data)
$admin_name = isset($_SESSION['fullname']) ? $_SESSION['fullname'] : "Admin";
$profile_picture = isset($_SESSION['profile_picture']) ? $_SESSION['profile_picture'] : 'default.jpg';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">
    <!-- Sidebar + Main Content Container -->
    <div class="d-flex">
        <!-- Sidebar -->
        <nav id="sidebar" class="bg-success text-white p-3 d-flex flex-column" style="min-height: 100vh; width: 250px;">
            <!-- Logo -->
            <div class="d-flex justify-content-center mb-4">
                <img src="assets/sblogo.jpg" alt="Logo" width="60" height="60" class="rounded-circle">
            </div>
            <!-- Manage System Title -->
            <div class="text-center mb-4">
                <h5 class="text-white">System Management</h5>
            </div>
            <!-- Sidebar Menu -->
            <ul class="nav flex-column mb-auto">
                <li class="nav-item mb-3 border-bottom border-light">
                    <a class="nav-link text-white small" href="community_events.php">
                        <i class="bi bi-calendar-event me-2"></i>Community Events
                    </a>
                </li>
                <li class="nav-item mb-3 border-bottom border-light">
                    <a class="nav-link text-white small" href="community_resources.php">
                        <i class="bi bi-briefcase me-2"></i>Community Resources
                    </a>
                </li>
                <li class="nav-item mb-3 border-bottom border-light">
                    <a class="nav-link text-white small" href="help_requests_offers.php">
                        <i class="bi bi-hand-thumbs-up me-2"></i>Help Requests and Offers
                    </a>
                </li>
                <li class="nav-item mb-3 border-bottom border-light">
                    <a class="nav-link text-white small" href="feedbacks_ratings.php">
                        <i class="bi bi-star me-2"></i>Feedbacks and Ratings
                    </a>
                </li>
            </ul>
            <!-- Logout Button at the Bottom -->
            <div class="mt-auto">
                <a href="logout.php" class="btn btn-light w-100 text-success fw-bold">
                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                </a>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="container-fluid">
            <!-- Navigation Bar -->
            <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
                <div class="container">
                    <a class="navbar-brand text-dark fw-bold" href="#">Sta. Barbara Community Assistance Portal</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <!-- Display Admin Name without dropdown -->
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="#">
                                    <img src="../../uploads/<?php echo htmlspecialchars($profile_picture); ?>" alt="Profile Pic" class="rounded-circle" width="30" height="30" style="margin-right: 8px;">
                                    <!-- Display Admin Name -->
                                    <span><?php echo htmlspecialchars($admin_name); ?></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Main Dashboard Content -->
            <main class="py-5">
                <div class="container">
                    <h2 class="text-center text-success">Admin Dashboard</h2>

                    <!-- Dashboard Stats -->
                    <div class="row mt-4">
                        <div class="col-md-3 mb-3">
                            <div class="card border-success h-100">
                                <div class="card-body text-center">
                                    <i class="bi bi-person-fill fs-2 text-success mb-3"></i>
                                    <h5 class="card-title text-success">Users</h5>
                                    <p class="card-text">0</p> <!-- Placeholder count -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card border-success h-100">
                                <div class="card-body text-center">
                                    <i class="bi bi-briefcase-fill fs-2 text-success mb-3"></i>
                                    <h5 class="card-title text-success">Services Offered</h5>
                                    <p class="card-text">0</p> <!-- Placeholder count -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card border-success h-100">
                                <div class="card-body text-center">
                                    <i class="bi bi-exclamation-triangle-fill fs-2 text-success mb-3"></i>
                                    <h5 class="card-title text-success">Help Requests Pending</h5>
                                    <p class="card-text">0</p> <!-- Placeholder count -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card border-success h-100">
                                <div class="card-body text-center">
                                    <i class="bi bi-calendar-check-fill fs-2 text-success mb-3"></i>
                                    <h5 class="card-title text-success">Community Event Suggestions</h5>
                                    <p class="card-text">0</p> <!-- Placeholder count -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>