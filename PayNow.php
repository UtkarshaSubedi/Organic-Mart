<?php include 'navigation.php';
$cart = $_SESSION['cart'];

?>

<style>
    .container {
        width: 80%;
        margin: auto auto;
    }

    input[type=submit] {
        padding: 10px;
        background-color: #2A9D74;
        color: white;
        border: none;
    }

    #del {
        padding: 10px;
        border: none;
        background-color: #ba181b;
    }

    #del a {
        color: white;
    }

    #check {
        background-color: #FDD261;
        color: black;
    }

    td {
        padding: 10px;
        border: 1px solid black;
    }

    th {
        padding: 10px;
        border: 2px solid black;
    }

    img {
        width: 80px;
        height: 80px;
    }
</style>

<body>
    <div class="container">

        <?php
        include 'connection.php';
        $cart = $_SESSION['cart'];
        ?>
        <div class="yourOrdr">
            <h2>Your Order:</h2>
            <table class="table">
                <thead>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total Price</th>
                </thead>
                <tbody>
                    <?php
                    //print_r($cart); 
                    $sno = 1;
                    $total = 0;
                    foreach ($cart as $key => $values) {
                        $cartSql = "SELECT * FROM P_PRODUCT WHERE PRODUCT_ID=$key";
                        $cartres = mysqli_query($connection, $cartSql);
                        $cartr = mysqli_fetch_assoc($cartres);
                        $insCart = "INSERT INTO C_CART";
                        $cartidsql = "SELECT CART_ID FROM C_CART, P_PRODUCT WHERE P_PRODUCT.PRODUCT_ID= '$key' AND C_CART.PRODUCT_ID = P_PRODUCT.PRODUCT_ID";
                        $cartidr = mysqli_query($connection, $cartidsql);
                        $cartidrow = mysqli_fetch_assoc($cartidr);



                        
                    ?>
                        <tr>
                            <td>
                                <?php echo $sno++ ?>
                            </td>
                            <td>
                                <?php echo $cartr['PRODUCTNAME'] ?>
                            </td>
                            <td>
                                <img width="100px" height="100px" src="IMAGES/<?php echo $cartr['PRODUCTIMAGE'] ?>" alt="">
                            </td>
                            <td>
                                <?php echo $values['quantity']; ?>
                            </td>
                            <td>
                                <?php echo '$' . $cartr['PRICE'] ?>
                            </td>
                            <td>
                                <?php echo $cartr['PRICE'] * $values['quantity']; ?>
                            </td>

                        </tr>


                        <?php $total = $total + $cartr['PRICE'] * $values['quantity'] ?>

                    <?php } ?>
                </tbody>
            </table>

            <div class="totalcheck">
                <div class="total">
                    <h3>Your Total:</h3>
                    <p><?php echo '$' . $total; ?></p>
                </div>
            </div>
        </div>

        <?php
        foreach ($cart as $key => $values) {
            $cartidsql = "SELECT CART_ID FROM C_CART, P_PRODUCT WHERE P_PRODUCT.PRODUCT_ID= '$key' AND C_CART.PRODUCT_ID = P_PRODUCT.PRODUCT_ID";
            $cartidr = mysqli_query($connection, $cartidsql);
            $cartidrow = mysqli_fetch_assoc($cartidr);
        } ?>

        <div id="signup"> </div>
        </form>
    </div>
    <!-- <script src="https://www.paypalobjects.com/api/checkout.js"></script> -->
    <!-- <script src="https://www.paypal.com/sdk/js?client-id=AR9QM_ecllwIlAOj-d9IPW2j75zUoYs0jT4TzRZKgiVe6WtcCKebZKdBW-w3oVeIsPDxlkMIWB4JBT6V&disable-funding=credit,card"></script> -->


    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <script>
        paypal.Button.render({
            // Configure environment
            env: 'sandbox',
            client: {
                sandbox: 'AcQhyzPnBNFokSpsVtjSe-oW_3r9TaxtSDLcUrCgAKFnxibONZ9Lf7LdDuVEqMDEm1ccbbrbPJFCR5RJ'
            },
            // Set up a payment
            payment: function(data, actions) {
                console.log(data)
                return actions.payment.create({
                    transactions: [{
                        amount: {
                            total: <?php echo "$total" ?>,
                            currency: 'GBP'
                        }
                    }]
                });
            },
            // Execute the payment
            onAuthorize: function(data, actions) {
                return actions.payment.execute().then(function() {
                    window.location.replace('http://localhost/ORGANICMART/Success.php')
                });
            },
            onCancel: function(data) {
                window.location.replace('http://localhost/ORGANICMART/Cancel.php')
            }
        }, '#signup');
    </script>
</body>