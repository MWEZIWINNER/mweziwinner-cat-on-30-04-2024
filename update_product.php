<?php
// Connection details
include('db_connection.php');

// Check if Product_Id is set
if(isset($_REQUEST['Portrait_Id'])) {
    $pid = $_REQUEST['Portrait_Id'];
    
    $stmt = $connection->prepare("SELECT * FROM Portrait WHERE portrait_Id=?");
    $stmt->bind_param("i", $pid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['Portrait_Id'];
        $y = $row['Portrait_Name'];
        $w = $row['Portrait_Price'];
    } else {
        echo "Product not found.";
    }
}
?>

<html>
<body>
    <form method="POST">
        <label for="pname">Portrait Name:</label>
        <input type="text" name="pname" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="pprice">Portrait Price:</label>
        <input type="number" name="pprice" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $Portrait_name = $_POST['pname'];
    $Portrait_price = $_POST['pprice'];
    
    // Update the product in the database
    $stmt = $connection->prepare("UPDATE Portrait SET Portrait_Name=?,  Portrait_Price=? WHERE Portrait_Id=?");
    $stmt->bind_param("ssdi", $Portrait_name,  $Portrait_price, $pid);
    $stmt->execute();
    
    // Redirect to product.php
    header('Location: product.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>