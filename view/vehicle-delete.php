<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('location: /phpmotors/');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if (isset($invInfo['invMake'])) {
                echo "Delete $invInfo[invMake] $invInfo[invModel]";
            } ?> | PHP Motors</title>
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
            <h1><?php if (isset($invInfo['invMake'])) {
                    echo "Delete $invInfo[invMake] $invInfo[invModel]";
                } ?></h1>

            <?php
            if (isset($classMessage)) {
                echo $classMessage;
            }
            if (isset($message)) {
                echo $message;
            }
            ?>

            <p>*Note All Fields Are Required</p>
            <p>Confirm Vehicle Deletion. The delete is permanent.</p>

            <form method="POST" action="/phpmotors/vehicles/index.php">

                <label class="makeLabel" for="invMake">Make:</label>
                <input type="text" id="invMake" name="invMake" <?php if (isset($invMake)) {
                                                                    echo "value='$invMake'";
                                                                } elseif (isset($invInfo['invMake'])) {
                                                                    echo "value='$invInfo[invMake]'";
                                                                } ?> readonly>

                <label for="invModel">Model:</label>
                <input type="text" id="invModel" name="invModel" <?php if (isset($invModel)) {
                                                                        echo "value='$invModel'";
                                                                    } elseif (isset($invInfo['invModel'])) {
                                                                        echo "value='$invInfo[invModel]'";
                                                                    } ?> readonly>

                <label for="invDescription">Description:</label>
                <textarea id="invDescription" name="invDescription" readonly><?php if (isset($invDescription)) {
                                                                                    echo $invDescription;
                                                                                } elseif (isset($invInfo['invDescription'])) {
                                                                                    echo $invInfo['invDescription'];
                                                                                } ?></textarea>

                <input class="button" type="submit" name="submit" id="classbtn" value="Delete Vehicle">
                <input type="hidden" name="action" value="deleteVehicle">
                <input type="hidden" name="invId" value="<?php if (isset($invInfo['invId'])) {
                                                                echo $invInfo['invId'];
                                                            } ?>">
            </form>
            <a href=" /phpmotors/vehicles/">Back to Vehicle Management</a>
        </div>

    </main>

    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>

</body>

</html>