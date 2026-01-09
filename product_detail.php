<?php
include("includes/header.php");
include("includes/db.php");

// Get product ID from URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Fetch product details
    $query = "SELECT * FROM products WHERE id = '$product_id'";
    $result = mysqli_query($conn, $query);

    // If product not found, redirect to products page
    if (mysqli_num_rows($result) == 0) {
        echo "<script>alert('Product not found!'); window.location='products.php';</script>";
        exit();
    }

    $product = mysqli_fetch_assoc($result);
} else {
    echo "<script>alert('Invalid request!'); window.location='products.php';</script>";
    exit();
}
?>

<div class="container my-5">
    <div class="row">
        <!-- Product Image -->
        <div class="col-md-6">
            <img src="uploads/<?php echo $product['image']; ?>" alt="<?= $product['name']; ?>" class="img-fluid rounded shadow">
        </div>

        <!-- Product Details -->
        <div class="col-md-6">
            <h2 class="fw-bold"><?php echo $product['name']; ?></h2>
            <p class="text-muted"><?php echo $product['description']; ?></p>
            <h4 class="text-primary fw-bold">PKR <?php echo number_format($product['price']); ?></h4>
            <p><strong>Stock:</strong> <?php echo $product['stock'] > 0 ? $product['stock'] . ' Available' : 'Out of Stock'; ?></p>

            <!-- Add to Cart Form -->
            <?php if ($product['stock'] > 0) { ?>
                <form action="cart.php" method="POST" class="mt-3">
                    <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                    <div class="mb-3">
                        <label for="quantity" class="form-label fw-bold">Quantity:</label>
                        <input type="number" name="quantity" id="quantity" value="1" min="1" max="<?= $product['stock']; ?>" class="form-control w-25" required>
                    </div>
                    <button type="submit" class="btn btn-buy">
                        <i class="bi bi-cart-plus"></i> Add to Cart
                    </button>
                </form>
            <?php } else { ?>
                <button class="btn btn-secondary" disabled>Out of Stock</button>
            <?php } ?>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>
