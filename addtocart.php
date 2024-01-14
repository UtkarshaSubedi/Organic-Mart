<?php  
    session_start();

    if(isset($_GET) & !empty($_GET)) {
        $PRODUCT_ID = $_GET['PRODUCT_ID'];
        if(isset($_GET['qtty']) && !empty($_GET['qtty'])){$qtty = $_GET['qtty'];}else{$qtty=1;}
        $_SESSION['cart'][$PRODUCT_ID] = array("quantity" => $qtty);
        header('location: Cart.php');
    }
    else {
        header('location: Products.php');
    }
    echo "<pre>";
    print_r($_SESSION['cart']);
    echo "<pre>";

?>