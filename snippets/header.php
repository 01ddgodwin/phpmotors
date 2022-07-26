<div>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <img src="/phpmotors/images/site/logo.png" alt="Logo">
    <h2 class="headerContent">
        <?php 
        if(isset($_SESSION['clientData'])){
            echo "<a href='/phpmotors/accounts/index.php' class='headerAccount'>Welcome " . $_SESSION['clientData']['clientFirstName'] . " | </a>"; } 
        ?>
        
        <?php if(!isset($_SESSION['clientData'])) { 
            echo '<a class="headerAccount" href="/phpmotors/accounts/index.php/?action=login">My Account |</a>'; 
        } elseif(isset($_SESSION['clientData'])) { 
            echo "<a href='/phpmotors/accounts/index.php/?action=Logout' class='headerAccount'>Logout | </a>";}
        echo "<a class='material-icons searchIcon headerAccount' href='/phpmotors/vehicles/index.php/?action=search'>search</a>"
        ?>
    </h2>
</div>