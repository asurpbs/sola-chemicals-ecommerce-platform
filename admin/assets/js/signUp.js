// Add event listener for the form submission
document.getElementById("signupForm").addEventListener("submit", function (e) {
    e.preventDefault(); // Prevent default form submission
  
    // Get the values of the password and confirm password fields
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirmPassword").value;
  
    // Check if passwords match
    if (password !== confirmPassword) {
      alert("Passwords do not match!"); // Show an alert if passwords don't match
      return; // Stop further execution
    }
  
    // Show success message
    alert("Sign-up successful!");
  });
  