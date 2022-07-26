<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Info | PHP Motors</title>
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
            <h1>Manage Account</h1>
            <fieldset>
                <legend>
                    <h2>Update Account</h2>
                </legend>
                <?php
                if (isset($accountMessage)) {
                    echo $accountMessage;
                }
                ?>
                <form method="POST" action="/phpmotors/accounts/index.php">
                    <label for="clientFirstname">First Name: </label>
                    <input id="clientFirstname" name="clientFirstname" type="text" value="<?php if (isset($_SESSION['clientData']['clientFirstName'])) {
                                                                                                echo $_SESSION['clientData']['clientFirstName'];
                                                                                            } elseif (isset($_SESSION['clientData']['clientFirstName'])) {
                                                                                                echo $_SESSION['clientData']['clientFirstName'];
                                                                                            } ?>" required>

                    <label for="clientLastname">Last Name: </label>
                    <input id="clientLastname" name="clientLastname" type="text" value="<?php if (isset($_SESSION['clientData']['clientLastname'])) {
                                                                                            echo $_SESSION['clientData']['clientLastname'];
                                                                                        } elseif (isset($_SESSION['clientData']['clientLastname'])) {
                                                                                            echo $_SESSION['clientData']['clientLastname'];
                                                                                        } ?>" required>

                    <label for="clientEmail">Email: </label>
                    <input id="clientEmail" name="clientEmail" type="text" value="<?php if (isset($_SESSION['clientData']['clientEmail'])) {
                                                                                        echo $_SESSION['clientData']['clientEmail'];
                                                                                    } elseif (isset($_SESSION['clientData']['clientEmail'])) {
                                                                                        echo $_SESSION['clientData']['clientEmail'];
                                                                                    } ?>" required>

                    <input class="button" type="submit" name="submit" value="Update Info">
                    <input type="hidden" name="action" value="updateAccount">
                    <input type="hidden" name="clientID" value="<?php if (isset($_SESSION['clientData']['cliendID'])) {
                                                                    echo $_SESSION['clientData']['clientID'];
                                                                } elseif (isset($_SESSION['clientData']['clientID'])) {
                                                                    echo $_SESSION['clientData']['clientID'];
                                                                } ?>">

                </form>
            </fieldset>

            <fieldset>
                <legend>
                    <h2>Update Password</h2>
                </legend>
                <?php
                if (isset($passMessage)) {
                    echo $passMessage;
                }
                ?>
                <form method="POST" action="/phpmotors/accounts/index.php">
                    <p>Passwords must contain:</p>
                    <ul>
                        <li>At least 8 characters</li>
                        <li>1 Number</li>
                        <li>1 Capital letter</li>
                        <li>1 Special character</li>
                    </ul>
                    <label for="clientPassword">Password: </label>
                    <input id="clientPassword" name="clientPassword" type="text" required>

                    <input class="button" type="submit" name="submit" value="Update Password">
                    <input type="hidden" name="action" value="updatePassword">
                    <input type="hidden" name="clientID" value="<?php if (isset($_SESSION['clientData']['cliendID'])) {
                                                                    echo $_SESSION['clientData']['clientID'];
                                                                } elseif (isset($_SESSION['clientData']['clientID'])) {
                                                                    echo $_SESSION['clientData']['clientID'];
                                                                } ?>">
                </form>
            </fieldset>

        </div>
    </main>

    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>

    <script src="/phpmotors/js/inventory.js"></script>
</body>

</html>
<?php unset($_SESSION['message']); ?>