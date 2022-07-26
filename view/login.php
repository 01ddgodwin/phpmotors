<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            <h1>Sign In</h1>
            
            <?php
            echo message();
            clearMessage();
            ?>
            <form action="/phpmotors/accounts/index.php" method="POST">
                <label for="clientEmail">Email:</label>
                <input type="email" id="clientEmail" name="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required>

                <label for="clientPassword">Password:</label>
                <input type="password" id="clientPassword" name="clientPassword" required>

                <input class="button" type="submit" value="Sign-in">
                <input type="hidden" name="action" value="Login">
            </form>
            <a href="/phpmotors/accounts/index.php/?action=registration">Not a member yet?</a>
        </div>

    </main>

    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
    </footer>
    
</body>
</html>