<?php
// Include database connection
include '../../database/db_connection.php';

// Fetch offers from the database
$query = "SELECT * FROM offers";
$result = $conn->query($query);

// Handle acceptance or decline
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['accept'])) {
        $offerId = $_POST['offer_id'];
        $updateQuery = "UPDATE offers SET status = 'Accepted' WHERE id = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("i", $offerId);
        $stmt->execute();
    } elseif (isset($_POST['decline'])) {
        $offerId = $_POST['offer_id'];
        $updateQuery = "UPDATE offers SET status = 'Declined' WHERE id = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("i", $offerId);
        $stmt->execute();
    }
}

// Fetch updated offers data
$result = $conn->query($query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Help Requests & Offers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { display: flex; flex-direction: column; min-height: 100vh; }
        main { flex: 1; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">Sta. Barbara Community Assistance Portal</a>
        </div>
    </nav>

    <div class="mb-4" style="margin-left: 120px;">
        <a href="admin_dashboard.php" class="btn btn-outline-success">
            <i class="bi bi-arrow-left"></i> Back to Home
        </a>
    </div>

    <main class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-4">Manage Help Requests & Offers</h2>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Contact</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['id']); ?></td>
                                <td><?php echo htmlspecialchars($row['type']); ?></td>
                                <td><?php echo htmlspecialchars($row['details']); ?></td>
                                <td><?php echo htmlspecialchars($row['contact']); ?></td>
                                <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                                <td><?php echo htmlspecialchars($row['status']); ?></td>
                                <td>
                                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#acceptModal" data-id="<?php echo $row['id']; ?>" data-name="<?php echo $row['type']; ?>">Accept</button>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#declineModal" data-id="<?php echo $row['id']; ?>" data-name="<?php echo $row['type']; ?>">Decline</button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Accept Modal -->
    <div class="modal fade" id="acceptModal" tabindex="-1" aria-labelledby="acceptModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="acceptModalLabel">Accept Request/Offer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to accept the request/offer: <strong id="acceptEventName"></strong>?
                </div>
                <div class="modal-footer">
                    <form method="POST">
                        <input type="hidden" name="offer_id" id="acceptOfferId">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success" name="accept">Yes, Accept</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Decline Modal -->
    <div class="modal fade" id="declineModal" tabindex="-1" aria-labelledby="declineModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="declineModalLabel">Decline Request/Offer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to decline the request/offer: <strong id="declineEventName"></strong>?
                </div>
                <div class="modal-footer">
                    <form method="POST">
                        <input type="hidden" name="offer_id" id="declineOfferId">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger" name="decline">Yes, Decline</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-3">
        <p class="mb-0">&copy; 2025 Sta. Barbara Community Assistance Portal. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const acceptModal = document.getElementById('acceptModal');
        const declineModal = document.getElementById('declineModal');

        acceptModal.addEventListener('show.bs.modal', (event) => {
            const button = event.relatedTarget;
            const eventName = button.getAttribute('data-name');
            const offerId = button.getAttribute('data-id');
            document.getElementById('acceptEventName').textContent = eventName;
            document.getElementById('acceptOfferId').value = offerId;
        });

        declineModal.addEventListener('show.bs.modal', (event) => {
            const button = event.relatedTarget;
            const eventName = button.getAttribute('data-name');
            const offerId = button.getAttribute('data-id');
            document.getElementById('declineEventName').textContent = eventName;
            document.getElementById('declineOfferId').value = offerId;
        });
    </script>
</body>
</html>
