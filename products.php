<?php
include("includes/header.php");
include("includes/db.php");

// Fetch categories
$categories_query = "SELECT * FROM categories";
$categories_result = mysqli_query($conn, $categories_query);

// Fetch products based on selected category

$category_filter = isset($_GET['category']) ? $_GET['category'] : '';
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

if ($search) {
    $products_query = "SELECT * FROM products WHERE name LIKE '%$search%'";
    if ($category_filter) {
        $products_query .= " AND category_id = '$category_filter'";
    }
} else if ($category_filter) {
    $products_query = "SELECT * FROM products WHERE category_id = '$category_filter'";
} else {
    $products_query = "SELECT * FROM products";
}
$products_result = mysqli_query($conn, $products_query);
?>

<div class="container my-5">
    <div class="row">
        <!-- Sidebar Categories -->
        <div class="col-md-3">
            <div class="card shadow-sm p-3 mb-4">
                <h5 class="fw-bold">Categories</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <a href="products.php" class="text-decoration-none">All Products</a>
                    </li>
                    <?php while($cat = mysqli_fetch_assoc($categories_result)) { ?>
                        <li class="list-group-item">
                            <a href="products.php?category=<?= $cat['id'] ?>" class="text-decoration-none">
                                <?= $cat['name'] ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>

        <!-- Product Grid -->
        <div class="col-md-9">
            <div class="mb-4">
    <form method="GET" action="products.php" class="d-flex">
        <input type="text" name="search" class="form-control me-2" placeholder="Search products..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
        <button type="submit" class="btn btn-pink">Search</button>
    </form>
</div>
         

            <h3 class="fw-bold mb-4">Our Products</h3>
            <div class="row g-4">
                <?php if(mysqli_num_rows($products_result) > 0) { 
                    while($product = mysqli_fetch_assoc($products_result)) { ?>
                        <div class="col-md-4">
                            <div class="product-card">
                               <img src="./uploads/<?php echo $product['image']; ?>" >
                                <h5><?= $product['name']; ?></h5>
                                <p class="price">PKR <?= number_format($product['price']); ?></p>
                                <a href="product_detail.php?id=<?= $product['id']; ?>" class="btn btn-buy">View Details</a>
                                <form action="cart.php" method="POST" class="mt-2">
                                    <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-add-cart">
                                        <i class="bi bi-cart-plus"></i> Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                <?php } } else { ?>
                    <p class="text-center">No products available in this category.</p>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>
