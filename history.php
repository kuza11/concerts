<?php
$rok = $_GET["rok"];
if (!is_numeric($rok)) {
  $rok = date("Y");
}
?>
<!doctype html>
<html lang="cs-cz">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Archív koncertů</title>
  <link href="style.css" rel="stylesheet">
</head>

<body>
  <?php
  include_once("concerts.class.php");
  $concerts = new concerts();
  $events = $concerts->getConcertsHistory($rok);
  $eventCnt = count($concerts->getConcertsHistory(date("Y")));
  $min = $concerts->getMinMaxDate()->min;





  ?>
  <div class="container">
    <h1 id="title">Archív koncertů</h1>
    <div class="headerHist">
      <div>
        <?php
        if ($rok > $min) {
          echo '<a href="?rok=' . ($rok - 1) . '">';
          echo "&larr;";
          echo $rok - 1;
          echo "</a> ";
        }
        echo "<strong>";
        echo $rok;
        echo "</strong> ";
        if ($eventCnt > 0 ? $rok < date("Y") : $rok < date("Y") - 1) {
          echo '<a href="?rok=' . ($rok + 1) . '">';
          echo $rok + 1;
          echo "&rarr;";
          echo "</a><br>";
        }
        ?>
      </div>
      <div>
        <button onclick="location.href='index.php'">Nadcházející koncerty</button>
      </div>
    </div>
    <table>
      <tr>
        <th>Datum:</th>
        <th>Čas:</th>
        <th>Kde:</th>
        <th>Co:</th>
        <th>Poznámka:</th>
      </tr>
      <?php
      foreach ($events as $event) {
        if ($event->deleted == 1)
          continue;
        ?>
        <tr>
          <td>
            <?= date("d.m.Y", strtotime($event->datum))  ?>
          </td>
          <td>
            <?= $event->cas ?>
          </td>
          <td>
            <?= $event->kde ?>
          </td>
          <td>
            <?= $event->co ?>
          </td>
          <td>
            <?= $event->poznamka ?>
          </td>
        </tr>
        <?php
      }
      ?>
    </table>
  </div>
</body>

</html>