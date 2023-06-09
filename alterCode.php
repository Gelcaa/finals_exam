<!-- login.php -->
<?php
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Establish database connection
    $conn = mysqli_connect("localhost", "root", "", "stickerclubdb"); // Replace "your_database_name" with the actual database name
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare SQL statement to prevent SQL injection
    $sql = "SELECT * FROM customertbl WHERE username = ? AND password = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION["username"] = $username; // Store the username in the session
        header("Location: home_products.php");
        exit; // Make sure to exit after redirection
    } else {
        echo '<script>alert("Invalid username or password. Please try again."); window.location.href = "login.html";</script>';
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>

<!-- test.php -->
<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Retrieve the username and product name from the POST parameters
    $username = $_POST['username'];
    $product = $_POST['product'];

    // Perform database operations to update the order_items table
    // Increment the quantity for the specified product and username

    // Establish database connection
    $conn = mysqli_connect("localhost", "root", "", "stickerclubdb");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Increment the quantity for the specified product and username
    $stmt = $conn->prepare("UPDATE order_items AS oi
                            INNER JOIN customers AS c ON oi.customer_id = c.customer_id
                            SET oi.quantity = oi.quantity + 1
                            WHERE c.username = ? AND oi.product_name = ?");
    $stmt->bind_param("ss", $username, $product);

    if (!$stmt->execute()) {
        // Handle the SQL update error
        echo "Failed to update quantity: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    // Return a response to the client if needed
    echo "Quantity updated successfully.";
?>