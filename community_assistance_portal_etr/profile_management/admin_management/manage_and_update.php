<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Community Services</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <main class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-4">Manage Community Services</h2>

            <!-- Add Service Button -->
            <div class="mb-4 text-end">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addServiceModal">
                    <i class="bi bi-plus-circle"></i> Add Service
                </button>
            </div>

            <!-- Services Table -->
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Location</th>
                            <th>Contact</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sample Row -->
                        <tr>
                            <td>1</td>
                            <td>Medical Assistance</td>
                            <td>Sta. Barbara Health Center</td>
                            <td>+63 912 345 6789</td>
                            <td>Provides free checkups and basic medications.</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#updateServiceModal" data-service='{"title": "Medical Assistance", "location": "Sta. Barbara Health Center", "contact": "+63 912 345 6789", "description": "Provides free checkups and basic medications."}'>
                                    <i class="bi bi-pencil-square"></i> Update
                                </button>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteServiceModal" data-service="Medical Assistance">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </td>
                        </tr>
                        <!-- Additional rows go here -->
                    </tbody>
                </table>
            </div>
        </div>
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
                    <form>
                        <div class="mb-3">
                            <label for="serviceTitle" class="form-label">Service Title</label>
                            <input type="text" class="form-control" id="serviceTitle" placeholder="Enter service title">
                        </div>
                        <div class="mb-3">
                            <label for="serviceLocation" class="form-label">Location</label>
                            <input type="text" class="form-control" id="serviceLocation" placeholder="Enter location">
                        </div>
                        <div class="mb-3">
                            <label for="serviceContact" class="form-label">Contact</label>
                            <input type="text" class="form-control" id="serviceContact" placeholder="Enter contact information">
                        </div>
                        <div class="mb-3">
                            <label for="serviceDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="serviceDescription" rows="4" placeholder="Enter service description"></textarea>
                        </div>
                        <button type="button" class="btn btn-primary w-100">Add Service</button>
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
                    <form>
                        <div class="mb-3">
                            <label for="updateServiceTitle" class="form-label">Service Title</label>
                            <input type="text" class="form-control" id="updateServiceTitle" value="">
                        </div>
                        <div class="mb-3">
                            <label for="updateServiceLocation" class="form-label">Location</label>
                            <input type="text" class="form-control" id="updateServiceLocation" value="">
                        </div>
                        <div class="mb-3">
                            <label for="updateServiceContact" class="form-label">Contact</label>
                            <input type="text" class="form-control" id="updateServiceContact" value="">
                        </div>
                        <div class="mb-3">
                            <label for="updateServiceDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="updateServiceDescription" rows="4"></textarea>
                        </div>
                        <button type="button" class="btn btn-warning w-100">Update Service</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Service Modal -->
    <div class="modal fade" id="deleteServiceModal" tabindex="-1" aria-labelledby="deleteServiceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteServiceModalLabel">Delete Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete the service: <strong id="deleteServiceName"></strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p class="mb-0">&copy; 2025 Sta. Barbara Community Assistance Portal. All rights reserved.</p>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Modal Scripts -->
    <script>
        const updateServiceModal = document.getElementById('updateServiceModal');
        const deleteServiceModal = document.getElementById('deleteServiceModal');

        updateServiceModal.addEventListener('show.bs.modal', (event) => {
            const button = event.relatedTarget;
            const serviceData = JSON.parse(button.getAttribute('data-service'));

            document.getElementById('updateServiceTitle').value = serviceData.title;
            document.getElementById('updateServiceLocation').value = serviceData.location;
            document.getElementById('updateServiceContact').value = serviceData.contact;
            document.getElementById('updateServiceDescription').value = serviceData.description;
        });

        deleteServiceModal.addEventListener('show.bs.modal', (event) => {
            const button = event.relatedTarget;
            const serviceName = button.getAttribute('data-service');

            document.getElementById('deleteServiceName').textContent = serviceName;
        });
    </script>
</body>

</html>
