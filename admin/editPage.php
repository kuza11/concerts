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
    include_once "../concerts.class.php";
    $concerts = new concerts();
    $concert = $concerts->getConcert($ID);
    ?>
    <!doctype html>
    <html lang="cs">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
            content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="../editStyles.css">
        <title>Editace koncertu č.:
            <?php echo $ID; ?>
        </title>
    </head>

    <body>
        <div class="container">
            <h1>Editace koncertu č.:
                <?= $ID ?>
            </h1>
            <form action="edit.php?ID=<?php echo $ID; ?>" method="post">
                <label for="date">Datum:</label>
                <input type="date" name="date" value="<?= $concert->datum ?>" required>
                <label for="time">Čas:</label>
                <input type="text" name="time" value="<?= $concert->cas ?>" required>
                <label for="location">Kde:</label>
                <textarea cols="40" rows="3" name="location" required><?= $concert->kde ?></textarea>
                <label for="description">Co:</label>
                <textarea cols="60" rows="10" name="description" required><?= $concert->co ?></textarea>
                <label for="note">Poznámka:</label>
                <textarea cols="60" rows="10" name="note"><?= $concert->poznamka ?></textarea>
                <div id="buttons">
                    <button type="button"
                        onclick="history.back();">Zpět</button>
                    <input type="submit" name="edit" value="Upravit">
                </div>
            </form>
        </div>
    </body>

    </html>
    <?php
} else {
    header("Location: index.php?hlaska=9");
    exit;
}