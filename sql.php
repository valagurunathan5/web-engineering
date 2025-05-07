<?php
// 1. Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $movie = $_POST["movie"];
  $tickets = $_POST["tickets"];
  $email = $_POST["email"];

  // 2. Database connection
  $conn = new mysqli("localhost", "root", "", "movie_booking");

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // 3. Insert data into table
  $stmt = $conn->prepare("INSERT INTO bookings (name, movie, tickets, email) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssis", $name, $movie, $tickets, $email);

  if ($stmt->execute()) {
    $success = "🎉 Booking successful!";
  } else {
    $error = "Error: " . $stmt->error;
  }

  $stmt->close();
  $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Movie Ticket Booking</title>
  <style>
    body {
      font-family: Arial;
      background: #f2f2f2;
      padding: 40px;
    }
    .container {
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      max-width: 400px;
      margin: auto;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    input, select {
      width: 100%;
      padding: 10px;
      margin-top: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    input[type=submit] {
      background: #007bff;
      color: white;
      border: none;
      cursor: pointer;
    }
    .message {
      margin-top: 20px;
      font-weight: bold;
      color: green;
    }
    .error {
      color: red;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Movie Ticket Booking</h2>
  <form method="POST" action="">
    <label>Your Name</label>
    <input type="text" name="name" required>

    <label>Select Movie</label>
    <select name="movie" required>
      <option value="">-- Choose a Movie --</option>
      <option>Good Bad Ugly</option>
      <option>Leo</option>
      <option>Retro</option>
      <option>Veera Dheera Sooran</option>
      <option>Alappuzha Gymkhana</option>
    </select>

    <label>Number of Tickets</label>
    <input type="number" name="tickets" min="1" max="10" required>

    <label>Email</label>
    <input type="email" name="email" required>

    <input type="submit" value="Book Now">
  </form>

  <?php if (isset($success)) echo "<p class='message'>$success</p>"; ?>
  <?php if (isset($error)) echo "<p class='message error'>$error</p>"; ?>
</div>

</body>
</html>
