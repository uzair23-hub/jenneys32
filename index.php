<?php include("includes/header.php"); ?>

<style>
  .hero {
  background-image: url('photos/beauty-skincare-background-free-vector.jpg');
  background-size: cover;
  background-position: center;
  height: 100vh;
  padding: 120px 20px;
}

.hero h1 {
  font-size: 3rem;
  font-family: 'Poppins', sans-serif;
  font-weight: 700;
}
@media (max-width: 900px) {
  .hero h1 {
    font-size: 2.2rem;
  }
}
@media (max-width: 600px) {
  .hero h1 {
    font-size: 1.5rem;
  }
}
</style>

<!-- Hero Section -->
<section class="hero">
  <div class="container text-center text-white">
    <h1 class="fw-bold">Welcome to Jenny's Cosmetics & Jewelry</h1>
    <p>Discover premium cosmetics & imitation jewelry at unbeatable prices!</p>
    <a href="products.php" class="btn btn-shop" style="color: #473068;  font-size: 1.2rem;">Shop Now</a>
  </div>
</section>

<!-- Categories Section -->
<section class="categories py-5">
  <div class="container">
    <h2 class="text-center mb-4">Shop by Categories</h2>
    
<div class="row g-4">
  <div class="col-md-3">
    <a href="products.php?category=1" style="text-decoration:none;">
      <div class="category-card">
        <img src="./photos/makeup.jpg" alt="Makeup" />
        <h5>Makeup</h5>
      </div>
    </a>
  </div>
  <div class="col-md-3">
    <a href="products.php?category=2" style="text-decoration:none;">
      <div class="category-card">
        <img src="./photos/skincare.jpg" alt="Skincare" />
        <h5>Skincare</h5>
      </div>
    </a>
  </div>
  <div class="col-md-3">
    <a href="products.php?category=3" style="text-decoration:none;">
      <div class="category-card">
        <img src="./photos/jewelary.jpg" alt="Jewelry" />
        <h5>Jewelry</h5>
      </div>
    </a>
  </div>
  <div class="col-md-3">
    <a href="products.php?category=4" style="text-decoration:none;">
      <div class="category-card">
        <img src="./photos/perfume.jpg" alt="Perfume" />
        <h5>Perfumes</h5>
      </div>
    </a>
  </div>
</div>
  </div>
</section>



<!-- Featured Products -->
<section class="featured-products py-5">
  <div class="container">
    <h2 class="text-center mb-4">Featured Products</h2>
    <div class="row g-4">
      <!-- Product Card -->
      <div class="col-md-3">
        <a href="product_detail.php?id=11" style="text-decoration:none;">
          <div class="product-card">
            <img src="./photos/lipstick img11.jpeg" alt="Matte Lipstick">
            <h5>Nude Lipstick</h5>
            <p class="price">PKR 1,700</p>
            <span class="btn btn-buy">View Details</span>
          </div>
        </a>
      </div>
      <div class="col-md-3">
        <a href="product_detail.php?id=34" style="text-decoration:none;">
          <div class="product-card">
            <img src="./photos/powder img1.jpeg" alt="Flawless Foundation">
            <h5>Face Powder</h5>
            <p class="price">PKR 5,000</p>
            <span class="btn btn-buy">View Details</span>
          </div>
        </a>
      </div>
      <div class="col-md-3">
        <a href="product_detail.php?id=25" style="text-decoration:none;">
          <div class="product-card">
            <img src="./photos/jewellery img15.jpeg" alt="Gold Plated Rings">
            <h5>Rings Set</h5>
            <p class="price">PKR 1,500</p>
            <span class="btn btn-buy">View Details</span>
          </div>
        </a>
      </div>
      <div class="col-md-3">
        <a href="product_detail.php?id=19" style="text-decoration:none;">
          <div class="product-card">
            <img src="./photos/perfume img7.jpg" alt="Diamond Earrings">
            <h5>Femme Perfumes</h5>
            <p class="price">PKR 5,000</p>
            <span class="btn btn-buy">View Details</span>
          </div>
        </a>
      </div>
    </div>
  </div>
</section>

<?php include("includes/footer.php"); ?>
