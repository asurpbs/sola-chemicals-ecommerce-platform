<?php
include $_SERVER['DOCUMENT_ROOT'] . "/classes/company.php";
global $company;
$company = new Company();
?>
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
              <div class="circle" data-bs-toggle="modal" data-bs-target="#visionModal"><img src="./assets/images/vision.webp" alt="Vision Icon" class="circle"></div>
              <h4 class="text-primary">Vision</h4>
            </div>
          </div>
          <div class="col-md-4">
            <div class="d-flex flex-column align-items-center">
              <div class="circle" data-bs-toggle="modal" data-bs-target="#missionModal"><img src="./assets/images/Mission.webp" alt="Mission Icon" class="circle"></div>
              <h4 class="text-primary">Mission</h4>
            </div>
          </div>
          <div class="col-md-4">
            <div class="d-flex flex-column align-items-center">
              <div class="circle" data-bs-toggle="modal" data-bs-target="#servicesModal"><img src="./assets/images/service.webp" alt="Services Icon" class="circle"></div>
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

        <!-- Modals -->
        <div class="modal fade" id="visionModal" tabindex="-1" aria-labelledby="visionModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="visionModalLabel">Our Vision</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                To be the leading provider of eco-friendly and effective cleaning solutions in Sri Lanka, making cleanliness accessible to all while maintaining environmental responsibility. We aim to revolutionize the cleaning industry by introducing innovative products that maintain high standards of quality while reducing environmental impact.
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="missionModal" tabindex="-1" aria-labelledby="missionModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="missionModalLabel">Our Mission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
              To develop and deliver high-quality, sustainable cleaning products that meet diverse household and commercial needs while prioritizing customer satisfaction, environmental stewardship, and community well-being. We are committed to continuous innovation, ensuring our products effectively solve cleaning challenges while being safe for users and the environment.
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="servicesModal" tabindex="-1" aria-labelledby="servicesModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
          <h5 class="modal-title" id="servicesModalLabel">Our Services</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body text-start">
              <ul>
          <li><strong>Custom Formulation:</strong>Tailored cleaning solutions for specific needs or industries.</li>
          <li><strong>Bulk Supply:</strong> Cost-effective options for businesses, hotels, and institutions.</li>
          <li><strong>Industrial Solutions:</strong> Specialized cleaning products for workshops, factories, and commercial spaces.</li>
          <li><strong>Product Consultation:</strong> Expert advice on selecting the right cleaning products for your needs.</li>
          <li><strong>Distribution Network:</strong> Island-wide product availability through our extensive retailer network.</li>
          <li><strong>Eco-friendly Alternatives:</strong> Green cleaning solutions for environmentally conscious customers.</li>
        </ul>`
              </div>
              <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
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
        <div class="product-container d-flex gap-3 overflow-scroll">
          <?php
            require_once $_SERVER['DOCUMENT_ROOT']."/context/connect.php";
            global $conn;

            // Get 7 random items using PDO
            $sql = "SELECT id, name, image FROM item ORDER BY RAND() LIMIT 7";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0) {
              while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $image = !empty($row['image']) ? "./uploads/product/{$row['image']}" : "./assets/images/hp-products/default.webp";
                echo '
                <div class="card flex-shrink-0" style="width: 200px;">
                  <a href="index.php?page=ProductOverview&id=' . $row['id'] . '">
                    <img src="' . $image . '" class="card-img-top" alt="' . $row['name'] . '" loading="lazy" >
                  </a>
                </div>';
              }
            }
          ?>
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
        <div id="formAlert"></div>
        <div class="row">
            <!-- Left Section remains the same -->
            <?php
            
            require_once $_SERVER['DOCUMENT_ROOT']."/context/connect.php";
            global $conn;
            if(isset($_POST['submit'])) {
                try {
                    $stmt = $conn->prepare("INSERT INTO public_contact (name, email, message) VALUES (?, ?, ?)");
                    $stmt->execute([$_POST['name'], $_POST['email'], $_POST['message']]);
                    echo "<div class='alert alert-success'>Thank you! Your message has been sent successfully.</div>";
                } catch(PDOException $e) {
                    echo "<div class='alert alert-danger'>Sorry, there was an error sending your message. Please try again.</div>";
                }
            }
            ?>
              <div class="row">
                  <!-- Left Section -->
                  <div class="col-md-6">
                      <h1 class="h4">Let us know how we can help</h1>
                      <p>
                          We're here to help and answer any question you might have. We look forward to hearing from you! 
                          Please fill out the form or use the contact information below.
                      </p>
                      <div class="mt-4">
                        <p><i class="bi bi-envelope-fill me-2"></i>Email: <?php echo $company->getEmail(); ?></p>
                        <p><i class="bi bi-telephone-fill me-2"></i>Phone: <?php echo $company->getTeleNumber1(); if (!empty($company->getTeleNumber2())) { echo ', '.$company->getTeleNumber2();} ?></p>
                        <p><i class="bi bi-geo-alt-fill me-2"></i>Location: <?php echo $company->getAddress1(); if (!empty($company->getAddress2())) { echo ', '.$company->getAddress2(); echo ', ',$company->getCity();} ?></p>
                    </div>
                  </div>

                  <!-- Right Section -->
                  <div class="col-md-6">
                    <form id="contactForm" method="POST">
                        <div class="mb-3">
                            <label for="fullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullName" name="name" placeholder="Your name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Your email" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Your message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                    </form>
                </div>
              </div>
          </div>
      </div>
    </section>

    <script>
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            formData.append('submit', '1');

            fetch(window.location.href, {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(html => {
                // Show alert message
                document.getElementById('formAlert').innerHTML = 
                    '<div class="alert alert-success">Thank you! Your message has been sent successfully.</div>';
                
                // Clear form
                document.getElementById('contactForm').reset();
                
                // Remove alert after 5 seconds
                setTimeout(() => {
                    document.getElementById('formAlert').innerHTML = '';
                }, 5000);
            })
            .catch(error => {
                document.getElementById('formAlert').innerHTML = 
                    '<div class="alert alert-danger">Sorry, there was an error sending your message. Please try again.</div>';
            });
        });
    </script>
</section>

