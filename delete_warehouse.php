<?php
// Connection details
include('db_connection.php');

// Check if Warehouse_id is set
if(isset($_REQUEST['Warehouse_id'])) {
    $wid = $_REQUEST['Warehouse_id'];
    
    // JavaScript confirmation for deletion
    echo '<script>
            function confirmdelete() {
              return confirm("Are you sure you want to delete this record?");
            }
          </script>';
    
    // Prepare and execute the DELETE statement after confirmation
    if (isset($_POST['confirm_delete']) && $_POST['confirm_delete'] == 'yes') {
        $stmt = $connection->prepare("DELETE FROM warehouse WHERE Warehouse_id=?");
        $stmt->bind_param("i", $wid); // Corrected variable name
        if ($stmt->execute()) {
            echo "Record deleted successfully.";
            // Redirect to warehouse.php
            echo '<script>window.location.href = "warehouse.php";</script>';
        } else {
            echo "Error deleting data: " . $stmt->error;
        }

        $stmt->close();
    } else {
        // Display confirmation dialog
        echo '<form method="post" onsubmit="return confirmdelete()">
                <input type="hidden" name="confirm_delete" value="yes">
                <input type="submit" value="Delete Record">
              </form>';
    }
} else {
    echo "Warehouse_id is not set."; // Error message if Warehouse_id is not set
}

$connection->close();
?>
