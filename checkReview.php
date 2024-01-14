<?php
session_start();
include 'connection.php';
$cart = $_SESSION['cart'];
$total = $_SESSION['total'];

if (isset($_POST['chkout'])) {
    foreach ($cart as $key => $value) {

        $cartSql = "SELECT * FROM P_PRODUCT WHERE PRODUCT_ID=?";
        $cartres = $connection->prepare($cartSql);
        $cartres->bind_param("i", $key);
        $cartres->execute();
        $cartr = $cartres->get_result()->fetch_assoc();

        $productname = $cartr['PRODUCTNAME'];
        $qtty = $value['quantity'];

        $usrsql = "SELECT USER_ID FROM U_USER WHERE USERNAME=?";
        $usrres = $connection->prepare($usrsql);
        $usrres->bind_param("s", $_SESSION['customer']);
        $usrres->execute();
        $row = $usrres->get_result()->fetch_assoc();

        $user_id = $row['USER_ID'];

        $insCart = "INSERT INTO C_CART (PRODUCTNAME, QUANTITY, USER_ID, PRODUCT_ID) VALUES (?, ?, ?, ?)";
        $sqlCart = $connection->prepare($insCart);
        $sqlCart->bind_param("siii", $productname, $qtty, $user_id, $key);
        $reCart = $sqlCart->execute();

        if ($reCart) {
            echo "success cart <br>";
        } else {
            echo "ERROR: Could not able to execute $insCart. " . '</br>';
        }

        $cartSel = "SELECT LAST_INSERT_ID() as ID";
        $sqlSel = $connection->query($cartSel);
        $res = $sqlSel->fetch_assoc();
        $id = $res["ID"];
        var_dump($id);

        $_SESSION['id'] = $id;

        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $location = $_POST['location'];
        $phonenumber = $_POST['phonenumber'];

        $insOrder = "INSERT INTO O_ORDER (FULLNAME, USERNAME, EMAIL, LOCATION, PHONENUMBER, PRODUCT_ID, TOTALPRICE, CART_ID)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $sqlOrder = $connection->prepare($insOrder);
        $sqlOrder->bind_param("ssssiiii", $fullname, $username, $email, $location, $phonenumber, $key, $total, $id);
        $reOrder = $sqlOrder->execute();

        if ($reOrder) {
            header('location: collectionslot.php');
        } else {
            echo "ERROR: Could not able to execute $insOrder. " . '</br>';
            $ORDER_ID = $connection->insert_id;
            $_SESSION['order_id'] = $ORDER_ID;
        }
    }
}
?>
