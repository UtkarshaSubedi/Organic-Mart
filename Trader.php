s

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Trader Dashboard</title>
</head>
<body>

    <h1>Welcome  <?php echo $_SESSION['trader'] ?></h1>
    <div class="d-flex align-items-start">
  <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
    <button class="nav-link active" style="color: black;" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Manage Products</button>
    <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false" style="color: black;">Account Details</button>
  </div>
  <div class="tab-content" id="v-pills-tabContent">
    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
        <div class="addbtn">
        <button type="button" class="btn btn-success"><a style="color: white; text-decoration:none;" href="addproduct.php">Add A Product</a></button>
        <button type="button" class="btn btn-success"><a style="color: white; text-decoration:none;" href="addshop.php">Add a shop</a></button>
        </div>
        <div class="displayProducts">
          
          
        <table class="table">
  <thead>
    <tr>
    
      <th scope="col">ID</th>
      <th scope="col">Product Name</th>
      <th scope="col">Description</th>
      <th scope="col">Image</th>
      <th scope="col">Allergy Information</th>
      <th scope="col">Stock</th>
      <th scope="col">Price</th>
      <th scope="col">Delete</th>
      <th scope="col">Update</th>
    </tr>
  </thead>
  <tbody>
    <?php
      while($trad=mysqli_fetch_assoc($sqlsel)) {
        ?> 
    <tr>
    
     
      <td scope="row"> <?php echo $trad['PRODUCT_ID'];  ?></td>
      
      <td> <?php echo $trad['PRODUCTNAME'];  ?></td>
      <td>  <?php  echo $trad['DESCRIPTIONS']; ?></td>
      <td>  <?php echo $trad['PRODUCTIMAGE'];  ?> </td>
      <td style="width: 30%;">  <?php  echo $trad['ALLERGYINFORMATION']; ?> </td>
      <td>  <?php  echo $trad['STOCK'];  ?> </td>
      <td>  <?php echo $trad['PRICE']; ?> </td>
      <td><a href="delete.php?PRODUCT_ID=<?php echo $trad['PRODUCT_ID']; ?> ">Delete</a></td>
      <td><a href="update.php?PRODUCT_ID=<?php echo $trad['PRODUCT_ID']; ?> ">Update</a></td>
      
    </tr>
    <?php }; ?>
  </tbody>
</table>
        </div>
        
    </div>
   
    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" >
        <?php
        $ro = mysqli_fetch_array($sql);
        
        echo '<h4>Name: ';    echo $ro["FIRSTNAME"]; '</h4>';
        echo '<h4>Username: ';  echo $_SESSION['trader'];  '</h4>';
        echo '<h4>Email: ';    echo $ro["EMAIL"]; '</h4>';
        echo '<h4>Birthdate: ';    echo $ro["BIRTHDATE"]; '</h4>';
        echo '<h4>Gender: ';   echo $ro["GENDER"]; '</h4>';
           ?> 

          <br>
          <br>
        <a href="changePass.php">Change Password</a>
    </div>
  </div>
</div>
    <a href="logout.php" class="btn btn-warning" style="text-decoration:none; color:white;">Logout</a>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"     integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT"      crossorigin="anonymous"></script>
</body>
</html>