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

    if(isset($_GET['email']) && isset($_GET['v_code'])) {
        $querryTrader = "SELECT * FROM T_TRADER WHERE email='$_GET[email]' AND vkey='$_GET[v_code]'";
        $resultTrader = mysqli_query($connection, $querryTrader);
        $rowTrader = mysqli_fetch_array($resultTrader);
        if($resultTrader) {

            if(mysqli_num_rows($resultTrader) ==1) {
                $email_fetch = $rowTrader['EMAIL'];
                if($rowTrader['VERIFIED']== 0) {   
                    $updateTrader = "UPDATE T_TRADER SET verified = 1 WHERE email= '$email_fetch'";
                    $feTrader=mysqli_query($connection, $updateTrader);
                    if($feTrader) {
                        echo '<script>alert("You are now verified as a trader.Enjoy trading in Organic Mart")</script>';
                    }
                    else {
                        echo '<script>alert("Cannot run querry!")</script>';
                    }
                }
                else{
                    echo '<script>alert("Trader already registered")</script>';
                    

                }
            }
            
        }
    }

?>