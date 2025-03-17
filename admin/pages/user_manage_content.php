<?php
session_start();
include('../context/connect.php');

// Fetch all users (without role/status as they don't exist in the user table)
$users = $conn->query("SELECT id, first_name, last_name, email, registered_date FROM user ORDER BY registered_date DESC")->fetchAll(PDO::FETCH_ASSOC);

// Handle Delete User
if (isset($_GET['delete_user_id'])) {
    $delete_user_id = $_GET['delete_user_id'];
    $stmt = $conn->prepare("DELETE FROM user WHERE id = ?");
    $stmt->execute([$delete_user_id]);

    header("Location: user_management.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">User Management</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Date Registered</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= htmlspecialchars($user['first_name']) ?></td>
                <td><?= htmlspecialchars($user['last_name']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td><?= $user['registered_date'] ?></td>
                <td>
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editUserModal" 
                            data-id="<?= $user['id'] ?>" data-first_name="<?= $user['first_name'] ?>" data-last_name="<?= $user['last_name'] ?>" data-email="<?= $user['email'] ?>">
                        Edit
                    </button>
                    <a href="user_management.php?delete_user_id=<?= $user['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">
                        Delete
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal for editing user -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editUserForm">
                    <input type="hidden" name="id" id="user_id">
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Pass data to modal for editing
    var editUserModal = document.getElementById('editUserModal');
    editUserModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Button that triggered the modal
        var userId = button.getAttribute('data-id');
        var firstName = button.getAttribute('data-first_name');
        var lastName = button.getAttribute('data-last_name');
        var email = button.getAttribute('data-email');

        var modal = editUserModal.querySelector('form');
        modal.querySelector('#user_id').value = userId;
        modal.querySelector('#first_name').value = firstName;
        modal.querySelector('#last_name').value = lastName;
        modal.querySelector('#email').value = email;
    });

    // Submit form via AJAX to update user
    $("#editUserForm").submit(function(e) {
        e.preventDefault();

        var formData = $(this).serialize();  // Get form data

        $.ajax({
            url: '',  // Current page (user_management.php)
            method: 'POST',
            data: formData,  // Send form data
            success: function(response) {
                alert("User updated successfully.");
                window.location.reload();  // Reload page to reflect changes
            },
            error: function() {
                alert("Error updating user.");
            }
        });
    });
</script>

</body>
</html>

<?php
// Handle Edit User Request (via AJAX)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $user_id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];

    // Update user in the database
    $stmt = $conn->prepare("UPDATE user SET first_name = ?, last_name = ?, email = ? WHERE id = ?");
    $stmt->execute([$first_name, $last_name, $email, $user_id]);

    // Return a response (optional)
    echo "User updated successfully.";
    exit();
}
?>
