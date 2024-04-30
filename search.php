<?php
if (isset($_GET['query'])) {
    // Connection details
   include('db_connection.php');

    $searchTerm = $connection->real_escape_string($_GET['query']);

    $sql_Portrait  = "SELECT * FROM Portrait  WHERE Portrait_id LIKE '%$searchTerm%'";
    $result_Portrait  = $connection->query($sql_Portrait );

    $sql_warehouse = "SELECT * FROM warehouse WHERE Warehouse_id LIKE '%$searchTerm%'";
    $result_warehouse = $connection->query($sql_warehouse);

    $sql_transactions = "SELECT * FROM transactions WHERE Transactions_id LIKE '%$searchTerm%'";
    $result_transactions = $connection->query($sql_transactions);

    $sql_artist = "SELECT * FROM artist WHERE Artist_id LIKE '%$searchTerm%'";
    $result_artist = $connection->query($sql_artist);

    $sql_customer = "SELECT * FROM customer WHERE Customer_id LIKE '%$searchTerm%'";
    $result_customer = $connection->query($sql_customer);

    $sql_orders = "SELECT * FROM orders WHERE Order_id LIKE '%$searchTerm%'";
    $result_orders = $connection->query($sql_orders);

    echo "<h2><u>Search Results:</u></h2>";

    echo "<h3>Portrait:</h3>";
    if ($result_Portrait->num_rows > 0) {
        while ($row = $result_Portrait->fetch_assoc()) {
            echo "<p>" . $row['Portrait_id'] . "</p>";
        }
    } else {
        echo "<p>No Portrait found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>warehouse:</h3>";
    if ($result_warehouse->num_rows > 0) {
        while ($row = $result_warehouse->fetch_assoc()) {
            echo "<p>" . $row['Warehouse_id'] . "</p>";
        }
    } else {
        echo "<p>No warehouse found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>transactions:</h3>";
    if ($result_transactions->num_rows > 0) {
        while ($row = $result_transactions->fetch_assoc()) {
            echo "<p>" . $row['Transactions_id'] . "</p>";
        }
    } else {
        echo "<p>No transactions found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>artist:</h3>";
    if ($result_artist->num_rows > 0) {
        while ($row = $result_artist->fetch_assoc()) {
            echo "<p>" . $row['Artist_id'] . "</p>";
        }
    } else {
        echo "<p>No artist entries found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>customer:</h3>";
    if ($result_customer->num_rows > 0) {
        while ($row = $result_customer->fetch_assoc()) {
            echo "<p>" . $row['Customer_id'] . "</p>";
        }
    } else {
        echo "<p>No customer found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>orders:</h3>";
    if ($result_orders->num_rows > 0) {
        while ($row = $result_orders->fetch_assoc()) {
            echo "<p>" . $row['Order_id'] . "</p>";
        }
    } else {
        echo "<p>No orders found matching the search term: " . $searchTerm . "</p>";
    }

    $connection->close();
} else {
    echo "No search term was provided.";
}
?>
