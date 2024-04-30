<?php
// Connection details
include('db_connection.php');

$Wid = null; // Initialize $Wid outside the if block

// Check if Warehouse_id is set
if(isset($_REQUEST['Warehouse_id'])) {
    $Wid = $_REQUEST['Warehouse_id'];
    
    // Retrieve warehouse details for the selected warehouse
    $stmt = $connection->prepare("SELECT * FROM warehouse WHERE Warehouse_id=?");
    $stmt->bind_param("i", $Wid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $wid = $row['Warehouse_id'];
        $location = $row['Location'];
    } else {
        echo "Warehouse not found.";
    }
}

// Handle update operation
if(isset($_POST['update'])) {
    // Retrieve updated values from the form
    $oid = $_POST['oid'];
    $location = $_POST['location'];
    
    // Update the warehouse record in the database
    $stmt = $connection->prepare("UPDATE warehouse SET Order_id=?, Location=? WHERE Warehouse_id=?");
    $stmt->bind_param("isi", $oid, $location, $Wid);
    if ($stmt->execute()) {
        echo "Warehouse record updated successfully.";
        // Redirect to warehouse.php
        echo '<script>window.location.href = "warehouse.php";</script>';
    } else {
        echo "Error updating warehouse record: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Update Warehouse</title>
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <style>
    /* CSS styles */
    /* Include the CSS styles you provided */
  </style>
</head>
<body bgcolor="brown">
  <header>
    <!-- Header content -->
  </header>
  <section>
    <h1><u>Update Warehouse Form</u></h1>
    <form method="post" onsubmit="return confirmUpdate()">
      <input type="hidden" name="wid" value="<?php echo isset($Wid) ? $Wid : ''; ?>">
      <label for="oid">Order ID:</label>
      <input type="number" id="oid" name="oid" value="<?php echo isset($oid) ? $oid : ''; ?>" required><br><br>
      <label for="location">Location:</label>
      <input type="text" id="location" name="location" value="<?php echo isset($location) ? $location : ''; ?>" required><br><br>
      <input type="submit" name="update" value="Update">
    </form>
  </section>
  <footer>
    <!-- Footer content -->
  </footer>
  <script>
    function confirmUpdate() {
      return confirm("Are you sure you want to update this record?");
    }
  </script>
</body>
</html>
