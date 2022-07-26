<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('location: /phpmotors/');
    exit;
}

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Mangement</title>
    <link rel="stylesheet" media="screen and (max-width: 999px)" href="/phpmotors/css/small.css">
    <link rel="stylesheet" media="screen and (min-width: 1000px)" href="/phpmotors/css/large.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Audiowide&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
        <nav>
            <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php'; ?>
        </nav>
    </header>

    <main>
        <div class="formContentArea">
            <h1>Vehicle Management</h1>
            <ul>
                <li><a href="/phpmotors/vehicles/index.php/?action=add-classification">Add Classification</a></li>
                <li><a href="/phpmotors/vehicles/index.php/?action=add-vehicle">Add Vehicle</a></li>
            </ul>
            
            <?php
        if (isset($message)) {
            echo $message;
        }
        if (isset($classificationList)) {
            echo '<h2>Vehicles By Classification</h2>';
            echo '<p>Choose a classification to see those vehicles</p>';
            echo $classificationList;
        }
        ?>

<noscript>
    <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
</noscript>

<table id="inventoryDisplay"></table>
</div>

</main>

<footer>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
</footer>

    <script src="/phpmotors/js/inventory.js"></script>
</body>

</html>
<?php unset($_SESSION['message']); ?>