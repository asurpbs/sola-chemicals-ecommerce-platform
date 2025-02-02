document.getElementById('signupForm').addEventListener('submit', function(event) {
  event.preventDefault();
  validateForm();
});

function validateForm() {
  let isValid = true;

  isValid = validateField('firstName', 'First Name is required') && isValid;
  isValid = validateField('lastName', 'Last Name is required') && isValid;
  isValid = validateField('gender', 'Gender is required') && isValid;
  isValid = validateField('image', 'Image is required') && isValid;
  isValid = validateEmail('email', 'Invalid email address') && isValid;
  isValid = validatePassword('password', 'Password is required') && isValid;
  isValid = validateConfirmPassword('confirmPassword', 'Passwords do not match') && isValid;
  isValid = validateField('address1', 'Address Line 1 is required') && isValid;
  isValid = validateField('postalCode', 'Postal Code is required') && isValid;
  isValid = validateField('city', 'City is required') && isValid;
  isValid = validateField('telephoneNum1', 'Telephone Number 1 is required') && isValid;

  if (isValid) {
      alert('Form submitted successfully!');
      // Here you can add code to submit the form data to a server
  }
}

function validateField(fieldId, errorMessage) {
  const field = document.getElementById(fieldId);
  const error = document.getElementById(fieldId + 'Error');
  if (!field.value.trim()) {
      error.textContent = errorMessage;
      error.style.display = 'block';
      return false;
  } else {
      error.style.display = 'none';
      return true;
  }
}

function validateEmail(fieldId, errorMessage) {
  const field = document.getElementById(fieldId);
  const error = document.getElementById(fieldId + 'Error');
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailPattern.test(field.value.trim())) {
      error.textContent = errorMessage;
      error.style.display = 'block';
      return false;
  } else {
      error.style.display = 'none';
      return true;
  }
}

function validatePassword(fieldId, errorMessage) {
  const field = document.getElementById(fieldId);
  const error = document.getElementById(fieldId + 'Error');
  if (field.value.trim().length < 6) {
      error.textContent = errorMessage;
      error.style.display = 'block';
      return false;
  } else {
      error.style.display = 'none';
      return true;
  }
}

function validateConfirmPassword(fieldId, errorMessage) {
  const field = document.getElementById(fieldId);
  const password = document.getElementById('password').value;
  const error = document.getElementById(fieldId + 'Error');
  if (field.value.trim() !== password) {
      error.textContent = errorMessage;
      error.style.display = 'block';
      return false;
  } else {
      error.style.display = 'none';
      return true;
  }
}