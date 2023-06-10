<!-- 6-10: 11:41 AM -->
<!-- home_products.php <script> -->
<script>
    const addToCartButtons = document.querySelectorAll('.add-to-cart');

    addToCartButtons.forEach(button => {
        button.addEventListener('click', function () {
            // const productId = button.id;
            const product = button.getAttribute('data-product');
            const addedText = 'Added';

            if (button.innerText !== addedText) {
                button.innerText = addedText;
                button.style.backgroundColor = 'blue';

                // Send an AJAX request to update the cart
                const xhr = new XMLHttpRequest();
                const url = 'test.php'; // Update the URL to match your server-side script

                // Fetch the username dynamically
                const username = '<?php echo isset($_SESSION["username"]) ? $_SESSION["username"] : "" ?>';

                const params = 'username=' + encodeURIComponent(username) + '&product=' + encodeURIComponent(product);

                // debug the JavaScript code 
                console.log('Username:', username);
                console.log('Product:', product);
                console.log('Params:', params);

                xhr.open('POST', url, true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Handle the successful response from the server
                            console.log(xhr.responseText);
                        } else {
                            // Handle the error response from the server
                            console.error('Request failed. Error code: ' + xhr.status);
                        }
                    }
                };

                xhr.send(params);

                setTimeout(function () {
                    button.innerText = 'Add to Cart';
                    button.style.backgroundColor = '#007bff';
                }, 3000);
            }
        });
    });
</script>



<!-- 6-10: 11:41 AM -->
<!-- test.php -->
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



<!-- 6-10: 12:00 PM -->
<!-- test.php -->
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

        // Insert the product into the cart table
        $sql = "INSERT INTO order_items (customer_id, product_name, quantity) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "iss", $customer_id, $product, $quantity);
        mysqli_stmt_execute($stmt);

        // Check if the insertion was successful
        if (mysqli_stmt_affected_rows($stmt) == 1) {
            echo "Product added to cart successfully.";
        } else {
            echo "Failed to add product to cart.";
        }
    } else {
        echo "Invalid customer.";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>



<!-- 6-10: 12:09 PM -->
<!-- test.php -->
<?php
session_start(); // Start the session

// Check if the user is logged in and retrieve the username
$username = isset($_SESSION["username"]) ? $_SESSION["username"] : "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the product and quantity from the request
    $product = $_POST["product"];
    $quantity = $_POST["quantity"];

    // Establish database connection
    $conn = mysqli_connect("localhost", "root", "", "stickerclubdb");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare SQL statement to check if the order item already exists for the customer and product
    $checkSql = "SELECT * FROM order_items WHERE username = ? AND product_name = ?";
    $checkStmt = mysqli_prepare($conn, $checkSql);
    mysqli_stmt_bind_param($checkStmt, "ss", $username, $product);
    mysqli_stmt_execute($checkStmt);
    $checkResult = mysqli_stmt_get_result($checkStmt);

    if (mysqli_num_rows($checkResult) > 0) {
        // Update the existing order item with the new quantity
        $updateSql = "UPDATE order_items SET quantity = quantity + ? WHERE username = ? AND product_name = ?";
        $updateStmt = mysqli_prepare($conn, $updateSql);
        mysqli_stmt_bind_param($updateStmt, "iss", $quantity, $username, $product);
        mysqli_stmt_execute($updateStmt);
    } else {
        // Insert a new order item if it doesn't already exist
        $insertSql = "INSERT INTO order_items (username, product_name, quantity) VALUES (?, ?, ?)";
        $insertStmt = mysqli_prepare($conn, $insertSql);
        mysqli_stmt_bind_param($insertStmt, "ssi", $username, $product, $quantity);
        mysqli_stmt_execute($insertStmt);
    }

    mysqli_stmt_close($checkStmt);
    mysqli_stmt_close($updateStmt);
    mysqli_stmt_close($insertStmt);
    mysqli_close($conn);
}
?>



<!-- WORKING add_to_cart.php -->
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

        // Insert the product into the cart table
        $sql = "INSERT INTO order_items (customer_id, product_name, quantity) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "iss", $customer_id, $product, $quantity);
        mysqli_stmt_execute($stmt);

        // Check if the insertion was successful
        if (mysqli_stmt_affected_rows($stmt) == 1) {
            echo "Product added to cart successfully.";
        } else {
            echo "Failed to add product to cart.";
        }
    } else {
        echo "Invalid customer.";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>