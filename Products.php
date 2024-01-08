

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/Product.css">
    <title><?php echo $pageTitle ?></title>
</head>

<body>
<div class="container">
    <div class="filters">
        <form action="" method="post">
            <div class="catg">
                <h3>Filter:</h3>

                <select style="margin-left: 20px;" name="vnf" id="users" aria-placeholder="Filters">
                    <option value="Veg">Veg</option>
                    <option value="Non-Veg">Non-Veg</option>
                    <option value="Fruit">Fruit</option>
                    <option value="Bakery">Bakery</option>
                </select>
                <input type="radio" name="Price"> <label for=" price">Price(low-high)</label>
                <input type="radio" name="Rating"> <label for="rating">Rating</label>
                <input style="margin-left:10px; background-color:#2A9D74; border:none; padding:15px; color:white;" type="submit" name="submit" id="username" value="Filter">

                <input style="margin-left:10px; background-color:#ba181b; border:none; padding:15px; color:white;" type="submit" name="reset" value="Reset Filter">
            </div>
        </form>
    </div>
    <form action="addtocart.php" method="get">
        <div class="products">
            <h3 id="pN"><?php echo $pageTitle; ?></h3>
            <div class="prod">
                <?php
                while ($filter = mysqli_fetch_assoc($sqlsel)) {

                ?>
                    <div class="product">

                        <img src="Images/<?php echo $filter['PRODUCTIMAGE'] ?>" alt="Product-Image" width="100%" height="367px">
                        <div class="namePrice">
                            <h3> <?php echo $filter['PRODUCTNAME'] ?> </h3>
                            <h3>$<?php echo $filter['PRICE'] ?></h3>
                        </div>
                        <p><?php echo $filter['DESCRIPTIONS'] ?></p>
                        <div class="viewAddBtn">
                        <button class="vP">
                            <a style="color: black; text-decoration:none" href="ProductDetails.php?PRODUCT_ID=<?php echo $filter['PRODUCT_ID']; ?>">View Product </a> 
                        </button>
                            
                        <button class="AC"> 
                            <a style="color: black; text-decoration:none" href="addtocart.php?PRODUCT_ID=<?php echo $filter['PRODUCT_ID']; ?>">Add To Cart </a>
                        </button>
                            
                        </div>



                    </div>

                <?php } ?>

            </div>


        </div>
    </form>
</div>
    <?php
    include 'footer.php';
    ?>
</body>

</html>