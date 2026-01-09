<?php
// Contact Us Page - Jenny Cosmetics & Jewellery
include("includes/db.php"); // Database connection

// Form validation & message handling
$name = $email = $message = "";
$nameErr = $emailErr = $messageErr = "";
$successMsg = $errorMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Name Validation
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = htmlspecialchars(trim($_POST["name"]));
    }

    // Email Validation
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    } else {
        $email = htmlspecialchars(trim($_POST["email"]));
    }

    // Message Validation
    if (empty($_POST["message"])) {
        $messageErr = "Message cannot be empty";
    } else {
        $message = htmlspecialchars(trim($_POST["message"]));
    }

    // If no validation errors → Save to database
    if (empty($nameErr) && empty($emailErr) && empty($messageErr)) {
        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);

        if ($stmt->execute()) {
            $successMsg = "Thank you, $name! Your message has been sent successfully.";
            $name = $email = $message = ""; // Clear form after success
        } else {
            $errorMsg = "Something went wrong. Please try again later.";
        }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us - Jenny Cosmetics & Jewellery</title>
  <style>
    #container {
      max-width: 700px;
      margin: auto;
      background: rgba(255, 255, 255, 0.95);
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.2);
      margin-top: 60px;
      margin-bottom: 60px;
      animation: fadeIn 1s ease-in-out;
    }
    .hed {
      color: #6a0dad;
      font-size: 2.5rem;
      margin-bottom: 20px;
      text-align: center;
      font-weight: 700;
      width: 50vw;
    }
    .hed::after {
      content: "";
      display: block;
      width: 80px;
      height: 3px;
      background: #6a0dad;
      margin: 12px auto;
      border-radius: 3px;
    }
    #form { display: flex; flex-direction: column; gap: 15px; }
    label { font-weight: bold; margin-bottom: 5px; }
    input, textarea {
      padding: 12px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 1rem;
      width: 100%;
    }
    input:focus, textarea:focus {
      border-color: #6a0dad;
      outline: none;
      box-shadow: 0 0 6px rgba(106, 13, 173, 0.4);
    }
    button {
      background: #6a0dad;
      color: white;
      padding: 12px;
      font-size: 1.1rem;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: 0.3s;
    }
    button:hover { background: #540a91; }
    .error { color: red; font-size: 0.9rem; }
    .success { color: green; font-size: 1rem; margin-bottom: 15px; text-align: center; font-weight: bold; }
    .fail { color: red; font-size: 1rem; margin-bottom: 15px; text-align: center; font-weight: bold; }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>
<?php include("includes/header.php"); ?>

  <div id="container">
    <h1 class="hed">Contact Us</h1>

    <?php if (!empty($successMsg)) : ?>
      <p class="success"><?php echo $successMsg; ?></p>
    <?php elseif (!empty($errorMsg)) : ?>
      <p class="fail"><?php echo $errorMsg; ?></p>
    <?php endif; ?>

    <form id="form" action="" method="post">
      <div>
        <label for="name">Your Name:</label>
        <input type="text" name="name" id="name" value="<?php echo $name; ?>">
        <span class="error"><?php echo $nameErr; ?></span>
      </div>

      <div>
        <label for="email">Your Email:</label>
        <input type="text" name="email" id="email" value="<?php echo $email; ?>">
        <span class="error"><?php echo $emailErr; ?></span>
      </div>

      <div>
        <label for="message">Your Message:</label>
        <textarea name="message" id="message" rows="5"><?php echo $message; ?></textarea>
        <span class="error"><?php echo $messageErr; ?></span>
      </div>

      <button type="submit">Send Message</button>
    </form>
  </div>

<?php include("includes/footer.php"); ?>
</body>
</html>
