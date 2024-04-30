<?php
// Connection details
include('db_connection.php');

// Check if Order_Id is set
if(isset($_REQUEST['Order_id'])) {
    $oid = $_REQUEST['Order_id'];
    
    // Retrieve order details for the selected order
    $stmt = $connection->prepare("SELECT * FROM orders WHERE Order_id=?");
    $stmt->bind_param("i", $oid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $cid = $row['Customer_id'];
        $date = $row['Date_and_time'];
    } else {
        echo "Order not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Update Order</title>
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <style>
    /* Include any additional CSS styles you want */
  </style>
</head>
<body bgcolor="brown">
  <header>
    <!-- Header content -->
  </header>
  <section>
    <h1><u>Update Order</u></h1>
    <form method="post" onsubmit="return confirmUpdate()">
      <label for="oid">Order ID:</label>
      <input type="number" id="oid" name="oid" value="<?php echo isset($oid) ? $oid : ''; ?>" readonly><br><br>
      <label for="cid">Customer ID:</label>
      <input type="number" id="cid" name="cid" value="<?php echo isset($cid) ? $cid : ''; ?>" required><br><br>
      <label for="date">Date and Time:</label>
      <input type="datetime-local" id="date" name="date" value="<?php echo isset($date) ? $date : ''; ?>" required><br><br>
      <input type="submit" name="update" value="Update">
    </form>
    <?php
      // Handle update operation
      if(isset($_POST['update'])) {
          // Retrieve updated values from the form
          $cid = $_POST['cid'];
          $date = $_POST['date'];
          
          // Update the order record in the database
          $stmt = $connection->prepare("UPDATE orders SET Customer_id=?, Date_and_time=? WHERE Order_id=?");
          $stmt->bind_param("isi", $cid, $date, $oid);
          if ($stmt->execute()) {
              echo "Order record updated successfully.";
               // Redirect to order.php or any appropriate page
               echo '<script>window.location.href = "order.php";</script>';
          } else {
              echo "Error updating order record: " . $stmt->error;
          }
          $stmt->close();
      }
    ?>
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
