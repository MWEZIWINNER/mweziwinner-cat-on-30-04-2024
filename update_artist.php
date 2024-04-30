<?php
// Connection details
include('db_connection.php');

// Check if Artist_id is set
if(isset($_REQUEST['Artist_id'])) {
    $aid = $_REQUEST['Artist_id'];
    
    // Retrieve artist details for the selected artist
    $stmt = $connection->prepare("SELECT * FROM artist WHERE Artist_id=?");
    $stmt->bind_param("i", $aid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $names = $row['Names'];
        $age = $row['Age'];
        $gender = $row['Gender'];
        $nationality = $row['Nationality'];
        $exp = $row['Experience'];
    } else {
        echo "Artist not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Our Artists</title>
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <style>
    /* Include the CSS styles you provided */
  </style>
</head>
<body bgcolor="brown">
  <header>
    <!-- Header content -->
  </header>
  <section>
    <h1><u>Artist Form</u></h1>
    <form method="post" onsubmit="return confirmUpdate()">
      <label for="aid">Artist ID:</label>
      <input type="number" id="aid" name="aid" value="<?php echo isset($aid) ? $aid : ''; ?>" readonly><br><br>
      <label for="names">Names:</label>
      <input type="text" id="names" name="names" value="<?php echo isset($names) ? $names : ''; ?>" required><br><br>
      <label for="age">Age:</label>
      <input type="text" id="age" name="age" value="<?php echo isset($age) ? $age : ''; ?>" required><br><br>
      <label for="gender">Gender:</label>
      <input type="text" id="gender" name="gender" value="<?php echo isset($gender) ? $gender : ''; ?>" required><br><br>
      <label for="nationality">Nationality:</label>
      <input type="text" id="nationality" name="nationality" value="<?php echo isset($nationality) ? $nationality : ''; ?>" required><br><br>
      <label for="exp">Experience:</label>
      <input type="text" id="exp" name="exp" value="<?php echo isset($exp) ? $exp : ''; ?>" required><br><br>
      <input type="submit" name="update" value="Update">
    </form>
    <?php
      // Handle update operation
      if(isset($_POST['update'])) {
          // Retrieve updated values from the form
          $names = $_POST['names'];
          $age = $_POST['age'];
          $gender = $_POST['gender'];
          $nationality = $_POST['nationality'];
          $exp = $_POST['exp'];
          
          // Update the artist record in the database
          $stmt = $connection->prepare("UPDATE artist SET Names=?, Age=?, Gender=?, Nationality=?, Experience=? WHERE Artist_id=?");
          $stmt->bind_param("sssssi", $names, $age, $gender, $nationality, $exp, $aid);
          if ($stmt->execute()) {
              echo "Artist record updated successfully.";
               // Redirect to artist.php
              echo '<script>window.location.href = "artist.php";</script>';
          } else {
              echo "Error updating artist record: " . $stmt->error;
          }
          $stmt->close();
      }
    ?>
    <!-- Table of Artists -->
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
