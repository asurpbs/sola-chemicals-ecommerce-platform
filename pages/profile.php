<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT']."/context/connect.php";

// Check if user is logged in
if (!isset($_COOKIE['user_id'])) {
    $_SESSION['error_message'] = "Please login first";
    // Use JavaScript for redirection instead of header()
    echo "<script>window.location.href = '/pages/signin.php';</script>";
    exit();
}

// Initialize js_redirect variable to avoid undefined variable warning
$js_redirect = false;
$redirect_url = '';

// Handle form submissions first
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once $_SERVER['DOCUMENT_ROOT'].'/pages/handlers/profile_handler.php';
    
    // Use JavaScript for redirection instead of PHP header()
    echo "<script>window.location.replace('/index.php?page=profile');</script>";
    exit();
}

$user_id = $_COOKIE['user_id'];

// Get user data first
$stmt = $conn->prepare("SELECT * FROM user WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "<script>window.location.href = '/pages/signin.php';</script>";
    exit();
}

// Get user address
$stmt = $conn->prepare("SELECT a.*, c.name_en as city_name FROM user_address a 
                       LEFT JOIN city c ON a.city_id = c.id 
                       WHERE a.user_id = ?");
$stmt->execute([$user_id]);
$address = $stmt->fetch(PDO::FETCH_ASSOC);

// Get user telephone
$stmt = $conn->prepare("SELECT * FROM user_telephone WHERE user_id = ?");
$stmt->execute([$user_id]);
$telephone = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch cities for dropdown
$stmt = $conn->prepare("SELECT id, name_en FROM city ORDER BY name_en");
$stmt->execute();
$cities = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Add message handling
$active_section = isset($_GET['section']) ? $_GET['section'] : 'personal';
$success_message = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : '';
$error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : '';
unset($_SESSION['success_message'], $_SESSION['error_message']);

// Function to get image URL
function getImageUrl($image_name) {
    if (empty($image_name)) {
        return '/uploads/user/null.png';
    }
    return '/uploads/user/' . $image_name;
}
?>

<?php if ($js_redirect): ?>
<script>
    window.location.replace('<?php echo $redirect_url; ?>');
</script>
<?php endif; ?>

<div class="profile-settings-container">
    <h1>Account Settings</h1>
    
    <!-- Add this right after the h1 tag -->
    <?php if ($success_message): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($success_message); ?></div>
    <?php endif; ?>
    <?php if ($error_message): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
    <?php endif; ?>

    <!-- Update the navigation buttons to use the active section -->
    <div class="profile-settings-nav">
        <button class="<?php echo $active_section === 'personal' ? 'active' : ''; ?>" 
                onclick="showSection('personal')">Personal Data</button>
        <button class="<?php echo $active_section === 'contact' ? 'active' : ''; ?>" 
                onclick="showSection('contact')">Contact Information</button>
        <button class="<?php echo $active_section === 'security' ? 'active' : ''; ?>" 
                onclick="showSection('security')">Security</button>
    </div>

    <!-- Personal Data Section -->
    <div id="personal" class="settings-section <?php echo $active_section === 'personal' ? 'active' : ''; ?>">
        <form class="ajax-form" id="personalForm" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="current_image" value="<?php echo $user['image']; ?>">
            <div class="form-group">
                <img src="<?php echo getImageUrl($user['image']); ?>" alt="Profile" class="profile-image">
                <input type="file" name="image" accept="image/*">
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>

            <div class="form-group">
                <label for="birth_date">Date of Birth</label>
                <input type="date" id="birth_date" name="birth_date" value="<?php echo $user['birth_date']; ?>" required>
            </div>

            <div class="form-group">
                <label>Gender</label>
                <div class="gender-options">
                    <label class="gender-option">
                        <input type="radio" name="gender" value="m" <?php echo $user['gender'] === 'm' ? 'checked' : ''; ?>>
                        Male
                    </label>
                    <label class="gender-option">
                        <input type="radio" name="gender" value="f" <?php echo $user['gender'] === 'f' ? 'checked' : ''; ?>>
                        Female
                    </label>
                    <label class="gender-option">
                        <input type="radio" name="gender" value="o" <?php echo $user['gender'] === 'o' ? 'checked' : ''; ?>>
                        Other
                    </label>
                </div>
            </div>

            <button type="submit" name="update_personal" class="btn-save">Save Changes</button>
        </form>
    </div>

    <!-- Contact Information Section -->
    <div id="contact" class="settings-section <?php echo $active_section === 'contact' ? 'active' : ''; ?>">
        <form class="ajax-form" method="POST">
            <div class="form-group">
                <label for="address1">Address Line 1</label>
                <input type="text" id="address1" name="address1" value="<?php echo htmlspecialchars($address['address1'] ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label for="address2">Address Line 2</label>
                <input type="text" id="address2" name="address2" value="<?php echo htmlspecialchars($address['address2'] ?? ''); ?>">
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="city_id">City</label>
                        <select id="city_id" name="city_id" required>
                            <?php foreach ($cities as $city): ?>
                                <option value="<?php echo $city['id']; ?>" 
                                        <?php echo ($address['city_id'] ?? '') == $city['id'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($city['name_en']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="postal_code">Postal Code</label>
                        <input type="text" id="postal_code" name="postal_code" value="<?php echo htmlspecialchars($address['postal_code'] ?? ''); ?>" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="telephone1">Primary Phone</label>
                        <input type="tel" id="telephone1" name="telephone1" value="<?php echo htmlspecialchars($telephone['telephone1'] ?? ''); ?>" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="telephone2">Secondary Phone</label>
                        <input type="tel" id="telephone2" name="telephone2" value="<?php echo htmlspecialchars($telephone['telephone2'] ?? ''); ?>">
                    </div>
                </div>
            </div>

            <button type="submit" name="update_contact" class="btn-save">Save Changes</button>
        </form>
    </div>

    <!-- Security Section -->
    <div id="security" class="settings-section <?php echo $active_section === 'security' ? 'active' : ''; ?>">
        <form class="ajax-form" method="POST">
            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>

            <button type="submit" name="update_password" class="btn-save">Update Password</button>
        </form>
    </div>
</div>

<style>
    .profile-settings-container {
        max-width: 800px;
        margin: 1rem auto;
        padding: 1.5rem;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
        width: 95%;
    }

    .profile-settings-nav {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 2rem;
        border-bottom: 1px solid #eee;
        padding-bottom: 1rem;
        flex-wrap: wrap;
    }

    .profile-settings-nav button {
        padding: 0.5rem 1rem;
        border: none;
        background: none;
        color: #666;
        cursor: pointer;
        font-size: 1rem;
        position: relative;
        flex: 1;
        min-width: fit-content;
        text-align: center;
    }

    .profile-settings-nav button.active {
        color: #007bff;
        font-weight: 500;
    }

    .profile-settings-nav button.active::after {
        content: '';
        position: absolute;
        bottom: -1rem;
        left: 0;
        width: 100%;
        height: 2px;
        background: #007bff;
    }

    .profile-settings-container .settings-section {
        display: none;
    }

    .profile-settings-container .settings-section.active {
        display: block;
    }

    .profile-settings-container .form-group {
        margin-bottom: 1.5rem;
    }

    .profile-settings-container .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        color: #333;
        font-weight: 500;
    }

    .profile-settings-container .form-group input,
    .profile-settings-container .form-group select {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 1rem;
        box-sizing: border-box;
    }

    .profile-settings-container .profile-image {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 1rem;
    }

    .profile-settings-container .gender-options {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .profile-settings-container .gender-option {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .profile-settings-container .gender-option input[type="radio"] {
        width: auto;
    }

    .profile-settings-container .btn-save {
        background: #007bff;
        color: white;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1rem;
        transition: background 0.2s;
        width: 100%;
        max-width: 250px;
    }

    .profile-settings-container .btn-save:hover {
        background: #0056b3;
    }

    .profile-settings-container .row {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .profile-settings-container .col {
        flex: 1 1 250px;
    }

    /* Specific Select2 overrides */
    .profile-settings-container .select2-container {
        width: 100% !important;
    }
    
    .profile-settings-container .select2-container .select2-selection--single {
        height: 42px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }
    
    .profile-settings-container .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 42px;
    }
    
    .profile-settings-container .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 40px;
    }

    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }

    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
    }

    .alert-danger {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
    }
    
    /* Media Queries for Responsiveness */
    @media (max-width: 768px) {
        .profile-settings-container {
            padding: 1rem;
            margin: 1rem auto;
        }
        
        .profile-settings-container h1 {
            font-size: 1.5rem;
            text-align: center;
        }
        
        .profile-settings-nav {
            justify-content: center;
        }
        
        .profile-settings-nav button {
            padding: 0.5rem 0.75rem;
            font-size: 0.9rem;
        }
        
        .profile-settings-container .btn-save {
            width: 100%;
            max-width: none;
        }
    }
    
    @media (max-width: 480px) {
        .profile-settings-nav button {
            flex: 1 1 100%;
            margin-bottom: 0.5rem;
        }
        
        .profile-settings-nav button.active::after {
            bottom: -0.5rem;
        }
        
        .profile-settings-container .gender-options {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

<!-- Add meta viewport tag at top of head section -->
<script>
    // Add viewport meta tag if it doesn't exist
    if (!document.querySelector('meta[name="viewport"]')) {
        const meta = document.createElement('meta');
        meta.name = 'viewport';
        meta.content = 'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no';
        document.head.appendChild(meta);
    }
    
    function showSection(sectionId) {
        // Update URL with section parameter
        const url = new URL(window.location);
        url.searchParams.set('section', sectionId);
        window.history.pushState({}, '', url);
        
        // Hide all sections
        document.querySelectorAll('.settings-section').forEach(section => {
            section.classList.remove('active');
        });
        
        // Remove active class from all nav buttons
        document.querySelectorAll('.profile-settings-nav button').forEach(button => {
            button.classList.remove('active');
        });
        
        // Show selected section
        document.getElementById(sectionId).classList.add('active');
        
        // Add active class to clicked button
        event.target.classList.add('active');
    }

    // Initialize Select2 for city dropdown
    $(document).ready(function() {
        $('#city_id').select2();

        // Handle all form submissions with AJAX
        $('.ajax-form').on('submit', function(e) {
            e.preventDefault();
            
            const form = $(this);
            const formData = new FormData(this);
            const submitButton = form.find('button[type="submit"]');
            
            // Disable submit button while processing
            submitButton.prop('disabled', true);
            
            // Clear previous messages
            $('.alert-success, .alert-danger').hide();
            
            $.ajax({
                url: '/pages/handlers/profile_handler.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    try {
                        // If response is already parsed JSON
                        if (typeof response === 'object') {
                            handleResponse(response);
                        } else {
                            // Try to parse the response as JSON
                            const data = JSON.parse(response);
                            handleResponse(data);
                        }
                    } catch (e) {
                        // If parsing fails, show generic success (since we got a response)
                        $('.alert-success').text('Update completed').show();
                        // Reload after a delay to show the message
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    }
                },
                error: function() {
                    $('.alert-danger').text('An error occurred. Please try again.').show();
                },
                complete: function() {
                    // Re-enable submit button
                    submitButton.prop('disabled', false);
                }
            });
            
            function handleResponse(data) {
                if (data.success) {
                    // Show success message
                    $('.alert-success').text(data.message).show();
                    
                    // Update page content if needed
                    if (data.reload) {
                        setTimeout(() => {
                            // Always redirect to index.php?page=profile
                            window.location.replace('/index.php?page=profile');
                        }, 1000);
                    }
                } else {
                    $('.alert-danger').text(data.message || 'Update failed').show();
                }
            }
        });
    });
</script>