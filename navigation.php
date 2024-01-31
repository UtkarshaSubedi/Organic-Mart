<?php
    session_start();
    include 'connection.php';
?>
 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="CSS/index.css">
     <link rel="stylesheet" href="CSS/cart.css">
     <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
     <title>Homepage</title>
 </head>

 <body>

     <nav class="navbar">
         <a href="index.php" class="nav-logo"><img src="Images/logo.png" alt=""></a>
         <ul class="nav-menu">
             <li class="nav-item">
                 <a href="Index.php" class="nav-link">Home</a>
             </li>
             <li class="nav-item">
                 <a href="Products.php" class="nav-link">Products</a>
             </li>
             <li class="nav-item">
                 <a class="itemshopping" style="color: white;" href="#Cart"><i style="font-size: 22px;" class="fas fa-cart-arrow-down"><span style="color: black;">
                 <?php 
                 if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])){
                    echo count($_SESSION['cart']);
                 }else {
                    echo 0;
                 }
                ?></span></i></a>
             </li>
             <li class="nav-item">
                 <?php
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                        echo '<a  style="color:yellow; text-decoration:none;" href="userprofile.php"> <i style="margin-right:5px;" class="fas fa-user-circle"></i>' ;
                        if (isset($_SESSION["customer"])) {
                            echo $_SESSION["customer"];
                        } elseif (isset($_SESSION["trader"])) {
                            echo $_SESSION["trader"];
                        }
                        
                        echo '&nbsp;&nbsp;&nbsp;<a style="color:white; text-decoration:none;" href="logout.php">Logout</a>';
                    } else {
                        echo '<a href="Registration.php" class="nav-link">Login/SignUp</a>';
                    }
                    ?>
             </li>
         </ul>
         <div class="hamburger">
             <span class="bar"></span>
             <span class="bar"></span>
             <span class="bar"></span>
         </div>
     </nav>

     <div class="cartbox" >
         <div class="cart">
             <i class="fas fa-times"></i>
             <h1>Cart</h1>
             <table >
                 <thead>
                     <th>S.No</th>
                     <th>Name</th>
                     <th>Image</th>
                     <th>Quantity</th>
                     <th>Price</th>
                     <th>Total Price</th>
                 </thead>
                 <tbody style="overflow-y: scroll; max-height: 90px; position:absolute;">
                     <?php

                        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
                        //print_r($cart); 
                        $sno = 1;
                        $total = 0;
                        foreach ($_SESSION['cart'] as $key => $values) {
                            $cartSql = "SELECT * FROM P_PRODUCT WHERE PRODUCT_ID=$key";
                            $cartres = mysqli_query($connection, $cartSql);
                            $cartr = mysqli_fetch_assoc($cartres);

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


                 <?php 
                    $total = $total + $cartr['PRICE'] * $values['quantity']; 
                    ?>

                     <?php } 
                     } else {
                        echo '<tr><td colspan="6">Cart is empty</td></tr>';
                     }
                     ?>
                 </tbody>
             </table>
             <div class="btns">
                 <button class="checkoutBtn" id="upd"><a href="Cart.php">View Cart</a></button>
                 <button class="checkoutBtn" ><a href="Checkout.php">Chekcout</a></button>
             </div>
         </div>
     </div>

     <script src="cart.js"></script>

 </body>
 </html>