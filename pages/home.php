    <!-- Hero Section -->
    <section>
      <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="./assets/images/banner4.webp" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="./assets/images/banner4.webp"  alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="./assets/images/banner4.webp" alt="Third slide">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </section>

     <!-- Welcome Section -->
    <div class="header">
      <h1 class="header-text"><span class="black">Welcome to </span> <span class="red">Sola Chemicals</span></h1>
      <br>
      <div class="sub-header">
        We Provide <span class="sh1" data-words="Household,Car Care,Industrial"></span> Chemicals For your <span class="sh2" data-words="Home,Vehicles,Workshop"></span>
      </div> 

<script>
  //sub head animation
document.addEventListener("DOMContentLoaded", () => {
  const sh1 = document.querySelector(".sh1");
  const sh2 = document.querySelector(".sh2");

  const words1 = sh1.getAttribute("data-words").split(",");
  const words2 = sh2.getAttribute("data-words").split(",");

  let index = 0;

  const rotateWords = () => {
    // Update the text content of both spans
    sh1.textContent = words1[index];
    sh2.textContent = words2[index];

    // Increment index and loop back to the start
    index = (index + 1) % words1.length;
  };

  // Initial call to set the first word
  rotateWords();

  // Rotate words every 3 seconds
  setInterval(rotateWords, 2000);
});
  </script>

    <section class="py-5 text-center">
      <div class="container">
        <p class="mt-3">
          Sola Chemical Company: Sri Lanka's Trusted Cleaning Solutions Provider (Since 2010). We cater to all your cleaning needs, offering a comprehensive selection of household and commercial cleaning solutions.
        </p>

        <div class="row mt-5 text-center">
          <div class="col-md-4">
            <div class="d-flex flex-column align-items-center">
              <div class="circle"><img src="./assets/images/vision.webp" alt="Vision Icon" class="circle"></div>
              <h4 class="text-primary">Vision</h4>
            </div>
          </div>
          <div class="col-md-4">
            <div class="d-flex flex-column align-items-center">
              <div class="circle"><img src="./assets/images/Mission.webp" alt="Vision Icon" class="circle"></div>
              <h4 class="text-primary">Mission</h4>
            </div>
          </div>
          <div class="col-md-4">
            <div class="d-flex flex-column align-items-center">
              <div class="circle"><img src="./assets/images/service.webp" alt="Vision Icon" class="circle"></div>
              <h4 class="text-primary">Services</h4>
            </div>
          </div>
        </div>

        <div class="mt-5">
          <h3>Legacy of clean</h3>
          <p class="fs-5">
            Sola Chemicals: Making your home sparkle and your life easier! We offer high-quality cleaning chemicals, washing powders & liquids, air fresheners, hand washes, and dish wash.
          </p>
        </div>

        <!-- Stats Section -->
        <div class="row text-center mt-4">
          <div class="col-sm-3">
            <div class="stat-box">
              <h3 class="count" data-target="15">15</h3>
              <p>Years <br> of reliability</p>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="stat-box">
              <h3 class="count" data-target="99">99%</h3>
              <p>of products <br> manufactured locally</p>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="stat-box">
              <h3 class="count" data-target="25">+25</h3>
              <p>of outlets <br> island wide</p>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="stat-box">
              <h3 class="count" data-target="25000">+25000</h3>
              <p>retailer reach <br> island wide</p>
            </div>
          </div>
        </div>

        <div class="mt-5">
          <a href="/pages/findNeatByOutleat.php">
            <button class="btn btn-primary">Find a Nearby Outlet</button>
          </a>
        </div>
      </div>
    </section>
    
    <script>
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
        const duration = 1000; // Animation duration in milliseconds (reduced for faster animation)
        const increment = target / (duration / 25); // 25ms per frame for smooth animation

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
        } else {
          entry.target.textContent = target; // Set the target value without %
        }
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
        </script>

  <!-- Horizontal Scrolling Products Section -->
    <section id="products" class="py-5 bg-light">
      <div class="container">
        <h3 class="text-center mb-4">Our Products</h3>
        <div class="product-container d-flex gap-3 overflow-scroll">
          <!-- Individual Product Card -->
          <div class="card flex-shrink-0" style="width: 200px;">
            <img src="./assets/images/hp-products/42.webp" class="card-img-top" alt="Product">
          </div>
          <div class="card flex-shrink-0" style="width: 200px;">
              <img src="./assets/images/hp-products/43.webp" class="card-img-top" alt="Product">
          </div>
          <div class="card flex-shrink-0" style="width: 200px;">
              <img src="./assets/images/hp-products/44.webp" class="card-img-top" alt="Product">
          </div>
          <div class="card flex-shrink-0" style="width: 200px;">
              <img src="./assets/images/hp-products/45.webp" class="card-img-top" alt="Product">
          </div>
          <div class="card flex-shrink-0" style="width: 200px;">
              <img src="./assets/images/hp-products/46.webp" class="card-img-top" alt="Product">
          </div>
          <div class="card flex-shrink-0" style="width: 200px;">
            <img src="./assets/images/hp-products/47.webp" class="card-img-top" alt="Product">
          </div>
          <div class="card flex-shrink-0" style="width: 200px;">
            <img src="./assets/images/hp-products/48.webp" class="card-img-top" alt="Product">
          </div>
        </div>
      </div>
    </section>

    <!-- Why Use Sola Chemicals Section -->
    <section class="why-use-section py-5 bg-light">
      <div class="container">
        <h2 class="text-center mb-5">Why Choose Sola Chemicals?</h2>
        <div class="row text-center d-flex justify-content-center">
          <div class="col-sm-3">
            <div class="why-choose-item">
              <img src="./assets/images/Sustainable products.webp" alt="Sustainable Products">
              <h5>Sustainable Products</h5>
              <p>Explore our carefully curated selection of sustainable products, each designed to reduce your carbon footprint</p>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="why-choose-item">
              <img src="./assets/images/Eco-Friendly.webp" alt="Eco-Friendly Choices">
              <h5>Eco-Friendly Choices</h5>
              <p>Make conscious choices with our eco-friendly products, knowing that your purchases promote ethical sourcing and responsible manufacturing practices.</p>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="why-choose-item">
              <img src="./assets/images/High-quality.webp" alt="High-Quality Selection">
              <h5>High-Quality Selection</h5>
              <p>Invest in long-lasting and reliable products that meet our stringent quality standards, ensuring your satisfaction and the longevity of your purchases.</p>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="why-choose-item">
              <img src="./assets/images/Su-Packaging.webp" alt="Sustainable Packaging">
              <h5>Sustainable Packaging</h5>
              <p>Our sustainable packaging ensures that your orders arrive safely while minimizing their impact on the planet.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Reviews Section -->
    <section class="reviews-section py-5 bg-light">
      <div class="container">
        <h2 class="text-center mb-5">Customer Reviews</h2>
        <div class="row text-center">
          <!-- Review 1 -->
          <div class="col-sm-4">
            <div class="review-box p-4">
              <div class="review-author d-flex justify-content-center">
                <img src="./assets/images/customers/chamod.webp" alt="image of a customer" class="customer-image">
              </div>
              <div class="review-stars">
              <span class="star">★&nbsp;&nbsp;★&nbsp;&nbsp;★&nbsp;&nbsp;★&nbsp;&nbsp;★</span>
              </div>
              <p class="review-text">"Sola Chemicals provided excellent service. Highly recommend!"</p>
              <p class="review-author-name">Chamod Abeywickramage</p>
            </div>
          </div>
          <!-- Review 2 -->
          <div class="col-sm-4">
            <div class="review-box p-4">
              <div class="review-author d-flex justify-content-center">
                <img src="./assets/images/customers/chamal.webp" alt="image of a customer" class="customer-image">
              </div>
              <div class="review-stars">
              <span class="star">★&nbsp;&nbsp;★&nbsp;&nbsp;★&nbsp;&nbsp;★&nbsp;&nbsp;★</span>
              </div>
              <p class="review-text">"Great products that are both eco-friendly and affordable. Will purchase again!"</p>
              <p class="review-author-name">Chamal Jayawardana</p>
            </div>
          </div>
          <!-- Review 3 -->
          <div class="col-sm-4">
            <div class="review-box p-4">
              <div class="review-author d-flex justify-content-center">
                <img src="./assets/images/customers/mihiranga.webp" alt="image of a customer" class="customer-image">
              </div>
              <div class="review-stars">
                <span class="star">★&nbsp;&nbsp;★&nbsp;&nbsp;★&nbsp;&nbsp;★</span>
              </div>
              <p class="review-text">"Excellent quality, fast delivery, and great customer service. Very satisfied!"</p>
              <p class="review-author-name">Mihiranga Chathum</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Contact Section -->
    <section class="reviews-section py-5 bg-light">
      <div class="container mt-5">
          <div class="row">
              <!-- Left Section -->
              <div class="col-md-6">
                  <h1 class="h4">Let us know how we can help</h1>
                  <p>
                      We're here to help and answer any question you might have. We look forward to hearing from you! 
                      Please fill out the form or use the contact information below.
                  </p>
                  <div class="mt-4">
                      <p><i class="bi bi-envelope-fill me-2"></i>Email: solachemik@yahoo.com</p>
                      <p><i class="bi bi-telephone-fill me-2"></i>Phone: 0112401709, 0704995797</p>
                      <p><i class="bi bi-geo-alt-fill me-2"></i>Location: 576/2 C, Siyambalape Road, Heiyanthuduwa</p>
                  </div>
              </div>
              <!-- Right Section -->
              <div class="col-md-6">
                  <form id="contactForm">
                      <div class="mb-3">
                          <label for="fullName" class="form-label">Full Name</label>
                          <input type="text" class="form-control" id="fullName" placeholder="Your name" required>
                      </div>
                      <div class="mb-3">
                          <label for="email" class="form-label">Email</label>
                          <input type="email" class="form-control" id="email" placeholder="Your email" required>
                      </div>
                      <div class="mb-3">
                          <label for="company" class="form-label">Company</label>
                          <input type="text" class="form-control" id="company" placeholder="Your company">
                      </div>
                      <div class="mb-3">
                          <label for="message" class="form-label">Message</label>
                          <textarea class="form-control" id="message" rows="5" placeholder="Your message" required></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary w-100">Submit</button>
                  </form>
              </div>
          </div>
      </div>
    </section>