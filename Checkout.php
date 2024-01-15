<?php include 'connection.php';
        include 'navigation.php';
        $cart = $_SESSION['cart']; 
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/Registration.css">
    <link rel="stylesheet" href="CSS/homepage.css">
    <title>Checkout</title>
    <style>
        
        input[type=submit] {
            padding: 10px;
            background-color: #2A9D74;
            color: white;
            border: none;
        }

        #del {
            padding: 10px;
            border: none;
            background-color: #ba181b;
        }
        #del a {
            color: white;
        }
        #check {
            background-color: #FDD261;
            color: black;
        }
        
        td {
            padding: 10px;
            border: 1px solid black;
        }
        th {
            padding: 10px;
            border: 2px solid black;
        }
        img {
            width: 80px;
            height: 80px;
        }
    </style>
</head>
<body>
    <?php 
        

        $selChk = "SELECT * FROM U_USER WHERE USERNAME='{$_SESSION['customer']}'";
        $sqlchk = mysqli_query($connection, $selChk);
            $row = mysqli_fetch_assoc($sqlchk);
    ?>
    <div class="container">
        <div class="forms">

                
        <?php 
            $cartSql = "SELECT * FROM P_PRODUCT WHERE PRODUCT_ID=$key";
            $cartres = mysqli_query($connection, $cartSql);
            $cartr = mysqli_fetch_assoc($cartres);
    ?>

            <div class="vl"></div>
            <div class="signup">
                <h1>Your Details</h1>
                
                <?php
                    $fname = $row['FIRSTNAME'];
                    $lname = $row['LASTNAME'];
                ?>
                <form action="checkReview.php" method="POST">
                    <label for="Full Name">Full Name: </label>
                    <br>
                    <input type="text" name="fullname" id="username" value="<?php echo $fname." ".$lname ?>">
                    <br>
                    <?php 
                        if(isset($firstErr)){
                        echo "<p> $firstErr </p>" ;}
                    ?>
                    <br><br>
                    <label for="Username">Username: </label>
                    <br>
                    <input type="text" name="username" id="username" value=<?php echo $row['USERNAME'] ?>>
                    <br>
                    <?php 
                        if(isset($userErr)){
                        echo "<p> $userErr </p>" ;}
                    ?>
                    <br><br>
                    <label for="Email">Email: </label>
                    <br>
                    <input type="text" name="email" id="username" value=<?php echo $row['EMAIL'] ?>>
                    <br>
                    <?php 
                        if(isset($emailErr)){
                        echo "<p> $emailErr </p>" ;}
                    ?>
                    <br><br>
                    <label for="Location">Location: </label>
                    <br>
                    <input type="text" name="location" id="username" placeholder="Location">
                    <br>
                    <?php 
                        if(isset($locErr)){
                        echo "<p> $locErr </p>" ;}
                    ?>
                    <br><br>
                    <label for="Phone Number">Phone No.: </label>
                    <br>
                    <input type="text" name="phonenumber" id="username" value=<?php echo $row['PHONENUMBER'] ?>>
                    <br>
                    <?php 
                        if(isset($locErr)){
                        echo "<p> $locErr </p>" ;}
                    ?>
                    <br><br>
                    <input type="radio" name="agree" id="terms" >
                    <label for="terms&cond">Agree the terms and conditions before paying.</label>
                    <br><br>
                    <input type="submit" name="chkout" value="Continue" id="signup">
                </form>
            </div>
            
        </div>
    </div>
</body>
</html>
<?php }
    else {
        echo "<h1> You Need To Login First. <span style='color:grey;'>Redirecting...</span></h1>";
        header('Refresh: 4; URL=http://localhost/ORGANICMART/login.php');
        
    }            
?>