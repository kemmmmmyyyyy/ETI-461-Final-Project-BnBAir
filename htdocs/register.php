<?php
include 'db.php'; 

session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $conn->real_escape_string($_POST['firstname']);
    $lastName = $conn->real_escape_string($_POST['lastname']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    $birthdate = $_POST['birthdate'];
    $street = $conn->real_escape_string($_POST['street']);
    $city = $conn->real_escape_string($_POST['city']);
    $state = $conn->real_escape_string($_POST['state']);
    $zipcode = $conn->real_escape_string($_POST['zipcode']);
    $phone = $conn->real_escape_string($_POST['phone']);

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO Customer (fName, lName, emailAddress, password, birthday, customerAddress, customerCity, customerState, customerZipCode, customerPhoneNumber) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssssssss", $firstName, $lastName, $email, $hashed_password, $birthdate, $street, $city, $state, $zipcode, $phone);
        
        if ($stmt->execute()) {
            header("Location: registration_success.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
    
    $conn->close();
}
?>
