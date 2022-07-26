<?php

/********************
//ACCOUNTS CONTROLLER
*********************/

//Create or access a session
session_start();

// Get the database connection file
require_once '/xampp/htdocs/phpmotors/library/connections.php';
// Get the PHP Motors model for use as needed
require_once '/xampp/htdocs/phpmotors/model/main-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';
// Get the functions library
require_once '../library/functions.php';

// Get the array of classifications
$classifications = getClassifications();

$navList = buildNav($classifications);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
}

// Check if the firstname cookie exists, get its value
if(isset($_COOKIE['firstname'])){
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
}

switch ($action) {
    case 'login':
        include '/xampp/htdocs/phpmotors/view/login.php';
        break;
    case 'registration':
        include '/xampp/htdocs/phpmotors/view/registration.php';
        break;
    case 'Login';
        
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientEmail = checkEmail($clientEmail);
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
        $checkPassword = checkPassword($clientPassword);

        if(empty($clientEmail) || empty($checkPassword)){
            $message = '<p class="notice">Please provide information for all empty form fields.</p>';
            include '../view/login.php';
            exit; 
        }

        // A valid password exists, proceed with the login process
        // Query the client data based on the email address
        $clientData = getClient($clientEmail);
        // Compare the password just submitted against
        // the hashed password for the matching client
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
        // If the hashes don't match create an error
        // and return to the login view
        if(!$hashCheck) {
        $message = '<p class="notice">Please check your password and try again.</p>';
        include '../view/login.php';
        exit;
        }
        // A valid user exists, log them in
        $_SESSION['loggedin'] = TRUE;
        // Remove the password from the array
        // the array_pop function removes the last
        // element from an array
        array_pop($clientData);
        // Store the array into the session
        $_SESSION['clientData'] = $clientData;
        // Send them to the admin view
        include '../view/admin.php';
        exit;
        break;
    case 'register':
        // Filter and store the data
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);
        $existingEmail = checkExistingEmail($clientEmail);

        // Check for existing email address in the table
        if($existingEmail){
            $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
        include '../view/login.php';
        exit;
        }

        // Check for missing data
        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/registration.php';
            exit; 
        }

        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        //Send the data to the model
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);
        
        if($regOutcome === 1){
            setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
            $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
            include '../view/login.php';
            exit;
        } else {
            $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include '../view/registration.php';
            exit;
        }

        break;
    case 'Logout':
        session_unset();
        session_destroy();
        if(!isset($_SESSION['clientData'])) {
            include '../view/login.php';;
            exit;
        }
        break;
    case 'getClients':
        // Get the clientId 
        $clientId = filter_input(INPUT_GET, 'clientId', FILTER_SANITIZE_NUMBER_INT); 
        // Fetch the client by clientId from the DB 
        $clientArray = getClientById($clientId); 
        // Convert the array to a JSON object and send it back 
        echo json_encode($clientArray);
        break;
    case 'mod':
        $clientID = $_SESSION['clientData']['clientID'];
        $clientInfo = getClientById($clientID);
        if (count($clientInfo) < 1) {
            $message = 'Sorry, no account information could be found.';
        }
        include '../view/client-update.php';
        exit;
        break;
    case 'updateAccount':
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientID = trim(filter_input(INPUT_POST, 'clientID', FILTER_VALIDATE_INT));

        // Check for missing data
        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
            $accountMessage = '<p>Please provide information for all empty form fields.</p>';
            include '../view/client-update.php';
            exit; 
        }

        $updateResult = updateAccount($clientFirstname, $clientLastname, $clientEmail, $clientID);
        if ($updateResult) {
            $message = "<p class='success'>Congratulations, $clientFirstname $clientLastname was successfully updated.</p>";
            $_SESSION['message'] = $message;
            $_SESSION['clientData']['clientFirstName'] = $clientFirstname;
            $_SESSION['clientData']['clientLastname'] = $clientLastname;
            $_SESSION['clientData']['clientEmail'] = $clientEmail;
            header('location: /phpmotors/accounts/');
            exit;
        } else {
            $accountMessage = "<p class='error'>Error. $clientFirstname $clientLastname was not updated.</p>";
            include '../view/client-update.php';
            exit;
        }
        break;
    case 'updatePassword':
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
        $checkPassword = checkPassword($clientPassword);
        $clientID = trim(filter_input(INPUT_POST, 'clientID', FILTER_VALIDATE_INT));

        // Check for missing data
        if(empty($checkPassword)) {
            $passMessage = '<p class="error">Please provide information for all empty form fields.</p>';
            include '../view/client-update.php';
            exit; 
        }
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        $updateResult = updatePassword($hashedPassword, $clientID);
        if ($updateResult) {
            $message = "<p class='success'>Congratulations, password was successfully updated.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/accounts/');
            exit;
        } else {
            $passMessage = "<p class='error'>Error. password was not updated.</p>";
            include '../view/client-update.php';
            exit;
        }
        break;
    default:
        include '/xampp/htdocs/phpmotors/view/admin.php';
    break;
   }
