<?php
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    // Establish database connection
    $conn = mysqli_connect("localhost", "root", "", "stickerclubdb");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Perform a SQL query to insert the new user into the database
    $sql = "INSERT INTO customertbl (username, password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        mysqli_close($conn);

        // Display a registration successful pop-up
        $_SESSION["username"] = $username; // Store the username in the session
        echo '<script>alert("Registration Successful!");</script>';
        // Redirect to home_products.php
        echo '<script>window.location.href = "home_products.php";</script>';
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    mysqli_close($conn);
}
?>