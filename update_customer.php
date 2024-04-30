<?php
// Connection details
include('db_connection.php');

// Check if Customer_id is set
if(isset($_REQUEST['Customer_id'])) {
    $cid = $_REQUEST['Customer_id'];
    
    // Retrieve customer details for the selected customer
    $stmt = $connection->prepare("SELECT * FROM customer WHERE Customer_id=?");
    $stmt->bind_param("i", $cid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $fname = $row['First_name'];
        $lname = $row['Last_name'];
        $Age = $row['Age'];
        $phn = $row['Phone_number'];
        $crd = $row['Creditcard_id'];
    } else {
        echo "Customer not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Our Customer</title>
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <style>
    /* Styles for header, section, footer */
    /* CSS styles */

    /* Include the CSS styles you provided */
  </style>
</head>
<body bgcolor="brown">
  <header>
    <!-- Header content -->
  </header>
  <section>
    <h1><u>Customer Form</u></h1>
    <form method="post" onsubmit="return confirmUpdate()">
      <label for="cid">Customer ID:</label>
      <input type="number" id="cid" name="cid" value="<?php echo isset($cid) ? $cid : ''; ?>"><br><br>
      <label for="fname">First Name:</label>
      <input type="text" id="fname" name="fname" value="<?php echo isset($fname) ? $fname : ''; ?>" required><br><br>
      <label for="lname">Last Name:</label>
      <input type="text" id="lname" name="lname" value="<?php echo isset($lname) ? $lname : ''; ?>" required><br><br>
      <label for="Age">Age:</label>
      <input type="number" id="Age" name="Age" value="<?php echo isset($Age) ? $Age : ''; ?>" required><br><br>
      <label for="phn">Phone Number:</label>
      <input type="tel" id="phn" name="phn" value="<?php echo isset($phn) ? $phn : ''; ?>" required><br><br>
      <label for="crd">Credit Card ID:</label>
      <input type="number" id="crd" name="crd" value="<?php echo isset($crd) ? $crd : ''; ?>" required><br><br>
      <input type="submit" name="update" value="Update">
    </form>
    <?php
      // Handle update operation
      if(isset($_POST['update'])) {
          // Retrieve updated values from the form
          $fname = $_POST['fname'];
          $lname = $_POST['lname'];
          $Age = $_POST['Age'];
          $phn = $_POST['phn'];
          $crd = $_POST['crd'];
          
          // Update the customer record in the database
          $stmt = $connection->prepare("UPDATE customer SET First_name=?, Last_name=?, Age=?, Phone_number=?, Creditcard_id=? WHERE Customer_id=?");
          $stmt->bind_param("sssiii", $fname, $lname, $Age, $phn, $crd, $cid);
          if ($stmt->execute()) {
              echo "Customer record updated successfully.";
               // Redirect to customer.php
              echo '<script>window.location.href = "customer.php";</script>';
          } else {
              echo "Error updating customer record: " . $stmt->error;
          }
          $stmt->close();
      }
    ?>
    <!-- Table of Customers -->
    <!-- Your table code here -->
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
