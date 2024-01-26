<?php

class concerts
{
  public $conn;
  /**
   * Konstruktor se připojí k DB
   */
  public function __construct()
  {
    include "db.php";
    $dsn = "mysql:host=localhost;dbname=$dbname;port=3336";
    $options = array(
      PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );
    try {
      $this->conn = new PDO($dsn, $user, $pass, $options);
    } catch (PDOException $e) {
      $file = fopen("err.log", "w");
      fprintf($file, "Connection failed: %s\n", $e->getMessage());
    }
  }
  public function getFutureConcerts()
  {
    try {
      $stmt = $this->conn->prepare("SELECT * FROM `koncerty` WHERE datum >= CURRENT_DATE ORDER BY `koncerty`.`datum` ASC;");
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
      $file = fopen("err.log", "w");
      fprintf($file, "Connection failed\n", $e->getMessage());
      return false;
    }
  }
  public function getConcerts($year)
  {
    try {
      $stmt = $this->conn->prepare("SELECT * FROM `koncerty` WHERE datum LIKE CONCAT(:rok,'%') ORDER BY `koncerty`.`datum` DESC");
      $stmt->bindParam(':rok', $year);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
      $file = fopen("err.log", "w");
      fprintf($file, "Connection failed\n", $e->getMessage());
      return false;
    }
  }
  public function getConcert($ID){
    try {
      $stmt = $this->conn->prepare("SELECT * FROM `koncerty` WHERE ID = :ID");
      $stmt->bindParam(':ID', $ID);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
      $file = fopen("err.log", "w");
      fprintf($file, "Connection failed\n", $e->getMessage());
      return false;
    }
  }
  public function getConcertsHistory($rok = "")
  {
    try {
      $stmt = $this->conn->prepare("SELECT * FROM `koncerty` WHERE datum LIKE CONCAT(:rok,'%') AND `datum` < CURRENT_DATE ORDER BY `koncerty`.`datum` DESC");
      $stmt->bindParam(':rok', $rok);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
      $file = fopen("err.log", "w");
      fprintf($file, "Connection failed\n", $e->getMessage());
      return false;
    }
  }
  public function getMinMaxDate()
  {
    try {
      $stmt = $this->conn->prepare("SELECT MIN(datum) as min, MAX(datum) as max FROM `koncerty`");
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
      $file = fopen("err.log", "w");
      fprintf($file, "Connection failed\n", $e->getMessage());
      return false;
    }
  }
  public function delConcert($ID)
  {
    try {
      $stmt = $this->conn->prepare("DELETE FROM koncerty WHERE ID=:ID");
      $stmt->bindParam(':ID', $ID, PDO::PARAM_INT);
      $stmt->execute();
      return true; //přispěvek smazán - dotvořit zpětnou vazbu
    } catch (PDOException $e) {
      $file = fopen("err.log", "w");
      fprintf($file, "Connection failed\n", $e->getMessage());
      return false;
    }
  }
  public function editConcert($ID, $description, $date, $time, $location, $note){
    try {
      $stmt = $this->conn->prepare("UPDATE `koncerty` SET `datum` = :date, `cas` = :time, `kde` = :location, `co` = :description, `poznamka` = :note WHERE `ID` = :ID;");
      $stmt->bindParam(':ID', $ID, PDO::PARAM_INT);
      $stmt->bindParam(':description', $description);
      $stmt->bindParam(':date', $date);
      $stmt->bindParam(':time', $time);
      $stmt->bindParam(':location', $location);
      $stmt->bindParam(':note', $note);
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      $file = fopen("err.log", "w");
      fprintf($file, "Connection failed\n", $e->getMessage());
      return false;
    }
  }
  public function addConcert($description, $date, $time, $location, $note){
    try {
      $stmt = $this->conn->prepare("INSERT INTO `koncerty` (`datum`, `cas`, `kde`, `co`, `poznamka`) VALUES (:date, :time, :location, :description, :note);");
      $stmt->bindParam(':description', $description);
      $stmt->bindParam(':date', $date);
      $stmt->bindParam(':time', $time);
      $stmt->bindParam(':location', $location);
      $stmt->bindParam(':note', $note);
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      $file = fopen("err.log", "w");
      fprintf($file, "Connection failed\n", $e->getMessage());
      return false;
    }
  }
  public function hideConcert($ID){
    try {
      $stmt = $this->conn->prepare("UPDATE koncerty SET deleted = if(deleted = 0, 1, 0) WHERE ID = :ID; ");
      $stmt->bindParam(':ID', $ID, PDO::PARAM_INT);
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      $file = fopen("err.log", "w");
      fprintf($file, "Connection failed\n", $e->getMessage());
      return false;
    }
  }
  public function loginOK($name, $password)
  {
    try {
      $stmt = $this->conn->prepare("SELECT password FROM user WHERE name = :name");
      $stmt->bindParam(":name", $name);
      $stmt->execute();
      return password_verify($password, $stmt->fetchAll(PDO::FETCH_OBJ)[0]->password);
    } catch (PDOException $e) {
      $file = fopen("err.log", "w");
      fprintf($file, "Connection failed\n", $e->getMessage());
      return false;
    }
  }

}