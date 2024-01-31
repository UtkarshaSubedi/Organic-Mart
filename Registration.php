<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/Registration.css">
    <link rel="stylesheet" href="CSS/homepage.css">
    <title>Registration </title>
    <style>
        p {
            color: red;
        }
    </style>
</head>

<body>
    <?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include 'navigation.php';
    include 'connection.php';

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "organic";

    // Create connection
    $connection = new mysqli($servername, $username, $password, $database);

    // Check connection
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    function sendMail($email, $v_code)
    {
        //Load Composer's autoloader
        require './PHPMailer/PHPMailer/src/Exception.php';
        require './PHPMailer/PHPMailer/src/PHPMailer.php';
        require './PHPMailer/PHPMailer/src/SMTP.php';

        $mail = new PHPMailer(true);
        try {
            //Server settings                     //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'organicmartnpl@gmail.com';                     //SMTP username
            $mail->Password   = 'mttngufuxihqydjf';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('organicmartnpl@gmail.com', 'Organic Mart');
            $mail->addAddress($email);     //Add a recipient



            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Email Verification From Organic Mart';
            $mail->Body    = "Thanks for verification. Click the link bleow to verify.
            <a href='http://localhost:8080/ORGANICMART/verify.php?email=$email&v_code=$v_code'>Verify</a></b>";

            $mail->send();
            return true;
        } catch (Exception $e) {
            return 'Mailer Error: ' . $mail->ErrorInfo;
        }
    }
    if (isset($_POST['submit'])) {

        //checking for errors//
        //
        //
        $userErr = $emailErr = $passErr  = $firstErr = $lastErr = "";
        $email = $usrName = $password = $firstname = $lastname = $birthdate = $phonenumber = $gender = "";
        $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";
        $passPattern = "/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/";


        //
        //if(isset($_POST['submit'])) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (empty($_POST['email'])) {
                $emailErr = "Email field is required!!";
            } else {
                $email = $_POST['email'];
                if (!preg_match($pattern, $email)) {
                    $emailErr = "Invalid email format";
                }
            }
            if (empty($_POST['firstname'])) {
                $firstErr = "First Name is required";
            }

            if (empty($_POST['lastname'])) {
                $lastErr = "Last Name is required";
            }

            if (empty($_POST['username'])) {
                $userErr = "Username is required";
            } else {
                $usrName = $_POST['username'];
                if (!preg_match("/^[a-zA-z]*$/", $usrName)) {
                    $userErr = "Only alphabets and spaces all0wed!!";
                }
            }

            if (empty($_POST['password'])) {
                $passErr = "Password is required";
            } else {
                $password = $_POST['password'];
                if (!preg_match($passPattern, $password)) {
                    $passErr = "Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters";
                }
            }
        }


        //
        //
        //If no error and form is empty.
        //
        //
        //

        if ($userErr == "" && $emailErr == "" && $passErr == "" && $lastErr == "" && $firstErr == "") {
            $username = $_POST["username"];
            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $passHash = password_hash($password, PASSWORD_DEFAULT);
            $birthdate = $_POST["birthdate"];
            $gender = $_POST["gender"];
            $usertype = $_POST["usertype"];

            $vkey = bin2hex(random_bytes(16));
            
            //Insert into U_USER
            if ($usertype == 'Customer') {
                $ins = "INSERT INTO U_USER (FIRSTNAME, LASTNAME, USERNAME, PASSW, EMAIL, BIRTHDATE, GENDER, USERTYPE, PHONENUMBER, VKEY, VERIFIED)
                    VALUES('$firstname', '$lastname', '$username', '$passHash', '$email','$birthdate', '$gender', '$usertype', '$phonenumber', '$vkey', '0')";
                $sql = mysqli_query($connection, $ins);

                $mailResult = sendMail($_POST['email'], $vkey);
                if ($sql && $mailResult=== true) {
                    $success = "New customer record added successfully. Please Verify Your Account.";
                } else {
                    echo "<p style='color:#ba181b;'>ERROR: " . mysqli_error($connection) ."  - Mail Error: " . $mailResult ." </p>";
                }
            }
 
            //IF usertype is Trader insert it in trader
                
                if ($usertype == 'Trader') {
                    $insTrader = "INSERT INTO T_TRADER (FIRSTNAME, LASTNAME, USERNAME, PASSW, EMAIL, BIRTHDATE, GENDER, USERTYPE, PHONENUMBER, VKEY, VERIFIED)
                        VALUES('$firstname', '$lastname', '$username', '$passHash', '$email','$birthdate', '$gender', '$usertype', '$phonenumber', '$vkey', '0')";
                    $sql2 = mysqli_query($connection, $insTrader);

                    $mailResultTrader = sendMail($_POST['email'], $vkey);
                    if ($sql2 && $mailResultTrader=== true) {
                        $successTrader = "New trader record added successfully. Please Verify Your Account.";
                    } else {
                        echo "<p style='color:#ba181b;'>ERROR: " . mysqli_error($connection) ."  - Mail Error: " . $mailResultTrader ." </p>";
                    }
                }
            }
        }
    

    ?>


    <div class="container">

        <?php
        if (isset($success)) {
            echo "<p style='background-color: #D9E6DB; padding:20px; color: black;'>$success</p>";
        }

        if (isset($successTrader)) {
            echo "<p style='background-color: #D9E6DB; padding:20px; color: black;'>$successTrader</p>";
        }
        ?>
        <!--
        <div class="traders">
            <h2>Traders:</h2>
            <div class="traderImg">
                <img src="Images/Fish.jpg" alt="">
                <img src="Images/Butcher.jpg" alt="">
                <img src="Images/Bakery.jpg" alt="">
                <img src="Images/Veg.jpg" alt="">
                <img src="Images/Fruit.jpg" alt="">
            </div>
        </div>
    -->
        <div class="forms">

            <div class="vl"></div>
            <div class="signup">
                <h3>Sign Up</h3>
                <form action="" method="POST">
                    <input type="text" name="firstname" id="username" placeholder="First Name">
                    <br>
                    <?php
                    if (isset($firstErr)) {
                        echo "<p> $firstErr </p>";
                    }
                    ?>
                    <br><br>
                    <input type="text" name="lastname" id="username" placeholder="Last Name">
                    <br>
                    <?php
                    if (isset($lastErr)) {
                        echo "<p> $lastErr </p>";
                    }
                    ?>
                    <br><br>
                    <input type="text" name="email" id="username" placeholder="Email">
                    <br>
                    <?php
                    if (isset($emailErr)) {
                        echo "<p> $emailErr </p>";
                    }
                    ?>
                    <br><br>

                    <input type="text" name="username" id="username" placeholder="Username">
                    <br>
                    <?php
                    if (isset($userErr)) {
                        echo "<p> $userErr </p>";
                    }
                    ?>
                    <br><br>
                    <input type="password" name="password" id="username" placeholder="Password">
                    <br>
                    <?php
                    if (isset($passErr)) {
                        echo "<p> $passErr </p>";
                    }
                    ?>
                    <br><br>
                    <input type="date" name="birthdate" id="datetime" !require>
                    <br><br>
                    <label for="users">Male:</label>
                    <input type="radio" value="Male" name="gender" id="gender">
                    <label for="users">Female:</label>
                    <input type="radio" value="Female" name="gender" id="gender">
                    <br><br>
                    <label for="users">User Type:</label>
                    <select name="usertype" id="users">
                        <option value="Customer">Customer</option>
                        <option value="Trader">Trader</option>
                        <select>
                            <br><br>
                            <input type="submit" name="submit" value="Sign Up" placeholder="signup" id="signup">
                </form>
                <h3>Already Logged In?<br><br><a href="login.php">Login</a></h3>
            </div>

        </div>
    </div>
    <?php
    include 'footer.php';
    ?>
</body>

</html>