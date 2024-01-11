<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/Profile.css">
    <title>Profile</title>
</head>

<body>
    <?php
    include 'connection.php';
    include 'navigation.php';
    $sel = "SELECT * FROM U_USER WHERE USERNAME = '{$_SESSION['customer']}'";
    $sql = mysqli_query($connection, $sel);

    echo '<div class="profile">
        <div class="top">
            <h3> Hello, ';
    echo $_SESSION['customer'];
    echo '</h3>

            <h3>User Detail\'s:</h3>
        </div>
        <div class="profileInfo">
            <div class="name">
                <h3>Name:  </h3>
                <h3>Email: </h3>
                <h3>Username: </h3>
                <h3>Gender: </h3>
                <h3>Date: </h3>
            </div>
            <div class="infoName">';

    echo '<h3>';
    echo $_SESSION['customer'];
    echo '</h3>';
    while ($row = mysqli_fetch_array($sql)) {
        echo '<h4>';
        echo $row["EMAIL"];
        echo '</h4>
                <h4>';
        echo $_SESSION['customer'];
        echo '</h4>
                <h4>';
        echo $row["GENDER"];
        echo '</h4>
                <h4>';
        echo $row["BIRTHDATE"];
        echo '</h4>
            </div>';
    };

    echo '</div>'; ?>
    <button style="padding: 10px; border:none; background-color:#2A9D74;"><a href="checkPassword.php" style="color:white;">Change Password</a></button>
    <br><br>
    <button  style="padding: 10px; border:none; background-color:#2A9D74;"><a href="updateCustomerAcc.php" style="color:white;">Update Account Details</a></button>
    </div>


</body>

</html>