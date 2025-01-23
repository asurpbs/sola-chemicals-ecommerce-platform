const productContainer = document.querySelector('.product-container');

let isDown = false;
let startX;
let scrollLeft;

productContainer.addEventListener('mousedown', (e) => {
  isDown = true;
  productContainer.classList.add('active');
  startX = e.pageX - productContainer.offsetLeft;
  scrollLeft = productContainer.scrollLeft;
});

productContainer.addEventListener('mouseleave', () => {
  isDown = false;
  productContainer.classList.remove('active');
});

productContainer.addEventListener('mouseup', () => {
  isDown = false;
  productContainer.classList.remove('active');
});

productContainer.addEventListener('mousemove', (e) => {
  if (!isDown) return;
  e.preventDefault();
  const x = e.pageX - productContainer.offsetLeft;
  const walk = (x - startX) * 2; // Scroll speed
  productContainer.scrollLeft = scrollLeft - walk;
});

// Handle form submission
document.getElementById('contactForm').addEventListener('submit', function (e) {
  e.preventDefault();

  // Get form values
  const fullName = document.getElementById('fullName').value;
  const email = document.getElementById('email').value;
  const company = document.getElementById('company').value;
  const message = document.getElementById('message').value;

  // Display a confirmation (or process data as needed)
  alert(`Thank you, ${fullName}! Your message has been received.`);
  
  // Optionally reset the form
  e.target.reset();
});

// Example JS for future interactivity (optional)
// Log a message when the button is clicked
document.querySelector('.btn').addEventListener('click', function () {
  console.log('Back to home button clicked!');
});

