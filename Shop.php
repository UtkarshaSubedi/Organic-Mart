<?php 
    include 'connection.php'; 
    if(isset($_POST['Add'])) {
        $nameErr = $locErr = "";

        //if(isset($_POST['submit'])) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            if(empty($_POST['shopName'])) {
                $nameErr = "Shop Name field is required!!";
            }
            
            if(empty($_POST['shopLocation'])) {
                $locErr = "Shop Location is required";
            }
                
        }
        

            if($nameErr =="" && $desErr =="" && $imageErr =="" && $allergyErr =="" && $priceErr == "" && $stockErr == ""  ){
                echo 'Entered';
                $shopName = $_POST["shopName"];
                $shopLocation = $_POST["shopLocation"];


                
            
            }

        } 
    

?>