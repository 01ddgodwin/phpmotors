INSERT INTO clients (clientFirstname, clientLastName, clientEmail, clientPassword, clientLevel, comment)
VALUES ('Tony', 'Stark', 'tony@starknet.com', 'IamIronM@n', 1, 'I am the real Ironman');

UPDATE `clients` SET `clientLevel`=3 WHERE clientId = 4;

UPDATE inventory
SET invDescription = REPLACE(invDescription, 'small interiors', 'spacious interior')
WHERE invId = 12;

SELECT inventory.invModel, carclassification.classificationName
FROM carclassification
INNER JOIN inventory ON inventory.classificationId=carclassification.classificationId
WHERE carclassification.classificationName = "SUV";

DELETE FROM `inventory` WHERE invId = 1;

UPDATE inventory SET invImage=concat('/phpmotors',invImage);
UPDATE inventory SET invThumbnail=concat('/phpmotors',invThumbnail);
