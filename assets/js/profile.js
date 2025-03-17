// JavaScript for Upload and Delete Image Functionality

document.addEventListener("DOMContentLoaded", function () {
    const profileImage = document.getElementById("profileImage");
    const uploadButton = document.getElementById("uploadButton");
    const deleteButton = document.getElementById("deleteButton");
    const uploadImage = document.getElementById("uploadImage");

    // Debugging: Check if elements are found
    console.log("Profile Image:", profileImage);
    console.log("Upload Button:", uploadButton);
    console.log("Delete Button:", deleteButton);
    console.log("Upload Image Input:", uploadImage);

    // Upload Image
    uploadButton.addEventListener("click", function () {
        console.log("Upload Button Clicked"); // Debugging
        uploadImage.click(); // Trigger file input
    });

    uploadImage.addEventListener("change", function (event) {
        console.log("File Input Changed"); // Debugging
        const file = event.target.files[0]; // Get the selected file
        if (file) {
            if (file.type.startsWith("image/")) { // Check if the file is an image
                const reader = new FileReader();
                reader.onload = function (e) {
                    console.log("File Read Successfully"); // Debugging
                    profileImage.src = e.target.result; // Set the uploaded image as profile image
                };
                reader.readAsDataURL(file); // Read the file as a data URL
            } else {
                alert("Please select a valid image file."); // Show an error if the file is not an image
            }
        }
    });

    // Delete Image
    deleteButton.addEventListener("click", function () {
        console.log("Delete Button Clicked"); // Debugging
        profileImage.src = "image.png"; // Reset to default image
        uploadImage.value = ""; // Clear file input
    });
});

// Form validation
document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector('.needs-validation');
    
    form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
    });

    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });
});