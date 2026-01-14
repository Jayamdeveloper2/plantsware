@include('view.layout.header')


<div class="sp_header bg-white p-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="list-unstyled mb-0">
                    <li class="d-inline-block font-weight-bolder"><a href="{{ url('/') }}" class="text-decoration-none">home</a></li>
                    <li class="d-inline-block font-weight-bolder mx-2">/</li>
                    <li class="d-inline-block font-weight-bolder"><a href="#" class="text-decoration-none">Product</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>


<div class="profile-container">
    <div class="container">
        <div class="profile-content">
            <!-- Sidebar -->
            <div class="profile-sidebar">
                <div class="user-info">
                    <div class="user-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        <div class="user-name">Gopinath JWS</div>
                        <div class="user-email">gopinath.jws@gmail.com</div>
                    </div>
                </div>

                <ul class="nav-menu">

                    <li class="nav-item">
                        <a href="#" class="nav-link active" data-tab="address-book">
                            <i class="fas fa-map-marker-alt nav-icon"></i>
                            <span>Address Book</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-tab="order-history">
                            <i class="fas fa-box nav-icon"></i>
                            <span>Order History</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-tab="wishlist">
                            <i class="fas fa-heart nav-icon"></i>
                            <span>Wishlist</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-tab="settings">
                            <i class="fas fa-cog nav-icon"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                    <li class="nav-item" style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #e0e0e0;">
                        <a href="#" class="nav-link">
                            <i class="fas fa-sign-out-alt nav-icon"></i>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="main-content">

                <!-- Address Book Section -->
                <div class="content-section active" id="address-book">
                    <h2 class="section-title">Address Book</h2>

                    <div class="tab-container">
                        <div class="tab-label active" onclick="toggleAddressForm()">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Saved Addresses</span>
                        </div>
                        <div class="tab-label" onclick="toggleAddressForm()">
                            <i class="fas fa-plus-circle"></i>
                            <span>Add New Address</span>
                        </div>
                    </div>

                    <!-- Saved Addresses -->
                    <div id="saved-addresses" class="address-cards">
                        <div class="address-card default">
                            <span class="address-badge">DEFAULT</span>
                            <div class="address-name">Home</div>
                            <div class="address-detail">123 Green Street</div>
                            <div class="address-detail">Garden Lane, New Delhi 110001</div>
                            <div class="address-detail">Delhi, India</div>
                            <div class="address-phone">📱 +91 9876543210</div>
                            <div class="address-actions">
                                <button class="address-btn address-btn-edit">Edit</button>
                                <button class="address-btn address-btn-delete">Delete</button>
                            </div>
                        </div>

                        <div class="address-card">
                            <div class="address-name">Office</div>
                            <div class="address-detail">456 Business Plaza</div>
                            <div class="address-detail">Tech Park, Bangalore 560001</div>
                            <div class="address-detail">Karnataka, India</div>
                            <div class="address-phone">📱 +91 9876543211</div>
                            <div class="address-actions">
                                <button class="address-btn address-btn-edit">Edit</button>
                                <button class="address-btn address-btn-delete">Delete</button>
                            </div>
                        </div>
                    </div>

                    <!-- Add New Address Form -->
                    <div id="new-address-form" style="display: none;">
                        <h3 style="margin-bottom: 1.5rem; color: var(--dark-color); font-weight: 600;">Add New Address</h3>
                        <form>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">First Name *</label>
                                    <input type="text" class="form-control" placeholder="Enter your first name">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Last Name *</label>
                                    <input type="text" class="form-control" placeholder="Enter your last name">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Door Number</label>
                                    <input type="text" class="form-control" placeholder="Door/Block No.">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Street</label>
                                    <input type="text" class="form-control" placeholder="Street Name">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">District</label>
                                    <input type="text" class="form-control" placeholder="District">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">State</label>
                                    <select class="form-select">
                                        <option>Select a State</option>
                                        <option>Delhi</option>
                                        <option>Karnataka</option>
                                        <option>Maharashtra</option>
                                        <option>Tamil Nadu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">City *</label>
                                    <input type="text" class="form-control" placeholder="City">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Post Code</label>
                                    <input type="text" class="form-control" placeholder="Post Code" maxlength="6">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Phone Number *</label>
                                    <input type="tel" class="form-control" placeholder="Phone Number" maxlength="10">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Alternative Number</label>
                                    <input type="tel" class="form-control" placeholder="Alternative Number" maxlength="10">
                                </div>
                            </div>
                            <div class="form-row">
                                <button type="button" class="btn-primary">Add Address</button>
                                <button type="button" class="btn-secondary" onclick="toggleAddressForm()">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Order History Section -->
                <div class="content-section" id="order-history">
                    <h2 class="section-title">Order History</h2>
                    <div class="order-items">
                        <div class="order-item">
                            <div class="order-image">
                                <i class="fas fa-leaf" style="font-size: 2rem; color: var(--primary-color);"></i>
                            </div>
                            <div class="order-info">
                                <h4>Monstera Deliciosa Plant</h4>
                                <p>Order ID: #123456</p>
                                <span class="order-status delivered">Delivered</span>
                            </div>
                            <div class="order-price">₹1,299</div>
                        </div>

                        <div class="order-item">
                            <div class="order-image">
                                <i class="fas fa-leaf" style="font-size: 2rem; color: var(--secondary-color);"></i>
                            </div>
                            <div class="order-info">
                                <h4>Snake Plant - Indoor Green</h4>
                                <p>Order ID: #123457</p>
                                <span class="order-status pending">In Transit</span>
                            </div>
                            <div class="order-price">₹899</div>
                        </div>

                        <div class="order-item">
                            <div class="order-image">
                                <i class="fas fa-leaf" style="font-size: 2rem; color: var(--accent-color);"></i>
                            </div>
                            <div class="order-info">
                                <h4>Pothos Ivy Climbing Plant</h4>
                                <p>Order ID: #123458</p>
                                <span class="order-status delivered">Delivered</span>
                            </div>
                            <div class="order-price">₹599</div>
                        </div>
                    </div>
                </div>

                <!-- Wishlist Section -->
                <div class="content-section" id="wishlist">
                    <h2 class="section-title">Wishlist</h2>
                    <div class="wishlist-grid">
                        <div class="product-card">
                            <div class="product-image">
                                <i class="fas fa-leaf" style="font-size: 3rem; color: var(--primary-color); opacity: 0.3;"></i>
                                <button class="wishlist-remove" title="Remove from wishlist">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            <div class="product-info">
                                <div class="product-name">Monstera Plant</div>
                                <div class="product-price">₹1,299</div>
                                <div class="product-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                    (248)
                                </div>
                                <button class="add-to-cart-btn">Add to Cart</button>
                            </div>
                        </div>

                        <div class="product-card">
                            <div class="product-image">
                                <i class="fas fa-leaf" style="font-size: 3rem; color: var(--secondary-color); opacity: 0.3;"></i>
                                <button class="wishlist-remove" title="Remove from wishlist">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            <div class="product-info">
                                <div class="product-name">Snake Plant</div>
                                <div class="product-price">₹899</div>
                                <div class="product-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    (156)
                                </div>
                                <button class="add-to-cart-btn">Add to Cart</button>
                            </div>
                        </div>

                        <div class="product-card">
                            <div class="product-image">
                                <i class="fas fa-leaf" style="font-size: 3rem; color: var(--accent-color); opacity: 0.3;"></i>
                                <button class="wishlist-remove" title="Remove from wishlist">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            <div class="product-info">
                                <div class="product-name">Pothos Ivy</div>
                                <div class="product-price">₹599</div>
                                <div class="product-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                    (312)
                                </div>
                                <button class="add-to-cart-btn">Add to Cart</button>
                            </div>
                        </div>

                        <div class="product-card">
                            <div class="product-image">
                                <i class="fas fa-leaf" style="font-size: 3rem; color: var(--primary-color); opacity: 0.3;"></i>
                                <button class="wishlist-remove" title="Remove from wishlist">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            <div class="product-info">
                                <div class="product-name">Fern Plant</div>
                                <div class="product-price">₹749</div>
                                <div class="product-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    (89)
                                </div>
                                <button class="add-to-cart-btn">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Settings Section -->
                <div class="content-section" id="settings">
                    <h2 class="section-title">Settings</h2>
                    <form>
                        <h3 style="margin: 2rem 0 1.5rem 0; color: var(--dark-color); font-weight: 600;">Security</h3>
                        <div class="form-group">
                            <label class="form-label">Change Password</label>
                            <button type="button" class="btn-primary">Update Password</button>
                        </div>

                        <h3 style="margin: 2rem 0 1.5rem 0; color: var(--dark-color); font-weight: 600;">Account</h3>
                        <div class="form-group">
                            <label class="form-label">Delete Account</label>
                            <p style="color: #888; margin-bottom: 1rem; font-size: 0.9rem;">Once deleted, this action cannot be undone.</p>
                            <button type="button" class="btn-secondary">Delete Account</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    // Tab Navigation
    document.querySelectorAll('[data-tab]').forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();

            // Remove active class from all links and sections
            document.querySelectorAll('[data-tab]').forEach(l => l.classList.remove('active'));
            document.querySelectorAll('.content-section').forEach(s => s.classList.remove('active'));

            // Add active class to clicked link and corresponding section
            link.classList.add('active');
            const tabId = link.getAttribute('data-tab');
            document.getElementById(tabId).classList.add('active');
        });
    });

    // Toggle Address Form
    function toggleAddressForm() {
        const savedAddresses = document.getElementById('saved-addresses');
        const newAddressForm = document.getElementById('new-address-form');

        if (newAddressForm.style.display === 'none') {
            savedAddresses.style.display = 'none';
            newAddressForm.style.display = 'block';
            document.querySelectorAll('.tab-label').forEach((label, index) => {
                if (index === 1) label.classList.add('active');
                else label.classList.remove('active');
            });
        } else {
            savedAddresses.style.display = 'grid';
            newAddressForm.style.display = 'none';
            document.querySelectorAll('.tab-label').forEach((label, index) => {
                if (index === 0) label.classList.add('active');
                else label.classList.remove('active');
            });
        }
    }

    // Wishlist Remove
    document.querySelectorAll('.wishlist-remove').forEach(btn => {
        btn.addEventListener('click', () => {
            btn.closest('.product-card').remove();
        });
    });

    // Add to Cart
    document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            alert('Product added to cart!');
        });
    });
</script>

@include('view.layout.footer')