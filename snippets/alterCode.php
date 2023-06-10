<!-- home_products.php <script> -->
<?php
session_start(); // Start the session

// Check if the user is logged in and retrieve the username
$username = isset($_SESSION["username"]) ? $_SESSION["username"] : "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Your head content -->
</head>

<body>
    <main>
        <!-- Your HTML content -->
    </main>

    <script>
        // Retrieve the add-to-cart buttons
        var addToCartButtons = document.querySelectorAll('.add-to-cart');

        // Add event listeners to each add-to-cart button
        addToCartButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                const addedText = 'Added';
                var product = this.getAttribute('data-product');
                var quantity = 1; // Initial quantity

                if (button.innerText !== addedText) {
                    button.innerText = addedText;
                    button.style.backgroundColor = 'blue';

                    // Send an AJAX request to a PHP script to handle the cart update
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'add_to_cart.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                            // Handle the response
                            console.log(xhr.responseText);
                        }
                    };

                    // Construct the request data
                    var requestData = 'username=<?php echo urlencode($username); ?>&product=' + encodeURIComponent(product) + '&quantity=' + quantity;

                    // Send the request
                    xhr.send(requestData);
                });
        });
    </script>
</body>

</html>



// test.php / add_to_cart.php
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
    $sql = "SELECT id FROM customertbl WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $customer_id = $row["id"];
        // Update the existing order item with the new quantity
        $updateSql = "UPDATE order_items SET quantity = quantity + ? WHERE customer_id = ? AND product_name = ?";
        $updateStmt = mysqli_prepare($conn, $updateSql);
        mysqli_stmt_bind_param($updateStmt, "iis", $quantity, $customer_id, $product);
        mysqli_stmt_execute($updateStmt);
    } else {
        // Insert a new order item if it doesn't already exist
        $insertSql = "INSERT INTO order_items (customer_id, product_name, quantity) VALUES (?, ?, ?)";
        $insertStmt = mysqli_prepare($conn, $insertSql);
        mysqli_stmt_bind_param($insertStmt, "isi", $customer_id, $product, $quantity);
        mysqli_stmt_execute($insertStmt);
    }

    mysqli_stmt_close($checkStmt);
    mysqli_stmt_close($updateStmt);
    mysqli_stmt_close($insertStmt);
    mysqli_close($conn);
}
?>