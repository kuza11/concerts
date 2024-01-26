<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Koncerty</title>
</head>

<body>
  <?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  include_once 'concerts.class.php';

  $concerts = new concerts();

  $events = $concerts->getFutureConcerts();
  ?>
  <div class="container">
    <h1 id="title">Koncerty</h1>
    <div class="header">
      <button onclick="location.href='history.php'">Historie koncertů</button>
      <button onclick="location.href='admin/index.php'">Administrace</button>
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
            <?= $event->datum ?>
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