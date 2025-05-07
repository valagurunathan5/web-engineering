<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "movie_booking");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$success = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $movie = $_POST["movie"];
  $tickets = $_POST["tickets"];
  $email = $_POST["email"];

  $stmt = $conn->prepare("INSERT INTO bookings (name, movie, tickets, email) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssis", $name, $movie, $tickets, $email);
  if ($stmt->execute()) {
    $success = "🎉 Booking successful for $tickets ticket(s) to '$movie'.";
  } else {
    $success = "Error: " . $stmt->error;
  }
  $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Movie Ticket Booking</title>
  <style>
    body { font-family: Arial; padding: 30px; background: #f4f4f4; }
    .form-box {
      max-width: 400px; background: #fff; padding: 20px; margin: auto;
      border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    input, select { width: 100%; padding: 10px; margin-top: 10px; }
    button { background: #2980b9; color: white; padding: 10px; border: none; margin-top: 15px; cursor: pointer; }
    .success { margin-top: 20px; color: green; font-weight: bold; }
  </style>
</head>
<body>

<div class="form-box">
  <h2>🎬 Book Your Movie Ticket</h2>
  <form method="POST">
    <label>Name</label>
    <input type="text" name="name" required>

    <label>Movie</label>
    <select name="movie" required>
      <option value="">-- Select --</option>
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

    <button type="submit">Book Now</button>
  </form>

  <?php if ($success): ?>
    <div class="success"><?= $success ?></div>
  <?php endif; ?>
</div>

</body>
</html>
