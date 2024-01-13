<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/Registration.css">
    <link rel="stylesheet" href="CSS/homepage.css">
    <title>Add Product</title>
</head>

<body>
    <?php
    session_start();
    include 'connection.php';

    if (isset($_POST['Add'])) {
        $nameErr = $desErr = $imageErr = $allergyErr = $priceErr = $stockErr = "";

        //if(isset($_POST['submit'])) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (empty($_POST['prodName'])) {
                $nameErr = "Product Name field is required!!";
            }

            if (empty($_POST['prodDesc'])) {
                $desErr = "Description is required";
            }



            if (empty($_POST['allergyInfo'])) {
                $allergyErr = "Allergy Information is required";
            }

            if (empty($_POST['price'])) {
                $priceErr = "Price is required";
            }
            if (empty($_POST['stock'])) {
                $stockErr = "Stock is required";
            }
        }


        if ($nameErr == "" && $desErr == "" && $imageErr == "" && $allergyErr == "" &&  $priceErr == "" && $stockErr == "") {
            echo 'Entered';
            $productName = $_POST["prodName"];
            $productInfo = $_POST["prodDesc"];
            $allergyInfo = $_POST["allergyInfo"];
            $vnf = $_POST['vnf'];
            $file_name = $_FILES['prodImg']['name'];
            $file_tmp = $_FILES['prodImg']['tmp_name'];
            $file_store = "Images/" . $file_name;


            move_uploaded_file($file_tmp, $file_store);
            $price = $_POST["price"];
            $stock = $_POST["stock"];
            $offer = $_POST['offer'];

            $idTrad = "SELECT TRADER_ID FROM T_TRADER WHERE USERNAME ='{$_SESSION['trader']}'";
            $selTra = mysqli_query($connection, $idTrad);



            $shop_name = "SELECT S_SHOP.SHOP_ID FROM S_SHOP, T_TRADER WHERE T_TRADER.USERNAME =" . "'{$_SESSION['trader']}' AND S_SHOP.TRADER_ID = T_TRADER.TRADER_ID";

            $parShop = mysqli_query($connection, $shop_name);
           
            $traderid = mysqli_fetch_assoc($selTra)['TRADER_ID'];
            $selPar = mysqli_query($connection, $shop_name);
            $shopid = mysqli_fetch_assoc($selPar)['SHOP_ID'];

            $ins = "INSERT INTO P_PRODUCT (PRODUCTNAME, DESCRIPTIONS, PRODUCTIMAGE, ALLERGYINFORMATION, STOCK, PRICE, OFFERPRICE, CATAGORYTYPE, TRADER_ID, SHOP_ID)
                VALUES( '$productName', '$productInfo', '$file_name', '$allergyInfo',  '$stock', '$price', '$offer', '$vnf', '$traderid', '$shopid')";


            $insProd = mysqli_query($connection, $ins);
            echo '</br>';
            if ($insProd) {
                echo "New record created successfully";
            } else {
                echo "ERROR: Could not able to execute $ins. " . '</br>' . mysqli_error($connection);
            }
        }
    }


    ?>
    <style>
        p {
            color: red;
        }
    </style>
    <div class="forms">
        <div class="signup">
            <h3>Add A Product:</h3>
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="text" name="prodName" id="username" placeholder="Product Name">
                <br>
                <?php if (isset($nameErr)) {
                    echo "<p> $nameErr </p>";
                } ?>
                <br><br>
                <textarea rows="4" cols="50" name="prodDesc" id="username" placeholder="Add Product Detils" required></textarea>
                <br>
                <?php if (isset($desErr)) {
                    echo "<p> $desErr </p>";
                } ?>
                <br><br>
                <input type="file" id="username" name="prodImg" required>
                <br>
                <?php if (isset($imageErr)) {
                    echo "<p> $imageErr </p>";
                } ?>
                <br><br>

                <textarea rows="4" cols="50" name="allergyInfo" id="username" placeholder="Allergy Information" required></textarea>
                <br>
                <?php if (isset($allergyErr)) {
                    echo "<p> $allergyErr </p>";
                } ?>
                <br><br>
                <input type="number" name="stock" id="username" placeholder="Stock">
                <br>
                <?php if (isset($stockErr)) {
                    echo "<p> $stockErr </p>";
                } ?>
                <br><br>
                <input placeholder="Price" type="number" name="price" id="username" !require>
                <br>
                <?php if (isset($priceErr)) {
                    echo "<p> $priceErr </p>";
                } ?>
                <br><br>
                <input placeholder="Discount" type="number" name="offer" id="username" !require>

                <br><br>
                <label for="users">Product Category:</label>
                <select name="vnf" id="users">
                    <option value="Customer">Veg</option>
                    <option value="Non-Veg">Non-Veg</option>
                    <option value="Fruit">Fruits</option>
                    <option value="Bakery">Bakery</option>
                    <select>
                        <br><br>
                        <input type="submit" name="Add" value="Add" placeholder="Add" id="signup">
            </form>
            <br>
            <a style="margin-top:60px;" href="Trader.php">Go Back</a>
        </div>

    </div>
</body>

</html>