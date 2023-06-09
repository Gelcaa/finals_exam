<?php
session_start(); // Start the session

// Check if the user is logged in and retrieve the username
$username = isset($_SESSION["username"]) ? $_SESSION["username"] : "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- displays site properly based on user's device -->
    <link href="home_products.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon-32x32.png">
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&display=swap" rel="stylesheet">
    <title>Sticker Club | Home</title>

</head>

<body>
    <main>
        <div class="row">
            <div class="column">
                <div class="flex-box">
                    <div class="top-image">
                        <img src="images/11.png" class="equilibrium-image" alt="aespa-sticker">
                        <div class="icon-background">
                            <img src="images/icon-view.svg" class="icon-view">
                        </div>
                    </div>

                    <div class="equilibrium-header">K-pop Aespa Vinyl</div>

                    <p> Celebrate the magic of K-pop with Aespa.</p>

                    <div class="crypto-cost"><img src="images/icon-ethereum.svg" class="icon" alt="ethereum icon">29 PHP
                        <span><button class="add-to-cart" id="product1" data-product="K-pop Aespa">Add to
                                Cart</button></span>
                    </div>
                    <hr>
                    <div class="creation"><img src="images/stickerclub circle logo PNG.png" class="icon-avatar"
                            alt="clock icon">
                        <div class="creation-name"><span>Category </span>K-Pop</div>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="flex-box">
                    <div class="top-image">
                        <img src="images/33.png" class="equilibrium-image" alt="jujutsu-sticker">
                        <div class="icon-background">
                            <img src="images/icon-view.svg" class="icon-view">
                        </div>
                    </div>

                    <div class="equilibrium-header">Jujutsu Kaisen Vinyl</div>

                    <p> Enter the dark world of Jujutsu Kaisen.</p>

                    <div class="crypto-cost"><img src="images/icon-ethereum.svg" class="icon" alt="ethereum icon">25 PHP
                        <span><button class="add-to-cart" id="product2" data-product="Jujutsu Kaisen">Add to
                                Cart</button></span>
                    </div>
                    <hr>
                    <div class="creation"><img src="images/stickerclub circle logo PNG.png" class="icon-avatar"
                            alt="clock icon">
                        <div class="creation-name"><span>Category </span>Anime</div>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="flex-box">
                    <div class="top-image">
                        <img src="images/39.png" class="equilibrium-image" alt="nwjns-sticker">
                        <div class="icon-background">
                            <img src="images/icon-view.svg" class="icon-view">
                        </div>
                    </div>

                    <div class="equilibrium-header">NewJeans Vinyl</div>

                    <p> Express your style of fashion and self-expression with NewJeans.</p>

                    <div class="crypto-cost"><img src="images/icon-ethereum.svg" class="icon" alt="ethereum icon">29 PHP
                        <span><button class="add-to-cart" id="product3" data-product="NewJeans">Add to
                                Cart</button></span>
                    </div>
                    <hr>
                    <div class="creation"><img src="images/stickerclub circle logo PNG.png" class="icon-avatar"
                            alt="clock icon">
                        <div class="creation-name"><span>Category </span>K-Pop</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="column">
                <div class="flex-box">
                    <div class="top-image">
                        <img src="images/45.png" class="equilibrium-image" alt="pinoy-2.0">
                        <div class="icon-background">
                            <img src="images/icon-view.svg" class="icon-view">
                        </div>
                    </div>

                    <div class="equilibrium-header">Pinoy 2.0 Stickers Vinyl</div>

                    <p> Show your Pinoy pride with these vibrant stickers.</p>

                    <div class="crypto-cost"><img src="images/icon-ethereum.svg" class="icon" alt="ethereum icon">25 PHP
                        <span><button class="add-to-cart" id="product4" data-product="Pinoy 2.0">Add to
                                Cart</button></span>
                    </div>
                    <hr>
                    <div class="creation"><img src="images/stickerclub circle logo PNG.png" class="icon-avatar"
                            alt="clock icon">
                        <div class="creation-name"><span>Category </span>Pinoy</div>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="flex-box">
                    <div class="top-image">
                        <img src="images/53.png" class="equilibrium-image" alt="strawberry-kiwi">
                        <div class="icon-background">
                            <img src="images/icon-view.svg" class="icon-view">
                        </div>
                    </div>

                    <div class="equilibrium-header">Strawberry & Kiwi Dessert</div>

                    <p> Indulge in the sweetness of Strawberry & Kiwi.</p>

                    <div class="crypto-cost"><img src="images/icon-ethereum.svg" class="icon" alt="ethereum icon">35 PHP
                        <span><button class="add-to-cart" id="product5" data-product="S&K">Add to
                                Cart</button></span>
                    </div>
                    <hr>
                    <div class="creation"><img src="images/stickerclub circle logo PNG.png" class="icon-avatar"
                            alt="clock icon">
                        <div class="creation-name"><span>Category </span>StickerClub Line</div>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="flex-box">
                    <div class="top-image">
                        <img src="images/56.png" class="equilibrium-image" alt="pinoy-3.0">
                        <div class="icon-background">
                            <img src="images/icon-view.svg" class="icon-view">
                        </div>
                    </div>

                    <div class="equilibrium-header">Pinoy 3.0 Stickers Vinyl</div>

                    <p> Upgrade your sticker game with Pinoy 3.0.</p>

                    <div class="crypto-cost"><img src="images/icon-ethereum.svg" class="icon" alt="ethereum icon">25 PHP
                        <span><button class="add-to-cart" id="product6" data-product="Pinoy 3.0">Add to
                                Cart</button></span>
                    </div>
                    <hr>
                    <div class="creation"><img src="images/stickerclub circle logo PNG.png" class="icon-avatar"
                            alt="clock icon">
                        <div class="creation-name"><span>Category </span>Pinoy</div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
    </div>
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
</body>

</html>