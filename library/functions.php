<?php

function checkEmail($clientEmail) {
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

// Check the password for a minimum of 8 characters,
// at least one 1 capital letter, at least 1 number and
// at least 1 special character
function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
}

function buildNav($classifications) {
    // Build a navigation bar using the $classifications array
    $navList = '<ul>';
    $navList .= "<li><a href='/index.php' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
        $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
    }
    $navList .= '</ul>';
    return $navList;
}

// Build the classifications select list 
function buildClassificationList($classifications){ 
    $classificationList = '<select name="classificationId" id="classificationList">'; 
    $classificationList .= "<option>Choose a Classification</option>"; 
    foreach ($classifications as $classification) { 
     $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
    } 
    $classificationList .= '</select>'; 
    return $classificationList; 
   }

function message($msg = '') {
    if(!empty($msg)) {
        $_SESSION['message'] = $msg;
    } elseif (isset($_SESSION['message'])) {
        $msg = $_SESSION['message'];
        return $msg;
    }
}

function clearMessage() {
    unset($_SESSION['message']);
}

//This function will build a display of vehicles within an unordered list
function buildVehiclesDisplay($vehicles){
    $dv = '<ul id="inv-display">';
    foreach ($vehicles as $vehicle) {
     $dv .= "<li>"."<a href='/phpmotors/vehicles/?action=vehicle&invId=".urlencode($vehicle['invId'])."'>";
     $dv .= "<img src='$vehicle[imgPath]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
     $dv .= '<hr>';
     $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2></a>";
     $priceFormat = number_format($vehicle['invPrice']);
     $dv .= "<span>$$priceFormat</span>";
     $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;
}

//This function will display the chosen vehicle
function buildSelectedDisplay($vehicle) {
    $dv = '<ul id="vehicleUl">';
    foreach ($vehicle as $item) {
    $dv .= '<li id="vehicleDisplay">';
    $dv .= "<img src='$item[imgPath]' alt='Image of $item[invMake] $item[invModel] on phpmotors.com'>";
    $dv .= "<div id='invGrid'><h2 id='details'>$item[invMake] $item[invModel] Details</h2>";
    $dv .= "<span id='description'>$item[invDescription]</span>";
    $dv .= "<span id='color'>Color: $item[invColor]</span>";
    // $dv .= "<span id='stock'># in stock: $item[invStock]</span>";
    $priceFormat = number_format($item['invPrice']);
    $dv .= "<span id='price'>Price: $$priceFormat</span></div>";
    $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;
}

function buildSearchDisplay($results, $search, $totalPages) {
    $resultCount = count($totalPages);
    $dv = '<h2>Returned '.$resultCount.' results for: '.$search.'</h2>';
    if ($resultCount >= 1) {
        $dv .= '<ul class="vehicleUl">';
        foreach ($results as $result) {
        $dv .= '<li>';
        $dv .= "<div class='invGrid'><a href='/phpmotors/vehicles/?action=vehicle&invId=".urlencode($result['invId'])."'><h2 class='details'>$result[invYear] $result[invMake] $result[invModel] </h2></a>";
        $dv .= "<span class='description'>$result[invDescription]</span></div>";
        $dv .= '</li>';
        }
        $dv .= '</ul>';
    } elseif ($search == '') {
        $dv .= "<p class='error'>You must provide a search.</p>";
    } else {
        $dv .= '<p class="error">Sorry, your search could not be found.</p>';
    }
    return $dv;
}

function pagDisplay($page, $totalPages, $search) {
    $dv = '<span class="pagination">';
    if($totalPages == 0) {
        $dv .= '';
    } else {
        $dv .= '<a href="/phpmotors/vehicles/index.php/POST?search='.$search.'&submit=Search&action=getSearch&page=1"> &lt;&lt; </a>';
    }
    if($page <= 1){ 
        $dv .= ''; 
    } else { 
        $dv .= '<a href="/phpmotors/vehicles/index.php/POST?search='.$search.'&submit=Search&action=getSearch&page='. $page - 1 .'"> &lt; </a>'; 
    } 
    for ($pages = 1; $pages <= $totalPages; $pages++) {
        $dv .= '<a href="/phpmotors/vehicles/index.php/POST?search='.$search.'&submit=Search&action=getSearch&page='.$pages.'">'.$pages.' </a>';
    }
    if($page >= $totalPages){ 
        $dv .= ''; 
    } else { 
        $dv .= '<a href="/phpmotors/vehicles/index.php/POST?search='.$search.'&submit=Search&action=getSearch&page='. $page + 1 .'"> &gt; </a>'; 
    }
    if($totalPages == 0) {
        $dv .= '';
    } else {
        $dv .= '<a href="/phpmotors/vehicles/index.php/POST?search='.$search.'&submit=Search&action=getSearch&page='.$totalPages.'"> &gt;&gt; </a>';
    }
    $dv .= '</span>';
    return $dv;
}
?>