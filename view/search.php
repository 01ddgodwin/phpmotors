<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search | PHP Motors, Inc.</title>
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
            <h1>Search</h1>
            <form method="GET" action="/phpmotors/vehicles/index.php/" >
                <label for="search">What are you looking for today?</label>
                <input class="search" type="text" id="search" name="search" placeholder="Search..." required>
                <input class="button" type="submit" name="submit" value="Search">
                <input type="hidden" name="action" value="getSearch">
            </form>

            <?php
            echo message();
            clearMessage();
            ?>

            

            <?php 
            if (isset($message)) {
                echo $message;
            }
            
            if (isset($results)) {
                echo $searchDisplay;
            }
            
            if (isset($pagDisplay)) {
                echo $pagDisplay;
            }
            ?>
        </div>
    </main>

    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>

</body>

</html>