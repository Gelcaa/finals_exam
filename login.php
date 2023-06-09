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