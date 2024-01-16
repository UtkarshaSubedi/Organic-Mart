<?php
// Connection to the database
$connection = new mysqli("localhost", "root", "", "organic");

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check if traderType and shopId parameters are set
    if (isset($_GET['shopId'])) {
        $shopId = $_GET['shopId'];

        // Fetch products based on shop ID
        $products = fetchProductsFromDatabase($connection, $shopId);

        // Return products as JSON
        echo json_encode($products);
    } else {
        // Handle invalid or missing parameters
        echo json_encode(['error' => 'Invalid parameters']);
    }
}

// Function to fetch products from the database
function fetchProductsFromDatabase($connection, $shopId) {
    $products = [];

    // Fetch products based on your database structure
    $query = "SELECT p.product_name FROM s_shop_products sp
              INNER JOIN t_trader_products tp ON sp.product_id = tp.product_id
              WHERE tp.shop_id = ?";
    
    $statement = $connection->prepare($query);

    if ($statement) {
        $statement->bind_param('s', $shopId);
        $statement->execute();
        $result = $statement->get_result();

        while ($row = $result->fetch_assoc()) {
            $products[] = $row['product_name'];
        }

        $statement->close();
    }

    return $products;
}

$connection->close();
?>
