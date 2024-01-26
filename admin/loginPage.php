<?php
session_start();
if (!empty($_SESSION["name"])) {
  header("Location: index.php");
  exit;
}

switch ($_GET["hlaska"]) {
  case 1:
    echo "<script>alert('Špatné údaje');</script>";
    break;
  case 2:
    echo "<script>alert('Chyba');</script>";
    break;
  default:
    break;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style.css">
  <link rel="stylesheet" href="../adminStyles.css">
  <script>
    function myFunction() {
      var x = document.getElementById("password");
      if (document.getElementById("showP").checked) {
        x.type = "text";
      } else {
        x.type = "password";
      }
    } 
  </script>
  <title>Login</title>
</head>

<body class="login">
  <form action="./login.php" method="post">
    <div id="cancelDiv">
      <a type="button" id="cancel" href="../index.php">X</a>
    </div>
    <label for="name">Jméno</label>
    <input type="text" name="name" id="name" required />
    <label for="password">Heslo</label>
    <input type="password" name="password" id="password" required />
    <label for="showP">Zobrazit heslo</label>
    <input type="checkbox" id="showP" onclick="myFunction()" />
    <input type="submit" value="Přihlásit se" />
  </form>
</body>

</html>