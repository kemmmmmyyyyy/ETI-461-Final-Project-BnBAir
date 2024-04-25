<?php
session_start();
include 'db.php';

$propertyID = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($propertyID > 0) {
    $sql = "SELECT p.description, p.photoFull, p.price, p.beds, p.bathrooms, p.bedrooms, 
                   pa.propertyCity, pa.propertyState,
                   a.amenityDesc,
                   CONCAT(h.hostFirstName, ' ', h.hostLastName) AS hostName, 
                   h.hostEmailAddress AS hostEmail, h.hostNumber AS hostPhone
            FROM Property p
            JOIN PropertyAddress pa ON p.propertyAddressID = pa.propertyAddressID
            JOIN Host h ON p.hostID = h.hostID
            LEFT JOIN Amenities a ON p.propertyID = a.propertyID
            WHERE p.propertyID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $propertyID);
    $stmt->execute();
    $result = $stmt->get_result();
    $property = $result->fetch_assoc();

    if (!$property) {
        echo "No property found for this ID.";
        exit;
    }
    } else {
    echo "Invalid Property ID.";
    exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Details</title>
    <link rel="stylesheet" href="hotel_detail.css">
</head>
<body>
    <div class="top-logo">
        <a href="index.php">
            <img src="static/airbnb-logo.png" alt="BnB Air Logo" style="height: 50px;">
        </a>
    </div>

    <div class="hotel-detail-container">
        <h1>Details for <?php echo htmlspecialchars($property['description']); ?></h1>
        <img src="<?php echo htmlspecialchars($property['photoFull']); ?>" alt="Photo of the property" style="width:100%; height: auto;">
        <p><strong>Description:</strong> <?php echo nl2br(htmlspecialchars($property['description'])); ?></p>
        <p><strong>Price per night:</strong> $<?php echo htmlspecialchars($property['price']); ?></p>
        <p><strong>Beds:</strong> <?php echo htmlspecialchars($property['beds']); ?></p>
        <p><strong>Bathrooms:</strong> <?php echo htmlspecialchars($property['bathrooms']); ?></p>
        <p><strong>Bedrooms:</strong> <?php echo htmlspecialchars($property['bedrooms']); ?></p>
        <p><strong>Location:</strong> <?php echo htmlspecialchars($property['propertyCity'] . ', ' . $property['propertyState']); ?></p>
        <p><strong>Amenities:</strong> <?php echo htmlspecialchars($property['amenityDesc']); ?></p>
        <h2>Host Information</h2>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($property['hostName']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($property['hostEmail']); ?></p>
        <p><strong>Phone:</strong> <?php echo htmlspecialchars($property['hostPhone']); ?></p>

            <!-- Reserve Button -->
            <button class="reserve-button" onclick="window.location.href = 'index.php';">Reserve</button>


    </div>

</body>
</html>
