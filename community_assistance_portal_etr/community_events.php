<?php
include('database/db_connection.php');
session_start();
$sql = "SELECT * FROM events ORDER BY date ASC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Community Events Listing">
    <meta name="author" content="Your Name">
    <title>Events Listing</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="assets/sblogo.jpg" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
                Sta. Barbara Community Assistance Portal
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <!-- Red logout link -->
                        <a class="nav-link text-danger" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container my-5">
    <h1 class="text-center text-primary mb-4">Upcoming Community Events</h1>
    <p class="text-center text-muted mb-5">Stay updated on the latest events happening in our community.</p>

    <div class="list-group">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="list-group-item list-group-item-action mb-3 shadow-sm">';
                echo '<h5 class="mb-2 text-dark">' . htmlspecialchars($row['title']) . '</h5>';
                echo '<p class="mb-2 text-muted"><i class="bi bi-calendar-date"></i> Date: ' . htmlspecialchars($row['date']) . '</p>';
                echo '<p class="mb-2 text-muted"><i class="bi bi-clock"></i> Time: ' . htmlspecialchars($row['time']) . '</p>';
                echo '<p class="mb-2 text-muted"><i class="bi bi-geo-alt"></i> Location: ' . htmlspecialchars($row['location']) . '</p>';
                echo '<p class="mb-3">' . htmlspecialchars($row['description']) . '</p>';
                echo '<a href="#" class="btn btn-outline-primary btn-sm">RSVP Now</a>';
                echo '</div>';
            }
        } else {
            echo '<p class="text-center text-muted">No events available at the moment.</p>';
        }
        ?>
    </div>
</div>

        <!-- Suggest Event Form -->
        <div class="mt-5">
    <h5 class="text-center text-success mb-4">Suggest an Event</h5>
    <form action="suggest-event.php" method="POST">
        <div class="mb-3">
            <label for="eventTitle" class="form-label">Event Title</label>
            <input type="text" class="form-control" name="eventTitle" id="eventTitle" placeholder="Enter event title" required>
        </div>
        <div class="mb-3">
            <label for="eventDate" class="form-label">Event Date</label>
            <input type="date" class="form-control" name="eventDate" id="eventDate" required>
        </div>
        <div class="mb-3">
            <label for="eventTime" class="form-label">Event Time</label>
            <input type="time" class="form-control" name="eventTime" id="eventTime" required>
        </div>
        <div class="mb-3">
            <label for="eventLocation" class="form-label">Event Location</label>
            <input type="text" class="form-control" name="eventLocation" id="eventLocation" placeholder="Enter event location" required>
        </div>
        <div class="mb-3">
            <label for="eventDescription" class="form-label">Event Description</label>
            <textarea class="form-control" name="eventDescription" id="eventDescription" rows="3" placeholder="Enter event description" required></textarea>
        </div>
        <button type="submit" class="btn btn-outline-success">Submit Event</button>
    </form>

    <!-- Display success or error messages -->
    <?php if (isset($success_message)): ?>
        <p class="text-success mt-3 text-center"><?= htmlspecialchars($success_message); ?></p>
    <?php elseif (isset($error_message)): ?>
        <p class="text-danger mt-3 text-center"><?= htmlspecialchars($error_message); ?></p>
    <?php endif; ?>
</div>

        <!-- Additional Info -->
        <div class="mt-4 text-center">
            <a href="index.php" class="btn btn-outline-success px-5 py-3">Back to Home</a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <p class="mb-0">&copy; 2024 Sta. Barbara Community Assistance Portal. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS and Icons -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>