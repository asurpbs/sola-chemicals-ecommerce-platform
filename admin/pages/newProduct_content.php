<div class="container mt-5 pt-5">
    <div class="row">
        <div class="col-md-3 border-end">
            <h5 class="mb-3">Basic Settings</h5>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="#" class="nav-link active" onclick="showSection('productDetails')">Product Details</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="showSection('imagesAndVideos')">Images and Videos</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="showSection('seo')">Search Engine Optimization</a>
                </li>
            </ul>
            <h6 class="mt-4">Advanced Settings</h6>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="showSection('advancedSettings')">Product visibility</a>
                </li>
            </ul>
        </div>

        <div class="col-md-9">
            <form>
                <!-- Product Details -->
                <div id="productDetails" class="section">
                    <h4 class="mb-4">Product Details</h4>
                    <div class="mb-3">
                        <label for="productName" class="form-label">Name *</label>
                        <input type="text" class="form-control" id="productName" placeholder="Enter product name" required>
                    </div>
                    <div class="mb-3">
                        <label for="sku" class="form-label">SKU *</label>
                        <input type="text" class="form-control" id="sku" placeholder="Enter SKU" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price *</label>
                        <div class="input-group">
                            <span class="input-group-text">Rs</span>
                            <input type="number" class="form-control" id="price" placeholder="Enter price" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="taxClass" class="form-label">Tax Class</label>
                        <select class="form-select" id="taxClass" required>
                            <option disabled selected>Select Tax Class</option>
                            <option>Taxable Goods</option>
                            <option>Non-Taxable Goods</option>
                        </select>
                    </div>

                    <!-- Quantity Field -->
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="quantity" placeholder="Enter quantity" required>
                    </div>

                    <!-- Categories Field -->
                    <div class="mb-3">
                        <label for="categories" class="form-label">Categories</label>
                        <input type="text" class="form-control" id="categories" list="categoryOptions" placeholder="Start typing to search categories">
                        <datalist id="categoryOptions">
                            <option value="Electronics">
                            <option value="Clothing">
                            <option value="Books">
                        </datalist>
                        <button type="button" class="btn btn-secondary mt-2" onclick="addNewCategory()">Add New Category</button>
                    </div>

                    <!-- Description Field -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" rows="4" placeholder="Enter product description" required></textarea>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-primary" onclick="nextSection('imagesAndVideos')">Next</button>
                    </div>
                </div>

                <!-- Images and Videos -->
                <div id="imagesAndVideos" class="section" style="display:none;">
                    <h4 class="mt-4 mb-4">Images and Videos</h4>
                    <div class="mb-3">
                        <label for="images" class="form-label">Images and Videos</label>
                        <div class="border p-3 text-center" tabindex="0" aria-label="Upload Images and Videos">
                            <p>Click here or drag and drop to add images.</p>
                            <button type="button" class="btn btn-primary">Add Video</button>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" onclick="previousSection('productDetails')">Back</button>
                        <button type="button" class="btn btn-primary" onclick="nextSection('seo')">Next</button>
                    </div>
                </div>

                <!-- Search Engine Optimization -->
                <div id="seo" class="section" style="display:none;">
                    <h4 class="mt-4 mb-4">Search Engine Optimization</h4>
                    <div class="mb-3">
                        <label for="seoTitle" class="form-label">SEO Title</label>
                        <input type="text" class="form-control" id="seoTitle" placeholder="Enter SEO title">
                    </div>
                    <div class="mb-3">
                        <label for="seoDescription" class="form-label">SEO Description</label>
                        <textarea class="form-control" id="seoDescription" rows="3" placeholder="Enter SEO description"></textarea>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" onclick="previousSection('imagesAndVideos')">Back</button>
                        <button type="button" class="btn btn-primary" onclick="nextSection('advancedSettings')">Next</button>
                    </div>
                </div>

                <!-- Advanced Settings -->
                <div id="advancedSettings" class="section" style="display:none;">
                    <h4 class="mt-4 mb-4">Product visibility</h4>
                    <div class="mb-3">
                        <label for="advancedOption" class="form-label">Product visibility</label>
                        <select class="form-select" id="advancedOption">
                            <option selected>On</option>
                            <option>Off</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" onclick="previousSection('seo')">Back</button>
                        <button type="submit" class="btn btn-success">Finally Save</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Function to toggle visibility of sections
    function showSection(sectionId) {
        const sections = document.querySelectorAll('.section');
        sections.forEach(section => {
            section.style.display = 'none';
        });
        document.getElementById(sectionId).style.display = 'block';

        const links = document.querySelectorAll('.nav-link');
        links.forEach(link => {
            link.classList.remove('active');
        });
        const activeLink = document.querySelector(`a[onclick="showSection('${sectionId}')"]`);
        activeLink.classList.add('active');
    }

    // Show the Product Details section by default
    showSection('productDetails');

    // Add new category function
    function addNewCategory() {
        const newCategory = prompt("Enter the new category name:");
        if (newCategory) {
            const categoryOptions = document.getElementById('categoryOptions');
            const newOption = document.createElement('option');
            newOption.value = newCategory;
            categoryOptions.appendChild(newOption);
        }
    }

    // Function to navigate to next section
    function nextSection(sectionId) {
        showSection(sectionId);
    }

    // Function to navigate to previous section
    function previousSection(sectionId) {
        showSection(sectionId);
    }
</script>
