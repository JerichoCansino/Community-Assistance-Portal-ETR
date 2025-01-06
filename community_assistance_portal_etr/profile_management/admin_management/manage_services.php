<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "community_portal";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle adding a new service
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addService'])) {
    $serviceName = $_POST['service_name'];
    $serviceDescription = $_POST['service_description'];

    $stmt = $conn->prepare("INSERT INTO services (service_name, description) VALUES (?, ?)");
    $stmt->bind_param("ss", $serviceName, $serviceDescription);
    $stmt->execute();
    $stmt->close();
}

// Handle updating a service
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateService'])) {
    $serviceId = $_POST['service_id'];
    $serviceName = $_POST['service_name'];
    $serviceDescription = $_POST['service_description'];

    $stmt = $conn->prepare("UPDATE services SET service_name = ?, description = ? WHERE id = ?");
    $stmt->bind_param("ssi", $serviceName, $serviceDescription, $serviceId);
    $stmt->execute();
    $stmt->close();
}

// Handle deleting a service
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteService'])) {
    $serviceId = $_POST['service_id'];

    $stmt = $conn->prepare("DELETE FROM services WHERE id = ?");
    $stmt->bind_param("i", $serviceId);
    $stmt->execute();
    $stmt->close();
}

// Fetch all services from the database
$query = "SELECT * FROM services";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Services Offered</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
        }

        .modal-content {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="assets/sblogo.jpg" alt="Logo" width="80" height="80">
                Sta. Barbara Community Assistance Portal
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <section class="py-5 bg-light">
            <div class="container">
                <h2 class="mb-4 text-center">Manage Services Offered</h2>

                <!-- Add Service Button -->
                <button class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addServiceModal">
                    <i class="bi bi-plus-circle"></i> Add New Service
                </button>

                <!-- Services Table -->
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Service Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <th scope="row"><?php echo htmlspecialchars($row['id']); ?></th>
                                <td><?php echo htmlspecialchars($row['service_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['description']); ?></td>
                                <td>
                                    <!-- Update Button -->
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateServiceModal"
                                            onclick="setUpdateService('<?php echo $row['id']; ?>', '<?php echo htmlspecialchars($row['service_name']); ?>', '<?php echo htmlspecialchars($row['description']); ?>')">
                                        <i class="bi bi-pencil"></i> Update
                                    </button>

                                    <!-- Delete Button -->
                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteServiceModal"
                                            onclick="setDeleteService('<?php echo $row['id']; ?>', '<?php echo htmlspecialchars($row['service_name']); ?>')">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <!-- Add Service Modal -->
    <div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addServiceModalLabel">Add New Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label for="serviceName" class="form-label">Service Name</label>
                            <input type="text" class="form-control" name="service_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="serviceDescription" class="form-label">Description</label>
                            <textarea class="form-control" name="service_description" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="addService">Add Service</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Service Modal -->
    <div class="modal fade" id="updateServiceModal" tabindex="-1" aria-labelledby="updateServiceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateServiceModalLabel">Update Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <input type="hidden" name="service_id" id="updateServiceId">
                        <div class="mb-3">
                            <label for="serviceName" class="form-label">Service Name</label>
                            <input type="text" class="form-control" name="service_name" id="updateServiceName" required>
                        </div>
                        <div class="mb-3">
                            <label for="serviceDescription" class="form-label">Description</label>
                            <textarea class="form-control" name="service_description" id="updateServiceDescription" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-warning" name="updateService">Update Service</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Service Modal -->
    <div class="modal fade" id="deleteServiceModal" tabindex="-1" aria-labelledby="deleteServiceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteServiceModalLabel">Delete Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this service?
                </div>
                <div class="modal-footer">
                    <form method="POST">
                        <input type="hidden" name="service_id" id="deleteServiceId">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger" name="deleteService">Delete Service</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p class="mb-2">&copy; 2024 Sta. Barbara Community Assistance Portal. All rights reserved.</p>
        <p>Contact us: <a href="mailto:info@sbcommunityportal.com" class="text-light">info@sbcommunityportal.com</a></p>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function setUpdateService(id, name, description) {
            document.getElementById('updateServiceId').value = id;
            document.getElementById('updateServiceName').value = name;
            document.getElementById('updateServiceDescription').value = description;
        }

        function setDeleteService(id, name) {
            document.getElementById('deleteServiceId').value = id;
        }
    </script>
</body>

</html>

<?php
$conn->close();
?>
