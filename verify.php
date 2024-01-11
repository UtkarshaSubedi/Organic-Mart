<?php 
    include 'connection.php';
    
    if(isset($_GET['email']) && isset($_GET['v_code'])) {
        $querry = "SELECT * FROM U_USER WHERE email='$_GET[email]' AND vkey='$_GET[v_code]'";
        $result = mysqli_query($connection, $querry);
        $row = mysqli_fetch_array($result);
        if($result) {

            if(mysqli_num_rows($result) ==1) {
                $email_fetch = $row['EMAIL'];
                if($row['VERIFIED']== 0) {   
                    $update = "UPDATE U_USER SET verified = 1 WHERE email= '$email_fetch'";
                    $fe=mysqli_query($connection, $update);
                    if($fe) {
                        echo '<script>alert("You are now verified as a customer. Enjoy surfing Organic Mart")</script>';
                    }
                    else {
                        echo '<script>alert("Cannot run querry!")</script>';
                    }
                }
                else{
                    echo '<script>alert("User already registered")</script>';
                    

                }
            }
            
        }
    }

?>