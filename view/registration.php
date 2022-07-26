<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
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
            <h1>Register</h1>


            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>

            <form method="POST" action="/phpmotors/accounts/index.php">
                <label for="clientFirstname">First Name:</label>
                <input type="text" id="fname" name="clientFirstname" <?php if (isset($clientFirstname)) {
                                                                            echo "value='$clientFirstname'";
                                                                        }  ?> required>

                <label for="clientLastname">Last Name:</label>
                <input type="text" id="lname" name="clientLastname" <?php if (isset($clientLastname)) {
                                                                        echo "value='$clientLastname'";
                                                                    }  ?> required>

                <label for="clientEmail">Email:</label>
                <input type="email" id="email" name="clientEmail" <?php if (isset($clientEmail)) {
                                                                        echo "value='$clientEmail'";
                                                                    }  ?> required>

                <p>Passwords must contain:</p>
                <ul>
                    <li>At least 8 characters</li>
                    <li>1 Number</li>
                    <li>1 Capital letter</li>
                    <li>1 Special character</li>
                </ul>
                <label for="clientPassword">Password:</label>
                <input type="password" id="password" name="clientPassword" required>

                <input class="button" type="submit" name="submit" id="regbtn" value="Register">
                <input type="hidden" name="action" value="register">
            </form>

            <a href="/phpmotors/accounts/index.php/?action=login">Already a member?</a>
        </div>
    </main>

    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
    <script src="/phpmotors/js/library.js"></script>
</body>

</html>