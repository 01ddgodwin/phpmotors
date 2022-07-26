<?php

/********************
//Vehicle Model
 *********************/

function getClassificationId()
{
    $db = phpmotorsConnect();
    // The SQL statement to be used with the database 
    $sql = 'SELECT classificationId, classificationName FROM carclassification ORDER BY classificationName ASC';
    // The next line creates the prepared statement using the phpmotors connection      
    $stmt = $db->prepare($sql);
    // The next line runs the prepared statement 
    $stmt->execute();
    // The next line gets the data from the database and 
    // stores it as an array in the $classifications variable 
    $classificationList = $stmt->fetchAll();
    // The next line closes the interaction with the database 
    $stmt->closeCursor();
    // The next line sends the array of data back to where the function 
    // was called (this should be the controller) 
    return $classificationList;
}

function insertClassification($classificationName)
{
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'INSERT INTO carclassification (classificationName)
        VALUES (:classificationName)';
    // Create the prepared statement using the phpmotors connection
    $Cstmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $Cstmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    // Insert the data
    $Cstmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $Cstmt->rowCount();
    // Close the database interaction
    $Cstmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

function insertCar($invId, $invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId)
{
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'INSERT INTO `inventory`(`invId`, `invMake`, `invModel`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invColor`, `classificationId`) 
            VALUES (:invId, :invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invColor, :classificationId)';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
    $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
    $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_STR);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

// Get vehicles by classificationId 
function getInventoryByClassification($classificationId)
{
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM inventory WHERE classificationId = :classificationId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
    $stmt->execute();
    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $inventory;
}

//Get vehicle information by invId
function getInvItemInfo($invId)
{
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM inventory WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
}

// This function will update a vehicle
function updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId)
{
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'UPDATE inventory SET invMake = :invMake, invModel = :invModel, invDescription = :invDescription, invImage = :invImage, invThumbnail = :invThumbnail, invPrice = :invPrice, invStock = :invStock, invColor = :invColor, classificationId = :classificationId WHERE invId = :invId';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
    $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
    $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

// This function will delete a vehicle
function deleteVehicle($invId)
{
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'DELETE FROM inventory WHERE invId = :invId';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

// This function will get a list of vehicles based on the classification
function getVehiclesByClassification($classificationName)
{
    $db = phpmotorsConnect();
    $sql = 'SELECT inventory.*, images.imgPath, images.imgId FROM inventory Join images ON inventory.invId=images.invId WHERE classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName) AND images.imgId % 2 = 0';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    $stmt->execute();
    $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $vehicles;
}

function getVehicleById($invId)
{
    $db = phpmotorsConnect();
    $sql = 'SELECT inv.*, img.imgPath, img.imgId
    FROM inventory AS inv
    JOIN images as img 
    ON inv.invId=img.invId 
    WHERE inv.invId = :invId AND img.imgId % 2 != 0';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
    $stmt->execute();
    $vehicle = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $vehicle;
}
