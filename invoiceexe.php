<?php

session_start(); // Add this line to start the session

include 'connection.php';
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];


if (isset($_POST['submit'])) {

    $locErr ="";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if (empty($_POST['firstname'])) {
            $locErr = "You need to enter Location";
        }
    }

    if ($locErr == ""){
    foreach($cart as $key => $value) {

        $cartSql = "SELECT * FROM P_PRODUCT WHERE PRODUCT_ID=$key";
        $cartres = mysqli_query($connection, $cartSql);

        $cartr = mysqli_fetch_assoc($cartres);
        $productname = $cartr['PRODUCTNAME'];
        $qtty = $value['quantity'];

        $usrsql = "SELECT USER_ID FROM U_USER WHERE USERNAME= ". "'{$_SESSION['customer']}'";
        $usrres = mysqli_query($connection, $usrsql);
        $row = mysqli_fetch_array($usrres);
        $id=$row['USER_ID'];

        $qtUpdate = "UPDATE P_PRODUCT SET STOCK = STOCK - {$value['quantity']} WHERE PRODUCT_ID = $key"; 
        $query = mysqli_query($connection, $qtUpdate);

        if ($query) {
            header('Location: Trader.php');
        } else {
            echo "Error.";
        }
    }
}


    $role = "SELECT ORDER_ID FROM O_ORDER WHERE USERNAME='{$_SESSION['customer']}'";
    $roles = mysqli_query($connection, $role);
    $row = mysqli_fetch_assoc($roles);



    $slotinfo = $_POST['slotinfo'];
    $location = $_POST['location'];

    $collinsert = "INSERT INTO C_COLLECTION_SLOT (SLOTINFO, ORDER_ID, SLOTLOCATION)
                    VALUES( '$slotinfo', '{$row['ORDER_ID']}', '$location')";
    $inscoll = mysqli_query($connection, $collinsert);

    if ($inscoll) {
        header('location: PayNow.php');
    } else {
        echo "ERROR: Could not able to execute $inscoll. " . '</br>';
    }





    foreach ($cart as $key => $values) {
        $cartSql = "SELECT * FROM P_PRODUCT WHERE PRODUCT_ID=$key";
        $cartres = mysqli_query($connection, $cartSql);
        $cartr = mysqli_fetch_assoc($cartres);

        $proddetail = "Your Products are" . $cartr['PRODUCTNAME'];
    }

    $csot = "SELECT C_COLLECTIONSEQ.currval FROM dual";
    $colidSel = mysqli_query($connection, $csot);
    $colres = mysqli_fetch_assoc($colidSel);
    $cid = $colres['CURRVAL'];
    echo "</br>";



    $coldate = date('y-m-d');

    $cartid = $_SESSION['id'];
    $invoiceIns = "INSERT INTO I_INVOICE (USER_ID, COLLECTIONDATE, COLLECTIONLOCATION, TOTAL, PRODDETAIL, CART_ID, COLLECTION_ID) VALUES ($id, '$coldate', '$location', {$_SESSION['total']}, '$proddetail', $cartid, $cid)";
    var_dump($invoiceIns);

    $insinv = mysqli_query($connection, $invoiceIns);

    if ($insinv) {
        header('location: PayNow.php');
    } else {
        echo "ERROR: Could not able to execute $insinv. " . '</br>';
    }
}
