<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if (empty($_SESSION["name"])) {
  header("Location: loginPage.php");
  exit;
}

$date = htmlspecialchars($_POST["date"]);
$time = htmlspecialchars($_POST["time"]);
$location = $_POST["location"];
$description = $_POST["description"];
$note = $_POST["note"];

if (empty($date) || empty($time) || empty($location) || empty($description)) {
  header("Location: index.php?hlaska=1");
  exit;
}

include_once "../concerts.class.php";
$concerts = new concerts();
if ($concerts->addConcert($description, $date, $time, $location, $note)) {
  header("Location: index.php?hlaska=2");
  exit;
} else {
  header("Location: index.php?hlaska=3");
  exit;
}