<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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

        <h1 class="homeH1">Welcome to PHP Motors!</h1>
        <div class="deloreanParent">
            <div class="deloreanInfo">
                <h3>DMC Delorean</h3>
                <p>3 Cup dolders</p>
                <p>Superman doors</p>
                <p>Fuzzy dice!</p>
                <img src="../phpmotors/images/site/own_today.png" alt="Own Today!">
            </div>
            <img class="deloreanPic" src="../phpmotors/images/delorean.jpg" alt="Delorean">
        </div>

        <div class="reviewUpgradeGrid">
        <div class="deloreanReviews">
            <h1>DMC Delorean Reviews</h1>
            <ul>
                <li>"So fast its almost like traveling in time." (4/5)</li>
                <li>"Coolest ride on the road." (5/5)</li>
                <li>"I'm feeling Marty McFly!" (5/5)</li>
                <li>"The most futuristic ride of our day" (4.5/5)</li>
                <li>"80's livin and I love it!" (5/5)</li>
            </ul>
        </div>

        <div class="deloreanUpgrades">
            <h1>Delorean Upgrades</h1>
            <div class="upgradeContainer">
                <div class="box1">
                    <img class="flux" src="../phpmotors/images/upgrades/flux-cap.png" alt="Flux Capacitor">
                </div>
                <p class="fluxCaption">Flux Capacitor</p>
                <div class="box2">
                    <img class="flame" src="../phpmotors/images/upgrades/flame.jpg" alt="Flame Decals">
                </div>
                <p class="flameCaption">Flame Decals</p>
                <div class="box3">
                    <img class="stickers" src="../phpmotors/images/upgrades/bumper_sticker.jpg" alt="Bumper Stickers">
                </div>
                <p class="stickersCaption">Bumper Stickers</p>
                <div class="box4">
                    <img class="hub" src="../phpmotors/images/upgrades/hub-cap.jpg" alt="Hub Caps">
                </div>
                <p class="hubCaption">Hub Caps</p>

            </div>
        </div>
        </div>

    </main>

    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
    </footer>
    
</body>
</html>