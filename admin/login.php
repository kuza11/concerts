<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


session_start();
require_once("../concerts.class.php");
$concerts = new concerts();

if (!empty($_SESSION["name"])) {
  header("Location: index.php");
}


if (isset($_POST["name"]) && isset($_POST["password"])) {
  $name = strtolower(htmlspecialchars($_POST["name"]));
  $password = $_POST["password"];

  if ($concerts->loginOK($name, trim($password)) == 1) {
    $_SESSION["name"] = $name;
    header("Location: index.php");
    exit;
  } else {
    unset($_SESSION["name"]);
    unset($_POST);
    session_destroy();
    header("Location: loginPage.php?hlaska=1");
    exit;
  }
} else {
  header("Location: loginPage.php?hlaska=2");
  exit;
}