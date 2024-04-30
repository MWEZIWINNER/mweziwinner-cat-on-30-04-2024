<?php
// Connection details
include('db_connection.php');

// Check if Transactions_id is set
if(isset($_REQUEST['Transactions_id'])) {
    $tid = $_REQUEST['Transactions_id'];
    
    // Retrieve transaction details for the selected transaction
    $stmt = $connection->prepare("SELECT * FROM transactions WHERE Transactions_id=?");
    $stmt->bind_param("i", $tid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $cid = $row['Customer_id'];
        $oid = $row['Order_id'];
        $pid = $row['Portrait_id'];
        $date = $row['Date_and_time'];
    } else {
        echo "Transaction not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Update Transaction</title>
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
    <h1><u>Update Transaction</u></h1>
    <form method="post" onsubmit="return confirmUpdate()">
      <label for="tid">Transaction ID:</label>
      <input type="number" id="tid" name="tid" value="<?php echo isset($tid) ? $tid : ''; ?>" readonly><br><br>
      <label for="cid">Customer ID:</label>
      <input type="number" id="cid" name="cid" value="<?php echo isset($cid) ? $cid : ''; ?>" required><br><br>
      <label for="oid">Order ID:</label>
      <input type="number" id="oid" name="oid" value="<?php echo isset($oid) ? $oid : ''; ?>" required><br><br>
      <label for="pid">Portrait ID:</label>
      <input type="number" id="pid" name="pid" value="<?php echo isset($pid) ? $pid : ''; ?>" required><br><br>
      <label for="date">Date and Time:</label>
      <input type="text" id="date" name="date" value="<?php echo isset($date) ? $date : ''; ?>" required><br><br>
      <input type="submit" name="update" value="Update">
    </form>
    <?php
      // Handle update operation
      if(isset($_POST['update'])) {
          // Retrieve updated values from the form
          $cid = $_POST['cid'];
          $oid = $_POST['oid'];
          $pid = $_POST['pid'];
          $date = $_POST['date'];
          
          // Update the transaction record in the database
          $stmt = $connection->prepare("UPDATE transactions SET Customer_id=?, Order_id=?, Portrait_id=?, Date_and_time=? WHERE Transactions_id=?");
          $stmt->bind_param("iiisi", $cid, $oid, $pid, $date, $tid);
          if ($stmt->execute()) {
              echo "Transaction record updated successfully.";
               // Redirect to transaction.php
              echo '<script>window.location.href = "transaction.php";</script>';
          } else {
              echo "Error updating transaction record: " . $stmt->error;
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
