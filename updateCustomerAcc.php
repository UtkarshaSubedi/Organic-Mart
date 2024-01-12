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
    include 'connection.php';
    include 'navigation.php';



    if (count($_POST) > 0) {
        
        $updprod = "UPDATE U_USER SET FIRSTNAME='" . $_POST['FIRSTNAME'] . "', EMAIL='" . $_POST['EMAIL'] . "', USERNAME='" . $_POST['USERNAME'] . "', GENDER='" . $_POST['GENDER'] . "' , DATE='" . $_POST['DATE']  . "' WHERE USERNAME='" . $_SESSION['customer'] . "'";
        

        $query = mysqli_query($connection, $updprod);
        if ($query) {
            header('Location: Trader.php');
        } else {
            echo "Error.";
        }
    }



    $query = "SELECT * FROM U_USER WHERE USERNAME='" . $_SESSION['customer'] . "'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($result);



</body>

</html>