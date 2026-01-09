<?php include("includes/header.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us - Jenny Cosmetics & Jewellery</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f8f5ff;
      color: #333;
    }

    .about-container {
      max-width: 1100px;
      margin: auto;
      padding: 50px 20px;
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      justify-content: center;
      gap: 40px;
    }

    .about-image {
      flex: 1 1 200px;
      text-align: center;
    }

    .about-image img {
      width: 100%;
      max-width: 450px;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.2);
      transition: transform 0.4s ease-in-out;
    }

    .about-image img:hover {
      transform: scale(1.05);
    }

    .about-content {
      flex: 1 1 500px;
    }

    .about-content h1 {
      color: #6a0dad;
      font-size: 2.5rem;
      margin-bottom: 15px;
      position: relative;
    }

    .about-content h1::after {
      content: "";
      display: block;
      width: 80px;
      height: 4px;
      background: #6a0dad;
      margin-top: 10px;
      border-radius: 3px;
    }

    .about-content p {
      font-size: 1.1rem;
      line-height: 1.8;
      margin-bottom: 20px;
      color: #555;
      text-align: justify;
    }

    .highlight {
      color: #6a0dad;
      font-weight: bold;
    }

    .mission-section {
      background: #fff;
      margin: 50px auto;
      padding: 40px 20px;
      border-radius: 15px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.1);
      max-width: 1100px;
      text-align: center;
    }

    .mission-section h2 {
      color: #6a0dad;
      font-size: 2rem;
      margin-bottom: 15px;
    }

    .mission-section p {
      font-size: 1.1rem;
      color: #444;
      line-height: 1.7;
      max-width: 850px;
      margin: auto;
    }

    @media screen and (max-width: 768px) {
      .about-container {
        flex-direction: column;
        text-align: center;
        gap: 18px; /* Reduce gap for small screens */
        padding: 30px 8px;
      }

      .about-content h1::after {
        margin: 10px auto;
      }

      .about-image {
        margin-bottom: 0px;
      }
    }

    @media screen and (max-width: 500px) {
      .about-container {
        gap: 8px;
        padding: 18px 2px;
      }

      .about-image img {
        max-width: 98vw;
      }
    }
  </style>
</head>
<body>

  <!-- About Section -->
  <div class="about-container">
    <div class="about-image">
      <img src="photos/background.jpeg" alt="Jenny Cosmetics & Jewellery">
    </div>
    <div class="about-content">
      <h1>About Us</h1>
      <p>
        <span class="highlight">Jenny Cosmetics & Jewellery</span> began as a small home-based business,
        founded by Jenny with a passion for cosmetics and imitation jewellery.
        Initially, Jenny started by reaching out to her nearby <strong>friends and relatives</strong>,
        personally informing them about the variety of products available and their prices.
      </p>
      <p>
        With the help of Maria, who maintained a product catalogue and recorded client contact details
        and orders in a diary, the business quickly started growing. As demand increased and more
        clients joined Jenny’s journey, it became clear that the business needed to expand its
        reach and make shopping easier for everyone.
      </p>
      <p>
        To keep up with the growing demand, Jenny decided to build this <strong>online platform</strong>.
        Now, our customers can <span class="highlight">browse products, explore our entire collection,
        and place orders directly through the website</span>, anytime and anywhere.
      </p>
    </div>
  </div>

  <!-- Mission Section -->
  <div class="mission-section">
    <h2>Our Mission</h2>
    <p>
      Our mission is to bring you the finest selection of <strong>cosmetics</strong> and
      <strong>imitation jewellery</strong> at affordable prices, while offering a seamless online shopping
      experience. We aim to make every customer feel confident, beautiful, and valued.
    </p>
  </div>

<?php include("includes/footer.php"); ?>
</body>
</html>
