<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT customerID, fName, password FROM Customer WHERE emailAddress = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['customerID'];
                $_SESSION['user_name'] = $row['fName'];
                $_SESSION['welcome_msg'] = "Welcome " . $row['fName'] . "!";
                header("Location: index.php");
                exit();
            } else {
                $_SESSION['error'] = 'Invalid password.';
                header("Location: signin.php");
                exit();
            }
        } else {
            $_SESSION['error'] = 'No user found with that email address.';
            header("Location: signin.php"); 
            exit();
        }
        $stmt->close();
    } else {
        $_SESSION['error'] = 'Error preparing statement: ' . $conn->error;
        header("Location: signin.php"); 
        exit();
    }
}
?>
