<?php

session_start();
unset($_SESSION["username"]);
unset($_SESSION["email"]);
unset($_SESSION["admin"]);
unset($_SESSION["banned"]);
unset($_POST);

session_destroy();

header("Location: index.php");
exit;
