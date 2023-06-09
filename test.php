<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);    
    // Retrieve the username and product identifier from the POST parameters
    $username = $_POST['username'];
    $product = $_POST['product'];

    // Perform database operations to update the customertbl table
    // Increment the orderQty for the specified product and username
    // You can use prepared statements or any other preferred method to interact with the database

    // Establish database connection
    $conn = mysqli_connect("localhost", "root", "", "stickerclubdb");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Increment the orderQty for the specified product and username
    $stmt = $conn->prepare("UPDATE customertbl SET orderQty = orderQty + 1 WHERE username = ? AND orderItem = ?");
    $stmt->bind_param("ss", $username, $product);

    if (!$stmt->execute()) {
        // Handle the SQL update error
        echo "Failed to update order quantity: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    // Return a response to the client if needed
    echo "Item added to cart.";
?>