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
$year = $_GET["rok"];


include_once "../concerts.class.php";
$concerts = new concerts();
if ($concerts->hideConcert($ID)) {
  header("Location: index.php?hlaska=10&rok=$year");
  exit;
} else {
  header("Location: index.php?hlaska=11&rok=$year");
  exit;
}