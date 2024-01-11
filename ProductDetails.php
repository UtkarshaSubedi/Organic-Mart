<?php
include 'connection.php';
include 'navigation.php';

$selprod = "SELECT * FROM P_PRODUCT WHERE PRODUCT_ID = '{$_GET['PRODUCT_ID']}'";
$sqlsel = mysqli_query($connection, $selprod);
$row = mysqli_fetch_array($sqlsel);

$selreview = "SELECT R_REVIEW.*, U_USER.USERNAME FROM R_REVIEW 
JOIN U_USER ON R_REVIEW.USER_ID = U_USER.USER_ID
WHERE R_REVIEW.PRODUCT_ID = '{$_GET['PRODUCT_ID']}' LIMIT 5";
$userparse = mysqli_query($connection, $selreview);

if (!$userparse) {
    die("Query failed: " . mysqli_error($connection));
}


$avgreview = "SELECT AVG(REVIEWRATING) FROM R_REVIEW WHERE PRODUCT_ID='{$_GET['PRODUCT_ID']}'";
$revavg = mysqli_query($connection, $avgreview);
$revfetch = mysqli_fetch_assoc($revavg);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/ProductDetails.css">
    <link rel="stylesheet" href="CSS/homepage.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css">
    <title>Organic Mart</title>
</head>

<body>
    <div class="container">
        <form action="addtocart.php" method="get">
            <div class="singleProduct">
                <?php
                $shopId = $row['SHOP_ID']; // Replace 'TRADER_ID' with the actual column name in your product table
                $shopQuery = "SELECT SHOPNAME FROM S_SHOP WHERE SHOP_ID = $shopId";
                $shopResult = mysqli_query($connection, $shopQuery);
                $shopRow = mysqli_fetch_assoc($shopResult);
                $shopName = $shopRow['SHOPNAME'];

                ?>
                <img src="Images/<?php echo $row['PRODUCTIMAGE'] ?>" alt="single-product" width="500px" height="500px">
                <div class="single">

                    <div class="namePrice">
                        <h3><?php echo $row['PRODUCTNAME'] ?></h3>
                        <h3>$<?php echo $row['PRICE'] ?></h3>
                    </div>
                    <p>by <a href="#trader"><?php echo $shopName; ?></a></p>
                    <div class="quantityRating">
                        <input type="hidden" name="PRODUCT_ID" value="<?php echo $row['PRODUCT_ID'] ?>">
                        <input type="number" name="qtty" min="1" max="20" placeholder="1">
                        
                        <div class="rating">
                            <?php for ($i = 5; $i >= 1; $i--) : ?>
                                <input <?php if ($revfetch['AVG(REVIEWRATING)'] == $i) echo 'checked'; ?> type="radio" class="r1" name="star" id="star<?php echo $i; ?>"><label for="star<?php echo $i; ?>"></label>
                            <?php endfor; ?>
                        </div>

                    </div>
                    <h3 class="des">Description:</h3>
                    <p><?php echo $row['DESCRIPTIONS'] ?>
                    </p>
                    <input type="submit" name="addtocart" class="cart" value="Add To Cart">

                </div>
            </div>
        </form>

        <h2>Allergy Information:</h2>
        <p><?php echo $row['ALLERGYINFORMATION'] ?></p>



        
    </div>

    <?php include 'footer.php' ?>
</body>

</html>