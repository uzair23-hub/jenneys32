<?php
include("includes/header.php");
include("includes/db.php");

// Start session
if (!isset($_SESSION)) {
    session_start();
}

// Initialize cart session if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle Add to Cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Check if product already exists in cart
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = $quantity;
    }
    echo "<script>alert('Product added to cart!'); window.location='cart.php';</script>";
}

// Handle Remove from Cart
if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    unset($_SESSION['cart'][$remove_id]);
    echo "<script>alert('Product removed from cart!'); window.location='cart.php';</script>";
}

// Handle Update Quantities
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_cart'])) {
    foreach ($_POST['quantities'] as $id => $qty) {
        if ($qty <= 0) {
            unset($_SESSION['cart'][$id]);
        } else {
            $_SESSION['cart'][$id] = $qty;
        }
    }
    echo "<script>alert('Cart updated successfully!'); window.location='cart.php';</script>";
}
?>

<div class="container my-5">
    <h2 class="fw-bold mb-4">Your Shopping Cart</h2>

    <?php if (!empty($_SESSION['cart'])) { ?>
        <form action="cart.php" method="POST">
            <table class="table table-bordered align-middle shadow">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Price (PKR)</th>
                        <th>Quantity</th>
                        <th>Subtotal (PKR)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php
                    $total = 0;
                    foreach ($_SESSION['cart'] as $product_id => $quantity) {
                        $query = "SELECT * FROM products WHERE id = '$product_id'";
                        $result = mysqli_query($conn, $query);
                        $product = mysqli_fetch_assoc($result);

                        $subtotal = $product['price'] * $quantity;
                        $total += $subtotal;
                    ?>
                        <tr>
                            <td>
                                <img src="uploads/<?php echo $product['image']; ?>" alt="<?= $product['name']; ?>" width="80" height="80" class="rounded">
                            </td>
                            <td><?= $product['name']; ?></td>
                            <td><?= number_format($product['price']); ?></td>
                            <td>
                                <input type="number" name="quantities[<?= $product_id; ?>]" value="<?= $quantity; ?>" min="1" class="form-control w-50 mx-auto">
                            </td>
                            <td><strong><?= number_format($subtotal); ?></strong></td>
                            <td>
                                <a href="cart.php?remove=<?= $product_id; ?>" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Remove
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <td colspan="4" class="text-end fw-bold">Total:</td>
                        <td colspan="2" class="fw-bold text-primary fs-5">PKR <?= number_format($total); ?></td>
                    </tr>
                </tfoot>
            </table>

            <!-- Update Cart Button -->
            <div class="d-flex justify-content-between">
                <button type="submit" name="update_cart" class="btn btn-dark">
                    <i class="bi bi-arrow-repeat"></i> Update Cart
                </button>
                <a href="checkout.php" class="btn btn-buy">
                    <i class="bi bi-bag-check"></i> Proceed to Checkout
                </a>
            </div>
        </form>
    <?php } else { ?>
        <div class="alert alert-info text-center shadow-sm">
            Your cart is empty. <a href="products.php" class="alert-link">Shop Now</a>
        </div>
    <?php } ?>
</div>

<?php include("includes/footer.php"); ?>
