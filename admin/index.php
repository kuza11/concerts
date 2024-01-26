<?php

session_start();

if (empty($_SESSION["name"])) {
    header("Location: loginPage.php");
    exit;
}


$rok = $_GET["rok"];
if (!is_numeric($rok)) {
    $rok = date("Y");
}
$res = $_GET["hlaska"];
switch ($res) {
    case 1:
        echo "<script>alert('Špatný vstup');</script>";
        break;
    case 2:
        echo "<script>alert('Koncert byl vložen');</script>";
        break;
    case 3:
        echo "<script>alert('Server error');</script>";
        break;
    case 4:
        echo "<script>alert('Koncert byl smazán');</script>";
        break;
    case 5:
        echo "<script>alert('Server error');</script>";
        break;
    case 6:
        echo "<script>alert('Špatné ID');</script>";
        break;
    case 7:
        echo "<script>alert('Koncert byl upraven');</script>";
        break;
    case 8:
        echo "<script>alert('Server Error');</script>";
        break;
    case 9:
        echo "<script>alert('Špatné ID');</script>";
        break;
    case 10:
        echo "<script>alert('Viditelnost koncertu změněna');</script>";
        break;
    case 11:
        echo "<script>alert('Server error');</script>";
        break;
    default:
        break;
}

?>
<!doctype html>
<html lang="cs-cz">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../adminStyles.css">
    <title>Archív koncertů</title>
</head>

<body>
    <?php
    include_once("../concerts.class.php");
    $concerts = new concerts();
    $events = $concerts->getConcerts($rok);
    $min = $concerts->getMinMaxDate()->min;
    $max = $concerts->getMinMaxDate()->max;




    ?>
    <div class="container">
        <h1 id="title">Administrace</h1>
        <div class="header">
            <div>
                <?php
                if ($rok > $min) {
                    echo '<a href="?rok=' . ($rok - 1) . '">';
                    echo "&larr;";
                    echo $rok - 1;
                }
                echo "</a> <strong>";
                echo $rok;
                echo "</strong> ";
                if ($rok + 1 < $max) {
                    echo '<a href="?rok=' . ($rok + 1) . '">';
                    echo $rok + 1;
                    echo "&rarr;";
                    echo "</a><br>";
                }
                ?>
            </div>
            <div>
                <button id="add" onclick="location.href='addPage.php'">Přidat koncert</button>
                <button onclick="location.href='../index.php'">Nadcházející koncerty</button>
                <button id="logout" onclick="location.href='logout.php'">Odhlásit se</button>
            </div>
        </div>
        <table>
            <tr>
                <th>ID:</th>
                <th>Datum:</th>
                <th>Čas:</th>
                <th>Kde:</th>
                <th>Co:</th>
                <th>Poznámka:</th>
            </tr>
            <?php
            foreach ($events as $event) {
                ?>
                <tr>
                    <td>
                        <div class="id">
                            <?= $event->ID ?>
                            <br>
                            <button class="options"
                                onclick=" location.href='editPage.php?ID=<?= $event->ID ?>'">Upravit</button>
                            <br>
                            <button class="options"
                                onclick="confirm('Chcete opravdu smazat příspěvek?') ? location.href='delete.php?ID=<?= $event->ID ?>' : ''">Smazat</button>
                            <br>
                            <button class="options"
                                onclick="location.href='hide.php?ID=<?= $event->ID ?>&rok=<?= $rok ?>'"><?= ($event->deleted == 0 ? "Skrýt" : "Zobrazit") ?></button>
                        </div>
                    </td>
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