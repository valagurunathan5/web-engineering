<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Movie Ticket Booking</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f0f4f7;
      margin: 0;
      padding: 40px;
    }
    .container {
      max-width: 450px;
      margin: auto;
      background: #fff;
      padding: 25px;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    input, select {
      width: 100%;
      padding: 10px;
      margin-top: 10px;
      margin-bottom: 15px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }
    input[type=submit] {
      background: #007bff;
      color: white;
      border: none;
      cursor: pointer;
    }
    .result {
      background: #e6ffe6;
      padding: 15px;
      margin-top: 20px;
      border-left: 5px solid #28a745;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Movie Ticket Booking</h2>
  <form method="post" action="">
    <label for="name">Your Name</label>
    <input type="text" name="name" required>

    <label for="movie">Select Movie</label>
    <select name="movie" required>
      <option value="">-- Choose a Movie --</option>
      <option>Good Bad Ugly</option>
      <option>Leo</option>
      <option>Retro</option>
      <option>Veera Dheera Sooran</option>
      <option>Alappuzha Gymkhana</option>
    </select>

    <label for="tickets">Number of Tickets</label>
    <input type="number" name="tickets" min="1" max="10" required>

    <label for="email">Email</label>
    <input type="email" name="email" required>

    <input type="submit" name="book" value="Book Now">
  </form>

  <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      echo "<div class='result'>";
      echo "<h3>🎟 Booking Confirmed!</h3>";
      echo "<strong>Name:</strong> " . htmlspecialchars($_POST["name"]) . "<br>";
      echo "<strong>Movie:</strong> " . htmlspecialchars($_POST["movie"]) . "<br>";
      echo "<strong>Tickets:</strong> " . htmlspecialchars($_POST["tickets"]) . "<br>";
      echo "<strong>Email:</strong> " . htmlspecialchars($_POST["email"]);
      echo "</div>";
    }
  ?>
</div>

</body>
</html>
