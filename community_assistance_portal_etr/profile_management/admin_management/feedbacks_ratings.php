<?php
include '../../database/db_connection.php';

// Query to fetch feedbacks with user names and their ratings
$query = "
    SELECT f.*, u.fullname
    FROM feedbacks f
    JOIN users u ON f.user_id = u.id
    ORDER BY f.submitted_on DESC
";
$result = $conn->query($query);

function generateStars($rating) {
    // Create the number of stars based on the rating (from 1 to 5)
    $stars = '';
    for ($i = 0; $i < $rating; $i++) {
        $stars .= '⭐';  // Add one star for each point in the rating
    }
    // Add empty stars if rating is less than 5
    for ($i = $rating; $i < 5; $i++) {
        $stars .= '☆';  // Add an empty star for the remaining rating points
    }
    return $stars;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Monitor and Respond to Feedbacks and Ratings">
    <meta name="author" content="Your Name">
    <title>Monitor and Respond to Feedbacks and Ratings</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="assets/sblogo.jpg" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
                Sta. Barbara Community Assistance Portal
            </a>
        </div>
    </nav>

    <div class="mb-4" style="margin-left: 120px;">
        <a href="admin_dashboard.php" class="btn btn-outline-success">
            <i class="bi bi-arrow-left"></i> Back to Home
        </a>
    </div>

    <!-- Main Content -->
    <div class="container my-5">
        <h1 class="text-primary text-center mb-4">Monitor and Respond to Feedbacks and Ratings</h1>

        <!-- Feedbacks Table -->
        <div class="table-responsive mb-5">
            <table class="table table-bordered table-hover">
                <thead class="table-primary text-center">
                    <tr>
                        <th>Name</th>
                        <th>Rating</th>
                        <th>Feedback</th>
                        <th>Date</th>
                        <th>Replies</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Check if there are feedbacks
                    if ($result->num_rows > 0) {
                        // Output data of each feedback
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['fullname']) . "</td>";
                            
                            // Display the rating as stars
                            $rating = $row['rating']; // Assuming the rating is stored in the 'rating' column
                            $stars = generateStars($rating);
                            echo "<td>" . $stars . "</td>";

                            echo "<td>" . htmlspecialchars($row['feedback']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['submitted_on']) . "</td>";

                            // Fetch all replies for the current feedback
                            $feedback_id = $row['id'];
                            $repliesQuery = "SELECT * FROM feedback_replies WHERE feedback_id = $feedback_id ORDER BY submitted_on DESC";
                            $repliesResult = $conn->query($repliesQuery);

                            $repliesHtml = '';
                            if ($repliesResult->num_rows > 0) {
                                while ($reply = $repliesResult->fetch_assoc()) {
                                    $repliesHtml .= "<p><strong></strong> " . htmlspecialchars($reply['reply']) . " <em>on " . htmlspecialchars($reply['submitted_on']) . "</em></p>";
                                }
                            } else {
                                $repliesHtml = "<p>No replies yet.</p>";
                            }

                            echo "<td>" . $repliesHtml . "</td>";

                            echo "<td>";
                            echo "<button class='btn btn-success btn-sm' data-bs-toggle='modal' data-bs-target='#respondModal' data-feedback-id='" . $row['id'] . "' data-feedback='" . htmlspecialchars($row['fullname']) . ": " . htmlspecialchars($row['feedback']) . "'><i class='bi bi-chat-right-text'></i> Respond</button>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center'>No feedbacks available.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Respond to Feedback Modal -->
        <div class="modal fade" id="respondModal" tabindex="-1" aria-labelledby="respondModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="respondModalLabel">Respond to Feedback</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p id="feedbackContent"></p>
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="response" class="form-label">Your Response</label>
                                <textarea class="form-control" id="response" name="response" rows="4" placeholder="Write your response here"></textarea>
                            </div>
                            <input type="hidden" id="feedbackId" name="feedback_id" />
                            <button type="submit" class="btn btn-primary w-100">Submit Response</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Display message -->
        <?php if (isset($message)) : ?>
            <div class="alert alert-success mt-3"><?= $message ?></div>
        <?php endif; ?>

    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <p class="mb-0">&copy; 2025 Sta. Barbara Community Assistance Portal. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS and Icons -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Modal Scripts -->
    <script>
        const respondModal = document.getElementById('respondModal');

        respondModal.addEventListener('show.bs.modal', (event) => {
            const button = event.relatedTarget;
            const feedbackContent = button.getAttribute('data-feedback');
            const feedbackId = button.getAttribute('data-feedback-id');

            document.getElementById('feedbackContent').textContent = feedbackContent;
            document.getElementById('feedbackId').value = feedbackId;
        });
    </script>
</body>

</html>

<?php
// Close the connection
$conn->close();
?>
