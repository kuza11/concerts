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
$date = htmlspecialchars($_POST["date"]);
$time = htmlspecialchars($_POST["time"]);
$location = $_POST["location"];  
$description = $_POST["description"];   
$note = $_POST["note"];   

include_once "../concerts.class.php";
$concerts = new concerts();
if ($concerts->editConcert($ID, $description, $date, $time, $location, $note))
{
    header("Location: index.php?hlaska=7&rok=". str_split($date, 4)[0]); 
    exit;
}
else
{
    header("Location: index.php?hlaska=8&rok=". str_split($date, 4)[0]);
    exit;
}