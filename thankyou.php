<?php include("includes/header.php"); ?>

<div class="container my-5 text-center">
    <div class="card shadow p-5">
        <h2 class="fw-bold text-success mb-3">🎉 Thank You!</h2>
        <p>Your order has been placed successfully.</p>
        <?php if (isset($_GET['order_id'])) { ?>
            <p><strong>Your Order ID:</strong> <?= $_GET['order_id']; ?></p>
        <?php } ?>
        <a href="products.php" class="btn btn-buy mt-3">Continue Shopping</a>
    </div>
</div>

<?php include("includes/footer.php"); ?>
