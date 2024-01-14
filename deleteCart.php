<?php 
    session_start();

    if(isset($_GET['PRODUCT_ID']) & !empty($_GET['PRODUCT_ID'])) {
        $PRODUCT_ID = $_GET['PRODUCT_ID'];
        unset($_SESSION['cart'][$PRODUCT_ID]);
        header('location: Cart.php');
    }
?>