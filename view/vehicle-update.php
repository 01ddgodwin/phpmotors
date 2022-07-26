<?php
// Build the classifications option list
$dropdown = '<select name="classificationId" id="classificationId">';
$dropdown .= "<option>Choose a Car Classification</option>";
foreach ($classificationList as $value) {
    $dropdown .= "<option value='$value[classificationId]'";
    if (isset($classificationId)) {
        if ($value['classificationId'] === $classificationId) {
            $dropdown .= ' selected ';
        }
    } elseif (isset($invInfo['classificationId'])) {
        if ($value['classificationId'] === $invInfo['classificationId']) {
            $dropdown .= ' selected ';
        }
    }
    $dropdown .= ">$value[classificationName]</option>";
}
$dropdown .= '</select>';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
                echo "Modify $invInfo[invMake] $invInfo[invModel]";
            } elseif (isset($invMake) && isset($invModel)) {
                echo "Modify $invMake $invModel";
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
            <h1><?php if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
                    echo "Modify $invInfo[invMake] $invInfo[invModel]";
                } elseif (isset($invMake) && isset($invModel)) {
                    echo "Modify$invMake $invModel";
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

            <form method="POST" action="/phpmotors/vehicles/index.php">

                <label>Choose a car: </label>
                <?php echo $dropdown; ?>

                <label class="makeLabel" for="invMake">Make:</label>
                <input type="text" id="invMake" name="invMake" <?php if (isset($invMake)) {
                                                                    echo "value='$invMake'";
                                                                } elseif (isset($invInfo['invMake'])) {
                                                                    echo "value='$invInfo[invMake]'";
                                                                } ?> required>

                <label for="invModel">Model:</label>
                <input type="text" id="invModel" name="invModel" <?php if (isset($invModel)) {
                                                                        echo "value='$invModel'";
                                                                    } elseif (isset($invInfo['invModel'])) {
                                                                        echo "value='$invInfo[invModel]'";
                                                                    } ?> required>

                <label for="invDescription">Description:</label>
                <textarea id="invDescription" name="invDescription" required><?php if (isset($invDescription)) {
                                                                                    echo $invDescription;
                                                                                } elseif (isset($invInfo['invDescription'])) {
                                                                                    echo $invInfo['invDescription'];
                                                                                } ?></textarea>

                <label for="invImage">Image Path:</label>
                <input type="text" id="invImage" name="invImage" <?php if (isset($invImage)) {
                                                                        echo "value='$invImage'";
                                                                    } elseif (isset($invInfo['invImage'])) {
                                                                        echo "value='$invInfo[invImage]'";
                                                                    } ?> required>

                <label for="invThumbnail">Thumbnail Path:</label>
                <input type="text" id="invThumbnail" name="invThumbnail" <?php if (isset($invThumbnail)) {
                                                                                echo "value='$invThumbnail'";
                                                                            } elseif (isset($invInfo['invThumbnail'])) {
                                                                                echo "value='$invInfo[invThumbnail]'";
                                                                            } ?> required>

                <label for="invPrice">Price:</label>
                <input type="text" id="invPrice" name="invPrice" <?php if (isset($invPrice)) {
                                                                        echo "value='$invPrice'";
                                                                    } elseif (isset($invInfo['invPrice'])) {
                                                                        echo "value='$invInfo[invPrice]'";
                                                                    } ?> required>

                <label for="invStock"># In Stock:</label>
                <input type="text" id="invStock" name="invStock" <?php if (isset($invStock)) {
                                                                        echo "value='$invStock'";
                                                                    } elseif (isset($invInfo['invStock'])) {
                                                                        echo "value='$invInfo[invStock]'";
                                                                    } ?> required>

                <label for="invColor">Color:</label>
                <input type="text" id="invColor" name="invColor" <?php if (isset($invColor)) {
                                                                        echo "value='$invColor'";
                                                                    } elseif (isset($invInfo['invColor'])) {
                                                                        echo "value='$invInfo[invColor]'";
                                                                    } ?> required>

                <input class="button" type="submit" name="submit" id="classbtn" value="Update Vehicle">
                <input type="hidden" name="action" value="updateVehicle">
                <input type="hidden" name="invId" value="<?php if (isset($invInfo['invId'])) {
                                                                echo $invInfo['invId'];
                                                            } elseif (isset($invId)) {
                                                                echo $invId;
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