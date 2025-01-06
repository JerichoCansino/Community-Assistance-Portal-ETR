<?php
session_start();
include('database/db_connection.php'); // Include your DB connection here

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    $_SESSION['message'] = "You must be logged in to view this page.";
    header('Location: profile_management/login.php'); // Redirect to login page if not logged in
    exit();
}

$userid = $_SESSION['user_id']; // Get the user ID from the session

// Fetch the user's requests and offers
$sql = "SELECT * FROM offers WHERE userid = '$userid' ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Help Requests and Offers">
    <meta name="author" content="Your Name">
    <title>Help Requests and Offers</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="assets/sblogo.jpg" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
                Santa Barbara Community Assistance Portal
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container my-5">
        <h1 class="text-success text-center mb-4">Your Help Requests and Offers</h1>
        <p class="text-center">Manage your requests and offers in the community.</p>

        <div class="row">
            <!-- Request Help Form -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Request Help</h4>
                    </div>
                    <div class="card-body">
                        <form action="process_help_request.php" method="POST">
                            <div class="mb-3">
                                <label for="requestName" class="form-label">Your Name</label>
                                <input type="text" class="form-control" id="requestName" name="requestName" required>
                            </div>
                            <div class="mb-3">
                                <label for="requestContact" class="form-label">Contact Information</label>
                                <input type="text" class="form-control" id="requestContact" name="requestContact" required>
                            </div>
                            <div class="mb-3">
                                <label for="requestDetails" class="form-label">Details of Help Needed</label>
                                <textarea class="form-control" id="requestDetails" name="requestDetails" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Request</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Offer Help Form -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">Offer Help</h4>
                    </div>
                    <div class="card-body">
                        <form action="process_help_offer.php" method="POST">
                            <div class="mb-3">
                                <label for="offerName" class="form-label">Your Name</label>
                                <input type="text" class="form-control" id="offerName" name="offerName" required>
                            </div>
                            <div class="mb-3">
                                <label for="offerContact" class="form-label">Contact Information</label>
                                <input type="text" class="form-control" id="offerContact" name="offerContact" required>
                            </div>
                            <div class="mb-3">
                                <label for="offerDetails" class="form-label">Details of Assistance Offered</label>
                                <textarea class="form-control" id="offerDetails" name="offerDetails" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-success">Submit Offer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Display Requests and Offers -->
        <div class="row mt-4">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="col-md-6">
                        <div class="card shadow-sm mb-3">
                            <div class="card-header <?= ($row['type'] == 'request') ? 'bg-danger' : 'bg-success' ?> text-white">
                                <h4 class="mb-0"><?= ucfirst($row['type']) ?></h4>
                            </div>
                            <div class="card-body">
                                <p><strong>Name:</strong> <?= htmlspecialchars($row['name']) ?></p>
                                <p><strong>Contact:</strong> <?= htmlspecialchars($row['contact']) ?></p>
                                <p><strong>Details:</strong> <?= nl2br(htmlspecialchars($row['details'])) ?></p>
                                <p><small class="text-muted">Posted on: <?= $row['created_at'] ?></small></p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-center text-muted">No requests or offers available at the moment.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <p class="mb-0">&copy; 2024 Sta. Barbara Community Assistance Portal. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php mysqli_close($conn); ?>
