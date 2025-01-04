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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    
                    <li class="nav-item">
                        <a class="nav-link" href="admin_dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">No new notifications</a></li>
                        </ul>
            </div>
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
                        <!-- Example Service 1 -->
                        <tr>
                            <th scope="row">1</th>
                            <td>Community Clean-up</td>
                            <td>Volunteer work to clean up local neighborhoods.</td>
                            <td>
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateServiceModal" onclick="setUpdateService('1', 'Community Clean-up', 'Volunteer work to clean up local neighborhoods.')">
                                    <i class="bi bi-pencil"></i> Update
                                </button>
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteServiceModal" onclick="setDeleteService('1', 'Community Clean-up')">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </td>
                        </tr>
                        <!-- Example Service 2 -->
                        <tr>
                            <th scope="row">2</th>
                            <td>Food Distribution</td>
                            <td>Provide food to those in need during emergencies.</td>
                            <td>
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateServiceModal" onclick="setUpdateService('2', 'Food Distribution', 'Provide food to those in need during emergencies.')">
                                    <i class="bi bi-pencil"></i> Update
                                </button>
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteServiceModal" onclick="setDeleteService('2', 'Food Distribution')">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </td>
                        </tr>
                        <!-- Add more services as necessary -->
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
                    <form id="addServiceForm">
                        <div class="mb-3">
                            <label for="serviceName" class="form-label">Service Name</label>
                            <input type="text" class="form-control" id="serviceName" required>
                        </div>
                        <div class="mb-3">
                            <label for="serviceDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="serviceDescription" required></textarea>
                        </div>
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


</body>

</html>
