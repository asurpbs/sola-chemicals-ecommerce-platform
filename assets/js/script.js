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

// stat-box animation
document.addEventListener("DOMContentLoaded", () => {
  const counters = document.querySelectorAll(".count");

  const options = {
    threshold: 0.5, // Trigger when 50% of the element is visible
  };

  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        const target = +entry.target.getAttribute("data-target");
        const duration = 2000; // Animation duration in milliseconds
        const increment = target / (duration / 16); // 16ms per frame for smooth animation

        let current = 0;
        const updateCounter = () => {
          current += increment;
          if (current < target) {
            entry.target.textContent = Math.ceil(current);
            requestAnimationFrame(updateCounter);
          } else {
            // Ensure the final value is set correctly
            entry.target.textContent = target;

            // Add % or + symbol based on the target value
            if (target === 99) {
              entry.target.textContent = target + "%"; // Append % for 99
            } else if (target === 25 || target === 25000) {
              entry.target.textContent = "+" + target; // Prepend + for 25 and 25000
            }

            observer.unobserve(entry.target); // Stop observing after animation
          }
        };

        updateCounter();
      }
    });
  }, options);

  counters.forEach((counter) => {
    observer.observe(counter);
  });
});