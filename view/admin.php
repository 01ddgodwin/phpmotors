<?php
if($_SESSION['loggedin'] = FALSE) {
    header("Location: /index.php");
} elseif($_SESSION['loggedin'] = FALSE) {
    echo "<a>Logout</a>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Management</title>
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
    <div class="formContentAreaAdmin">
        <div class="mainArea">
        <h1><?php echo $_SESSION['clientData']['clientFirstName'] . " " . $_SESSION['clientData']['clientLastname'];?></h1>
        <ul>
            <li>First Name: <?php echo $_SESSION['clientData']['clientFirstName'];?></li>
            <li>Last Name: <?php echo $_SESSION['clientData']['clientLastname'];?></li>
            <li>Email: <?php echo $_SESSION['clientData']['clientEmail'];?></li>
        </ul>

        <?php
        echo message();
        clearMessage();
        ?>
        <fieldset>  
            <legend><h1>Account Management</h1></legend>
            <p>Use this link to update account information.</p>
            <a href="/phpmotors/accounts/index.php/?action=mod" class="button">Update Account Information</a>
        </fieldset>
        
        <?php
            if($_SESSION['clientData']['clientLevel'] > 1) {
                echo '<fieldset>';
                echo '<legend><h1>Inventory Management</h1></legend>';
                echo '<p>Use this link to manage the inventory.</p>';
                echo '<a href="/phpmotors/vehicles/" class="button">Vehicle Management</a>';
                echo '</fieldset>';
            }
        ?>
        </div>
    </div>
    </main>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
    </footer>
</body>
</html>
<?php unset($_SESSION['message']); ?>