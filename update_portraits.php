<?php
// Connection details
include('db_connection.php');

// Check if Portrait_Id is set
if(isset($_REQUEST['Portrait_Id'])) {
    $pid = $_REQUEST['Portrait_Id'];
    
    // Retrieve portrait details for the selected portrait
    $stmt = $connection->prepare("SELECT * FROM Portrait WHERE Portrait_Id=?");
    $stmt->bind_param("i", $pid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $pname = $row['Portrait_Name'];
        $pcost = $row['Portrait_Price'];
    } else {
        echo "Portrait not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Update Portrait</title>
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <style>
    /* Include the CSS styles you provided */
    /* CSS styles */
  </style>
</head>
<body bgcolor="brown">
  <header>
    <!-- Header content -->
  </header>
  <section>
    <h1><u>Update Portrait Form</u></h1>
    <form method="post" onsubmit="return confirmUpdate()">
      <label for="pid">Portrait ID:</label>
      <input type="number" id="pid" name="pid" value="<?php echo isset($pid) ? $pid : ''; ?>" readonly><br><br>
      <label for="pname">Portrait Name:</label>
      <input type="text" id="pname" name="pname" value="<?php echo isset($pname) ? $pname : ''; ?>" required><br><br>
      <label for="pcost">Portrait Cost:</label>
      <input type="number" id="pcost" name="pcost" value="<?php echo isset($pcost) ? $pcost : ''; ?>" required><br><br>
      <input type="submit" name="update" value="Update">
    </form>
    <?php
      // Handle update operation
      if(isset($_POST['update'])) {
          // Retrieve updated values from the form
          $pname = $_POST['pname'];
          $pcost = $_POST['pcost'];
          
          // Update the portrait record in the database
          $stmt = $connection->prepare("UPDATE Portrait SET Portrait_Name=?, Portrait_Price=? WHERE Portrait_Id=?");
          $stmt->bind_param("sdi", $pname, $pcost, $pid);
          if ($stmt->execute()) {
              echo "Portrait record updated successfully.";
               // Redirect to portraits.php
              echo '<script>window.location.href = "portraits.php";</script>';
          } else {
              echo "Error updating portrait record: " . $stmt->error;
          }
          $stmt->close();
      }
    ?>
    <!-- Table of Portraits -->
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
