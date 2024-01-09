<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/Login.css">
    <title>Login</title>
    <style>
        p {
            color: red;
        }
    </style>
</head>
<body>
    <?php
        include 'connection.php';
        
        include 'navigation.php';
        $message ="";
        $type = "";
        if(isset($_POST['login'])) {

            $userErr = $passErr = "";

            $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";  
            $passPattern="/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                if(empty($_POST['username'])) {
                    $userErr = "Username is required";
                }else {
                    $usrName = $_POST['username'];
                    if(!preg_match ("/^[a-zA-z]*$/", $usrName)) {
                        $userErr = "Only alphabets and spaces all0wed!!";
                    }
                }
    
                if(empty($_POST['password'])) {
                    $passErr = "Password is required";
                }else {
                    $password = $_POST['password'];
                    if(!preg_match($passPattern,$password)) {
                        $passErr = "Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters";
    
                    }
                    
                }
            }
            if($userErr == ""  && $passErr == ""){
            $username = $_POST["username"];
            $password = $_POST["password"];

            
            $sel = "SELECT * FROM U_USER WHERE USERNAME='$username'";
            $sql = mysqli_query($connection, $sel);
            $row = mysqli_fetch_array($sql);
            if($row && isset($row['VERIFIED']) && $row['VERIFIED'] == 1){
            if(password_verify($password,$row["PASSW"])){
                if(mysqli_num_rows($sql)==1) {
                    echo $username;
                    $role = "SELECT USERTYPE FROM U_USER WHERE USERNAME='$username'";
                    $roles = mysqli_query($connection, $role);
                    $row = mysqli_fetch_assoc($roles);
                    
                    if($row["USERTYPE"] == "Customer") {
                        $_SESSION['loggedin'] = true;
                        $_SESSION['customer'] = $username;
                        header('Location:index.php');
                        exit;
                    }
                    
                }
            }
            
            else{
                echo "Invalid Password";
            }
        }else{
            echo '
                <script>
                    alert("Please verify your email which is sent in gmail account");
                </script>
            ';
        }

        //Trader 

        $selTrader = "SELECT * FROM T_TRADER WHERE USERNAME='$username'";
            $sqlTrader = mysqli_query($connection, $selTrader);
            $rowTrader = mysqli_fetch_array($sqlTrader);
            if($rowTrader && isset($rowTrader['VERIFIED']) && $rowTrader['VERIFIED'] == 1){
            if(password_verify($password,$rowTrader["PASSW"])){
                if(mysqli_num_rows($sqlTrader)==1) {
                    echo $username;
                    $roleTrader = "SELECT USERTYPE FROM T_TRADER WHERE USERNAME='$username'";
                    $rolesTrader = mysqli_query($connection, $roleTrader);
                    $rowTrader = mysqli_fetch_assoc($rolesTrader);
                    
                    if($rowTrader["USERTYPE"] == "Trader") {
                        $_SESSION['loggedin'] = true;
                        $_SESSION['trader'] = $username;
                        header('Location:Trader.php');
                        exit;
                    }
                    
                }
            }
            
            else{
                echo "Invalid Password";
            }
        }else{
            echo '
                <script>
                    alert("Please verify your email which is sent in gmail account");
                </script>
            ';
        }
    }
        
        }
        
    ?>
    
    <?php
        include 'footer.php';
    ?>
</body>
</html>