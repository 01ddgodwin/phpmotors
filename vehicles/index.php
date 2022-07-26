<?php

/********************
//VEHICLES CONTROLLER
 *********************/

//Create or access a session
session_start();

// Get the database connection file
require_once '/xampp/htdocs/phpmotors/library/connections.php';
// Get the PHP Motors model for use as needed
require_once '/xampp/htdocs/phpmotors/model/main-model.php';
// Get the Vehicle model for use as needed
require_once '/xampp/htdocs/phpmotors/model/vehicle-model.php';
// Get the Search model for use as needed
require_once '/xampp/htdocs/phpmotors/model/search-model.php';
// Get the functions library
require_once '../library/functions.php';

// Get the array of classifications
$classifications = getClassifications();

$classificationList = getClassificationId();

$navList = buildNav($classifications);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

// Check if the firstname cookie exists, get its value
if (isset($_COOKIE['firstname'])) {
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
}

switch ($action) {
    case 'vehicle-management':
        include '/xampp/htdocs/phpmotors/view/vehicle-management.php';
        break;
    case 'add-classification':
        include '/xampp/htdocs/phpmotors/view/add-classification.php';
        break;
    case 'send-classification':
        // echo 'You are in the send classification case statement.';
        // Filter and store the data
        $classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_STRING));

        // Check for missing data
        if (empty($classificationName)) {
            $classMessage = '<p class="error">Please provide information for empty form fields.</p>';
            include '../view/add-classification.php';
            exit;
        }

        //Send the data to the model
        $insertOutcome = insertClassification($classificationName);

        if ($insertOutcome === 1) {
            $classMessage = "<p class='success'>Classificaion added successfully</p>";
            include '../view/add-classification.php';
            exit;
        } else {
            $classMessage = "<p class='error'>Sorry, but adding the classification failed. Please try again.</p>";
            include '../view/add-classification.php';
            exit;
        }
        break;
    case 'add-vehicle':
        include '/xampp/htdocs/phpmotors/view/add-vehicle.php';
        break;
    case 'send-vehicle':
        // Filter and store the data
        $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_STRING));
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
        $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING));
        $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING));
        $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_STRING, FILTER_FLAG_ALLOW_FRACTION));
        $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_STRING));
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));
        $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_STRING));

        trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));

        // Check for missing data
        if (empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)) {
            $classMessage = '<p  class="error">Please provide information for empty form fields.</p>';
            include '../view/add-vehicle.php';
            exit;
        }

        //Send the data to the model
        $insertOutcome = insertCar($invId, $invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);

        if ($insertOutcome === 1) {
            $classMessage = "<p class='success'>The $invMake $invModel was added successfully</p>";
            include '../view/add-vehicle.php';
            exit;
        } else {
            $classMessage = "<p class='error'>Sorry, but adding the vehicle failed. Please try again.</p>";
            include '../view/add-vehicle.php';
            exit;
        }
        break;
        /* * ********************************** 
    * Get vehicles by classificationId 
    * Used for starting Update & Delete process 
    * ********************************** */
    case 'getInventoryItems':
        // Get the classificationId 
        $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
        // Fetch the vehicles by classificationId from the DB 
        $inventoryArray = getInventoryByClassification($classificationId);
        // Convert the array to a JSON object and send it back 
        echo json_encode($inventoryArray);
        break;
    case 'mod':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if (count($invInfo) < 1) {
            $message = 'Sorry, no vehicle information could be found.';
        }
        include '../view/vehicle-update.php';
        exit;
        break;
    case 'updateVehicle':
        $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
        $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
        $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
        $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
        $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING);
        $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT));

        if (empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)) {
            $message = '<p class="error">Please complete all information for the item! Double check the classification of the item.</p>';
            include '../view/vehicle-update.php';
            exit;
        }
        $updateResult = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId);
        if ($updateResult) {
            $message = "<p class='success'>Congratulations, the $invMake $invModel was successfully updated.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p class='error'>Error. the $invMake $invModel was not updated.</p>";
            include '../view/vehicle-update.php';
            exit;
        }
        break;
    case 'del':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if (count($invInfo) < 1) {
            $message = 'Sorry, no vehicle information could be found.';
        }
        include '../view/vehicle-delete.php';
        exit;
        break;
    case 'deleteVehicle':
        $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
        $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
        $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT));

        $deleteResult = deleteVehicle($invId);
        if ($deleteResult) {
            $message = "<p class='success'>Congratulations, the $invMake $invModel was successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p class='error'>Error. the $invMake $invModel was not deleted.</p>";
            include 'location: /phpmotors/vehicles/';
            exit;
        }
        break;
    case 'classification':
        $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_STRING);
        $vehicles = getVehiclesByClassification($classificationName);
        if (!count($vehicles)) {
            $message = "<p class='error'>Sorry, no $classificationName vehicles could be found.</p>";
        } else {
            $vehicleDisplay = buildVehiclesDisplay($vehicles);
        }
        include '../view/classification.php';
        break;
    case 'vehicle':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_STRING);
        $vehicle = getVehicleById($invId);
        if (!count($vehicle)) {
            $message = "<p class='error'>Sorry, no vehicle could be found.</p>";
        } else {
            $selectVehicleDisplay = buildSelectedDisplay($vehicle);
        }
        include '../view/vehicle.php';
        break;
    case 'search':
        include '../view/search.php';
        break;
    case 'getSearch':
        
        $page = 1;
        
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        
        $resultsPerPage = 10;
        $offset = ($page - 1) * $resultsPerPage;
        
        $search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING);

        // if ($search == '') {
        //     $message = "<p class='error'>You must provide a search.</p>";
        //     $results = 0;
        // }

        $results = getSearchResults($search, $offset, $resultsPerPage);
        $totalResults = getTotalResults($search);
        $totalPages = ceil(count($totalResults) / $resultsPerPage);

        $pagDisplay = pagDisplay($page, $totalPages, $search);

        if ($search == '') {
            $searchDisplay = "<p class='error'>You must provide a search.</p>";
            $pagDisplay = "";
        } elseif ($totalPages = 0 && $totalResults = 0) {
            $message = "<p class='error'>Sorry, your search could not be found.</p>";
        } elseif ($totalResults > 0) {
            $searchDisplay = buildSearchDisplay($results, $search, $totalResults);
        }
        include '../view/search.php';
        break;
    default:
        $classificationList = buildClassificationList($classifications);

        include '/xampp/htdocs/phpmotors/view/vehicle-management.php';
        break;
}
