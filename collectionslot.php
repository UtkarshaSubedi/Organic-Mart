<?php
include 'connection.php';
include 'invoiceexe.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/Registration.css">
    <link rel="stylesheet" href="CSS/Login.css">
    <link rel="stylesheet" href="CSS/index.css">
    <title>Document</title>
    <style>
        .collslot {
            border: 1px solid black;
            width: 50%;
            padding: 20px;
            margin: auto auto;
        }

        #confirm {
            padding: 10px;
            background-color: #2A9D74;
            border: none;
            color: white;
        }

        p {
            color: #2A9D74;
            font-weight: 800;
            font-size: 1.5rem;
        }
        #times {
            padding: 10px;
            border: none;
            background-color: #D9E6DB;
        }
    </style>
</head>

<body>
    <?php
    $cart = $_SESSION['cart'];
    date_default_timezone_set("Asia/Kathmandu");
    $day = date('D');
    $time = array("first-slot" => '10-13', "second-slot" => '13-16', "third-slot" => '16-19');
    echo '<br>';
    $d = "";
    if ($day == 'Sat') {
        $day = date('D', strtotime('+4 days'));
        $d = "Your can collect your order after: " . $day;
        echo "<br>";
    } else if ($day == 'Sun') {
        $day = date('D', strtotime('+3 days'));
        $d = "Your can collect your order after: " . $day;
        echo "<br>";
    } else if ($day == 'Mon') {
        $day = date('D', strtotime('+2 days'));
        $d = "Your can collect your order after: " . $day;
        echo "<br>";
    } else {
        $time = date("D", strtotime('+24 hours'));
        $d = "Your can collect your order after: " . $time;
        echo "<br>";
    }






    ?>
    <div class="collslot">
        <h2>Delivery Information:</h2>
        <br>
        <p>
            <?php
            echo $d;
            ?>
        </p>
        <form action="invoiceexe.php" method="post">
            <input type="hidden" name="slotinfo" value="<?php echo $d ?>">
            <h3>The order will be ready at the nearest store from your location.</h3>
            <label for="Time-slot">Select Time-Slot:</label>
            <select name="time-slot" id="times">
                <?php
                    foreach($time as $key=>$value){

                        echo "<option id='tme' value='". $key ."'>".$value."</option>"."<br />";
                      }
                ?>
                
            </select>
            <br><br>
            <br>
            <label for="Confirm location">Location:</label>
            <input type="text" name="location" id="username" placeholder="Confirm Your Location">
            <br><br>
            <?php if(isset($locErr)){
                echo $locErr;
            } ?>
            <input type="submit" value="Confirm" name="submit" id="confirm">
        </form>
    </div>
</body>

</html>