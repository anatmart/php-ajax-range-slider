<?php
if (isset($_POST['price_range'])) {

    // Include database configuration file 
    include "dataconn_mysqli.php";

    // Set conditions for filter by price range 
    $whereSQL = '';
    $priceRange = $_POST['price_range'];
    if (!empty($priceRange)) {
        $priceRangeArr = explode(',', $priceRange);
        $whereSQL = "WHERE price BETWEEN '" . $priceRangeArr[0] . "' AND '" . $priceRangeArr[1] . "'";
        $orderSQL = " ORDER BY price ASC ";
    } else {
        $orderSQL = " ORDER BY id";
    }

    // Fetch matched records from database 
    $sql = "SELECT * FROM product $whereSQL $orderSQL";
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
?>
            <div class="list-item">
                <h2><?php echo $row["name"]; ?></h2>
                <h4>Price: ฿<?php echo $row["price"]; ?></h4>
            </div>
<?php
        }
    } else {
        echo '<p>Product(s) not found...</p>';
    }
}
?>