    <?php 
        include 'connection.php';
        include 'navigation.php';  

        $selprod = "SELECT * FROM P_PRODUCT LIMIT 3";
        $sqlsel = mysqli_query($connection, $selprod);
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>HomePage</title>
        
        <link rel="stylesheet" href="CSS/index.css">
    </head>
    <body>
    <div class="header">
        <img src="Images/herobg.png" alt="Hero Image">
        <div class="centered">
            <h1>GET FRESH & ORGANIC FOOD <br> AT ONE PLACE</h1>
            <form class="searchField" action="displaySearchProd.php" method="post" style="display: flex; flex-direction:row;">
                <input style="width: 100%;" name="prodName" type="text" id="search" placeholder="Search Any Product By Name"><br><input type="submit" id="submit" name="Search Keyword">
            </form>
            <br>
            <button id="viewProd"><a href="Products.php">View Products</a></button>
        </div>
    </div>
    <div class="container">
        <div class="traders">
            <h2>Traders</h2>
            <div class="traderImg">
            <?php
                $tradersResult = $connection->query("SELECT * FROM t_trader");

                if ($tradersResult->num_rows > 0) {
                    while ($trader = $tradersResult->fetch_assoc()) {
                        echo '<a href="Products.php?traderId=' . $trader['TRADER_ID'] . '">
                        <img src="Images/Traders/' . $trader['TRADER_ID'] . '.jpg" alt="">
                      </a>';
                    }
                }
                ?>
            </div>
        </div>
        <div class="products">
        <h3 id="pN"><a href="Products.php">Products</a></h3>
        <div class="prod">
            <?php
            while( $row = mysqli_fetch_assoc($sqlsel)){
            ?>
                <div class="product">
                
                    <img src="Images/<?php echo $row['PRODUCTIMAGE']?>" alt="Product-Image" width="100%" height="367px">
                    <div class="namePrice">
                        <h3> <?php echo $row['PRODUCTNAME'] ?> </h3>
                        <h3>$<?php echo $row['PRICE'] ?></h3>
                    </div>
                    <p><?php echo $row['DESCRIPTIONS'] ?></p>
                    <div class="viewAddBtn">
                        <button class="vP"><a style="color: black; text-decoration:none" href="ProductDetails.php?PRODUCT_ID=<?php echo $row['PRODUCT_ID']; ?>">View Product</a></button>
                        <button class="AC"><a style="color: black; text-decoration:none" href="addtocart.php?PRODUCT_ID=<?php echo $row['PRODUCT_ID']; ?>">Add To Cart</a></button>
                    </div>
                
                    
                    
                </div>
                
                <?php } ?>
                
        </div>

        
    </div>
    </div>
    
    <?php 
        include 'footer.php';
    ?>

    </body>
    </html>
    