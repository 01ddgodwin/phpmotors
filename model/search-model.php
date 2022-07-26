<?php

function getSearchResults($search, $offset, $resultsPerPage) {
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM inventory WHERE concat(invYear, invMake, invModel, invDescription, invPrice, invMiles, invColor) LIKE "%'.$search.'%" LIMIT '.$offset.', '.$resultsPerPage.';';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $search = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $search; 
}

function getTotalResults($search) {
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM inventory WHERE concat(invYear, invMake, invModel, invDescription, invPrice, invMiles, invColor) LIKE "%'.$search.'%";';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $search = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $search; 
}

?>