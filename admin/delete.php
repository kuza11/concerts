<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if (empty($_SESSION["name"])) {
  header("Location: loginPage.php");
  exit;
}

$ID = htmlspecialchars($_GET["ID"]);
if (is_numeric($ID)) {
  require_once "../concerts.class.php";
  $concerts = new concerts();
  if ($concerts->delConcert($ID)) {
    header("Location: index.php?hlaska=4");
    exit;
  } else {
    header("Location: index.php?hlaska=5");
    exit;
  }

} else {
  header("Location: index.php?hlaska=6");
  exit;
}