<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Classification</title>
    <link rel="stylesheet" media="screen and (max-width: 999px)" href="/phpmotors/css/small.css">
    <link rel="stylesheet" media="screen and (min-width: 1000px)" href="/phpmotors/css/large.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Audiowide&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php';?>
        <nav>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/nav.php';?>
        </nav>
    </header> 

    <main>
        <div class="formContentArea">
        <h1>Add Classification</h1>

        <?php
            if (isset($classMessage)) {
                echo $classMessage;
            }
        ?>

        <form method="POST" action="/phpmotors/vehicles/index.php" >
            <label for="classificationName">Classification Name:</label>
            <input type="text" id="classificationName" name="classificationName" maxlength="30" required>
            
            <input class="button" type="submit" name="submit" id="classificationName" value="Add Classification">
            <input type="hidden" name="action" value="send-classification">
        </form>
        <a href="/phpmotors/vehicles/">Back to Vehicle Management</a>
        </div>

    </main>

    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
    </footer>
    
</body>
</html>