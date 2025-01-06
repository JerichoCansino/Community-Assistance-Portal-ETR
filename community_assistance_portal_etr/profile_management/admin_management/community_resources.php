<?php
include '../../database/db_connection.php'; // Include database connection file

// Handle Add Resource
if (isset($_POST['add_resource'])) {
    $title = $_POST['title'];
    $location = $_POST['location'];
    $contact = $_POST['contact'];
    $description = $_POST['description'];

    $sql = "INSERT INTO `resources` (`title`, `location`, `contact`, `description`) 
            VALUES ('$title', '$location', '$contact', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Resource added successfully'); window.location.href = ''; </script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Handle Update Resource
if (isset($_POST['update_resource'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $location = $_POST['location'];
    $contact = $_POST['contact'];
    $description = $_POST['description'];

    $sql = "UPDATE `resources` SET `title`='$title', `location`='$location', `contact`='$contact', `description`='$description' WHERE `id`='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Resource updated successfully'); window.location.href = ''; </script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Handle Delete Resource
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM `resources` WHERE `id`='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Resource deleted successfully'); window.location.href = 'community_resources.php'; </script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Fetch resources from the database
$sql = "SELECT `id`, `title`, `location`, `contact`, `description` FROM `resources` WHERE 1";
$result = $conn->query($sql);

// Check if any resources exist
$resources = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $resources[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Community Resources">
    <meta name="author" content="Your Name">
    <title>Community Resources</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
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
                </ul>
            </div>
        </div>
    </nav>

    <div class="mb-4" style="margin-left: 120px;">
        <a href="admin_dashboard.php" class="btn btn-outline-success">
            <i class="bi bi-arrow-left"></i> Back to Home
        </a>
    </div>

    <!-- Main Content -->
    <div class="container my-5">
        <h1 class="text-primary text-center mb-4">Community Resources</h1>
        <p class="text-center">Explore the resources available for the community.</p>

        <!-- Add Resource Form -->
        <div class="mb-4">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addResourceModal">Add Resource</button>
        </div>

        <!-- Resources List -->
        <div class="row">
            <?php foreach ($resources as $resource): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-primary"><?= htmlspecialchars($resource['title']) ?></h5>
                            <p class="card-text">
                                <strong>Location:</strong> <?= htmlspecialchars($resource['location']) ?><br>
                                <strong>Contact:</strong> <?= htmlspecialchars($resource['contact']) ?><br>
                                <?= htmlspecialchars($resource['description']) ?>
                            </p>
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateResourceModal" data-id="<?= $resource['id'] ?>" data-title="<?= $resource['title'] ?>" data-location="<?= $resource['location'] ?>" data-contact="<?= $resource['contact'] ?>" data-description="<?= $resource['description'] ?>">Edit</a>
                            <a href="?delete=<?= $resource['id'] ?>" class="btn btn-danger">Delete</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <p class="mb-0">&copy; 2025 Sta. Barbara Community Assistance Portal. All rights reserved.</p>
    </footer>

    <!-- Add Resource Modal -->
    <div class="modal fade" id="addResourceModal" tabindex="-1" aria-labelledby="addResourceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addResourceModalLabel">Add New Resource</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="location" required>
                        </div>
                        <div class="mb-3">
                            <label for="contact" class="form-label">Contact</label>
                            <input type="text" class="form-control" id="contact" name="contact" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="add_resource">Add Resource</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Update Resource Modal -->
    <div class="modal fade" id="updateResourceModal" tabindex="-1" aria-labelledby="updateResourceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateResourceModalLabel">Update Resource</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <input type="hidden" id="resource_id" name="id">
                        <div class="mb-3">
                            <label for="update_title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="update_title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="update_location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="update_location" name="location" required>
                        </div>
                        <div class="mb-3">
                            <label for="update_contact" class="form-label">Contact</label>
                            <input type="text" class="form-control" id="update_contact" name="contact" required>
                        </div>
                        <div class="mb-3">
                            <label for="update_description" class="form-label">Description</label>
                            <textarea class="form-control" id="update_description" name="description" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="update_resource">Update Resource</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var updateResourceModal = document.getElementById('updateResourceModal');
        updateResourceModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            document.getElementById('resource_id').value = button.getAttribute('data-id');
            document.getElementById('update_title').value = button.getAttribute('data-title');
            document.getElementById('update_location').value = button.getAttribute('data-location');
            document.getElementById('update_contact').value = button.getAttribute('data-contact');
            document.getElementById('update_description').value = button.getAttribute('data-description');
        });
    </script>
</body>

</html>
