<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
        .centered {
            display: flex;
            justify-content: center;
            flex-direction: column;
            width: 50%;
            padding: 20px;
            margin: auto;
            background-color: #f2f2f2;
            align-items: center;
        }
        .centered button {
            padding: 10px;
            background-color: #2A9D74;
            border: none;
            width: 30%;
        }
        .centered button a {
            text-decoration: none;
            color: white;
        }
        .centered img {
            width: 100px;
        }
        
    </style>
    <div class="centered">
            <img src="Images/checked.png" alt="success">
            <h1>Your order is on the way!</h1>
            <button><a href="index.php">Continue Shopping</a></button>
    </div>
    
</body>
</html>