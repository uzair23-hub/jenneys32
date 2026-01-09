<?php
include("includes/header.php");
include("includes/db.php");

// Start session
if (!isset($_SESSION)) {
    session_start();
}

// If cart is empty, redirect to products page
if (empty($_SESSION['cart'])) {
    echo "<script>alert('Your cart is empty!'); window.location='products.php';</script>";
    exit();
}

// Handle Order Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name       = mysqli_real_escape_string($conn, $_POST['name']);
    $email      = mysqli_real_escape_string($conn, $_POST['email']);
    $address    = mysqli_real_escape_string($conn, $_POST['address']);
    $work_phone = mysqli_real_escape_string($conn, $_POST['work_phone']);
    $cell_phone = mysqli_real_escape_string($conn, $_POST['cell_phone']);
    $dob        = mysqli_real_escape_string($conn, $_POST['dob']);
    $category= mysqli_real_escape_string($conn, $_POST['category']);
    $remarks    = mysqli_real_escape_string($conn, $_POST['remarks']);

    // Insert customer info
    $customer_query = "INSERT INTO customers (name, address, email, work_phone, cell_phone, dob, category, remarks) 
                       VALUES ('$name', '$address', '$email', '$work_phone', '$cell_phone', '$dob','$category', '$remarks')";
    mysqli_query($conn, $customer_query);

    $customer_id = mysqli_insert_id($conn);

    // Insert order info
    $order_query = "INSERT INTO orders (customer_id) VALUES ('$customer_id')";
    mysqli_query($conn, $order_query);

    $order_id = mysqli_insert_id($conn);

    // Insert order items
    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        $order_items_query = "INSERT INTO order_items (order_id, product_id, quantity) 
                              VALUES ('$order_id', '$product_id', '$quantity')";
        mysqli_query($conn, $order_items_query);

        // Update stock
        mysqli_query($conn, "UPDATE products SET stock = stock - $quantity WHERE id = '$product_id'");
    }

    // Clear cart
    unset($_SESSION['cart']);

    // Redirect to thank you page
    echo "<script>alert('Your order has been placed successfully!'); window.location='thankyou.php?order_id=$order_id';</script>";
    exit();
}
?>

<div class="container my-5">
    <h2 class="fw-bold mb-4">Checkout</h2>
    <div class="row">
        <!-- Customer Information -->
        <div class="col-md-7">
            <div class="card shadow p-4">
                <h5 class="fw-bold mb-3">Billing Details</h5>
                <form method="POST" action="checkout.php" id="orderForm" novalidate>
    <div class="mb-3">
        <label class="form-label fw-bold">Full Name</label>
        <input type="text" name="name" class="form-control" required pattern="^[A-Za-z ]{3,}$" minlength="3">
        <div class="invalid-feedback">Name must be at least 3 letters and only alphabets.</div>
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Email</label>
        <input type="email" name="email" class="form-control" required>
        <div class="invalid-feedback">Please enter a valid email address.</div>
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Address</label>
        <textarea name="address" class="form-control" rows="2" required></textarea>
        <div class="invalid-feedback">Address is required.</div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Work Phone</label>
            <input type="text" name="work_phone" class="form-control" required pattern="^03[0-9]{9}$" maxlength="11">
            <div class="invalid-feedback">Work phone must start with 03 and be 11 digits.</div>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Cell Phone</label>
            <input type="text" name="cell_phone" class="form-control" required pattern="^03[0-9]{9}$" maxlength="11">
            <div class="invalid-feedback">Cell phone must start with 03 and be 11 digits.</div>
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Date of Birth</label>
        <input type="date" name="dob" class="form-control" required>
        <div class="invalid-feedback">You must be at least 16 years old.</div>
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Category</label>
        <select name="category" class="form-control" required>
            <option value="regular">Regular</option>
            <option value="vip">VIP</option>
        </select>
        <div class="invalid-feedback">Category is required.</div>
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Remarks</label>
        <textarea name="remarks" class="form-control" rows="2"></textarea>
    </div>
    <button type="submit" class="btn btn-buy w-100">Place Order</button>
</form>

<script>
// Live validation for order form (on input)
const orderForm = document.getElementById('orderForm');
const fields = ['name', 'email', 'address', 'work_phone', 'cell_phone', 'dob', 'category'];

function validateField(field) {
    const value = field.value.trim();
    let valid = true;
    if (field.name === 'name') {
        valid = /^[A-Za-z ]{3,}$/.test(value);
    } else if (field.name === 'email') {
        valid = /^\S+@\S+\.\S+$/.test(value);
    } else if (field.name === 'address') {
        valid = value !== '';
    } else if (field.name === 'work_phone' || field.name === 'cell_phone') {
        valid = /^03[0-9]{9}$/.test(value);
    } else if (field.name === 'dob') {
        if (value) {
            const dobDate = new Date(value);
            const today = new Date();
            let age = today.getFullYear() - dobDate.getFullYear();
            const m = today.getMonth() - dobDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < dobDate.getDate())) {
                age--;
            }
            valid = age >= 16;
        } else {
            valid = false;
        }
    } else if (field.name === 'category') {
        valid = !!value;
    }
    if (!valid) {
        field.classList.add('is-invalid');
    } else {
        field.classList.remove('is-invalid');
    }
    return valid;
}

fields.forEach(function(name) {
    const field = orderForm[name];
    if (field) {
        field.addEventListener('input', function() {
            validateField(field);
        });
        if (field.tagName === 'SELECT') {
            field.addEventListener('change', function() {
                validateField(field);
            });
        }
    }
});

orderForm.addEventListener('submit', function(e) {
    let valid = true;
    fields.forEach(function(name) {
        const field = orderForm[name];
        if (field && !validateField(field)) {
            valid = false;
        }
    });
    if (!valid) {
        e.preventDefault();
    }
});
</script>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="col-md-5">
            <div class="card shadow p-4">
                <h5 class="fw-bold mb-3">Your Order</h5>
                <ul class="list-group list-group-flush mb-3">
                    <?php
                    $total = 0;
                    foreach ($_SESSION['cart'] as $product_id => $quantity) {
                        $query = "SELECT * FROM products WHERE id = '$product_id'";
                        $result = mysqli_query($conn, $query);
                        $product = mysqli_fetch_assoc($result);

                        $subtotal = $product['price'] * $quantity;
                        $total += $subtotal;
                    ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?= $product['name']; ?> <span class="badge bg-secondary"><?= $quantity; ?> x <?= number_format($product['price']); ?></span>
                        </li>
                    <?php } ?>
                </ul>
                <h5 class="text-end fw-bold">Total: PKR <?php echo number_format($total); ?></h5>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>
