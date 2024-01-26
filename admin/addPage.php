<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if (empty($_SESSION["name"])) {
  header("Location: loginPage.php");
  exit;
}
include_once "../concerts.class.php";
$concerts = new concerts();
?>
<!doctype html>
<html lang="cs">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../editStyles.css">
  <title>Přidání koncertu</title>
</head>

<body>
  <div class="container">
    <h1>Přidání koncertu</h1>
    <form action="add.php" method="post">
      <label for="date">Datum:</label>
      <input type="date" name="date" required>
      <label for="time">Čas:</label>
      <input type="text" name="time" required>
      <label for="location">Kde:</label>
      <textarea cols="40" rows="3" name="location" required></textarea>
      <label for="description">Co:</label>
      <textarea cols="60" rows="10" name="description" required></textarea>
      <label for="note">Poznámka:</label>
      <textarea cols="60" rows="10" name="note"></textarea>
      <div id="buttons">
        <button onclick="history.back()">Zpět</button>
        <input type="submit" name="submit" value="Odeslat">
      </div>
    </form>
  </div>
</body>

</html>