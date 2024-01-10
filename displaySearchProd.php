<?php
    include 'navigation.php';
    include 'connection.php';

    $prodName = $_POST['prodName'];
    $selprod = "SELECT * FROM P_PRODUCT WHERE PRODUCTNAME LIKE '%$prodName%'";
    $sqlsel = mysqli_query($connection, $selprod);
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Searched Product</title>
    <style>
        #pN {
            display: inline-block;
            margin-right: 50%; /* Adjust as needed */
        }

        .searchField {
            display: inline;
        }

        .products .product {
            padding: 5px;
            box-shadow: 0px 12px 28px -14px rgba(155, 155, 155, 0.75);
            -webkit-box-shadow: 0px 12px 28px -14px rgba(155, 155, 155, 0.75);
            -moz-box-shadow: 0px 12px 28px -14px rgba(155, 155, 155, 0.75);
            border-radius: 10px;
        }
    </style>
</head>
<body>  
<div class="container">
    <div class="products">
        <h3 id="pN">Products: <?php echo $prodName; ?></h3>
        
        <!-- Search bar -->
        <form class="searchField" action="displaySearchProd.php" method="post">
            <input style="width: 15%;" name="prodName" type="text" id="search" placeholder="Search Any Product By Name">
            <input style="width: 10%;" type="submit" id="submit" name="Search Keyword">
        </form>
        
          
    </div>
 </div>
<?php include 'footer.php' ?>
</body>
</html>