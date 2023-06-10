<?php
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $product = $_POST["product"];
    $quantity = $_POST["quantity"];

    // Establish database connection
    $conn = mysqli_connect("localhost", "root", "", "stickerclubdb");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if the customer exists
    $sql = "SELECT username FROM customertbl WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {
        // Fetch the customer's username
        $row = mysqli_fetch_assoc($result);
        $customer_username = $row["username"];

        // Check if the product already exists in the order_items table
        $sql = "SELECT quantity FROM order_items WHERE customer_username = ? AND product_name = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $customer_username, $product);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 1) {
            // Product already exists, update the quantity
            $row = mysqli_fetch_assoc($result);
            $existingQuantity = $row["quantity"];

            $updateSql = "UPDATE order_items SET quantity = ? WHERE customer_username = ? AND product_name = ?";
            $updateStmt = mysqli_prepare($conn, $updateSql);
            $newQuantity = $existingQuantity + $quantity;
            mysqli_stmt_bind_param($updateStmt, "iss", $newQuantity, $customer_username, $product);
            mysqli_stmt_execute($updateStmt);
            mysqli_stmt_close($updateStmt);

            echo "Product quantity updated successfully.";
        } else {
            // Product does not exist, insert a new row
            $insertSql = "INSERT INTO order_items (customer_username, product_name, quantity) VALUES (?, ?, ?)";
            $insertStmt = mysqli_prepare($conn, $insertSql);
            mysqli_stmt_bind_param($insertStmt, "ssi", $customer_username, $product, $quantity);
            mysqli_stmt_execute($insertStmt);
            mysqli_stmt_close($insertStmt);

            echo "Product added to cart successfully.";
        }
    } else {
        echo "Invalid customer.";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>