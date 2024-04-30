<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Our Orders</title>
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <style>
    /* Normal link */ a {
      padding: 10px;
      color: white;
      background-color: beige;
      text-decoration: none;
      margin-right: 15px;
    }
    /* Visited link */
    a:visited {
      color: purple;
    }
    /* Unvisited link */
    a:link {
      color: brown; /* Changed to lowercase */
    }
    /* Hover effect */
    a:hover {
      background-color: white;
    }
    /* Active link */
    a:active {
      background-color: red;
    }
    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 15px; /* Adjust this value as needed */
      padding: 8px;
    }
    section {
      padding: 71px;
      border-bottom: 1px solid #ddd;
    }
    footer {
      text-align: center;
      padding: 15px;
      background-color: beige;
    }
   
   .dropdown {
    position: relative;
    display: inline;
    margin-right:10px;
   }
   .dropdown-contents {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0,2);
    left:0;
   }
   .dropdown:hover .dropdown-contents{
    display: block;
   }
   .dropdown-contents a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;

   }
   .dropdown-contents a: hover{
    background-color: #f1f1f1;
   }
   section{
    padding: 80px;
    border-bottom: 1px solid #ddd;
   }
   footer{
    text-align: center;
    padding: 15px;
    background-color: white;
   }
  /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 15px; /* Adjust this value as needed */
      padding: 8px;
    }
    section {
      padding: 71px;
      border-bottom: 1px solid #ddd;
    }
    footer {
      text-align: center;
      padding: 15px;
      background-color: beige;
    }
    .button{
      border:5px solid;
      background-color: pink;
    }
  </style>
</head>
<body bgcolor="olive">
  <header>
    <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
    <ul style="list-style-type: none; padding: 0;">
      <li style="display: inline; margin-right: 10px;"><img src="./image/logo1.jpg" width="90" height="60" alt="Logo"></li>
      <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./customer.php">CUSTOMER</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./artist.php">ARTIST</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./transaction.php">TRANSACTION</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./order.php">ORDERS</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./warehouse.php">WAREHOUSE</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./portraits.php">PORTRAITS</a></li>
      <li class="dropdown" style="display: inline; margin-right: 10px;">
    <a href="#" class="dropdown-toggle" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
    <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
    </div>
</li>
    </ul>
  </header>
  <section>
    <h1><u>Orders Form</u></h1>
    <form method="post" onsubmit="return confirmInsert();">
      <label for="oid">Order ID:</label>
      <input type="number" id="oid" name="oid"><br><br>
      <label for="cid">Customer ID:</label>
      <input type="number" id="cid" name="cid" required><br><br>
      <label for="date">Date and Time:</label>
      <input type="datetime-local" id="date" name="date" required><br><br>
      <input type="submit" name="add" value="Insert" onclick="return confirmInsert()"><br><br>
      <a class="button" href='home.html'>back to home</a>
    </form>
    <?php
      // PHP code for adding a new order record
     include('db_connection.php');
      
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $oid = $_POST['oid'];
          $cid = $_POST['cid'];
          $date = $_POST['date'];
          
          // Validate input
          if (empty($oid) || empty($cid) || empty($date)) {
              echo "All fields are required.";
          } else {
              // Check if Customer_id exists in customer table
              $check_customer_sql = "SELECT Customer_id FROM customer WHERE Customer_id = ?";
              $check_customer_stmt = $connection->prepare($check_customer_sql);
              $check_customer_stmt->bind_param("i", $cid);
              $check_customer_stmt->execute();
              $check_customer_stmt->store_result();
              
              if ($check_customer_stmt->num_rows == 0) {
                  echo "Customer with ID $cid does not exist.";
              } else {
                  // Prepare and bind
                  $stmt = $connection->prepare("INSERT INTO orders (Order_id, Customer_id, Date_and_time) VALUES (?, ?, ?)");
                  $stmt->bind_param("iss", $oid, $cid, $date);
                  
                  // Execute the statement
                  if ($stmt->execute()) {
                      echo "New record has been added successfully";
                  } else {
                      echo "Error: " . $stmt->error;
                  }
                  
                  $stmt->close();
              }
              $check_customer_stmt->close();
          }
      }
      
      $connection->close();
    ?>
    <h2>Table of Orders</h2>
    <table border="1">
      <tr>
        <th>Order ID</th>
        <th>Customer ID</th>
        <th>Date and Time</th>
        <th>Delete</th>
        <th>Update</th>
      </tr>
      <?php
       include('db_connection.php');
        
        $sql = "SELECT * FROM orders";
        $result = $connection->query($sql);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $oid = $row['Order_id'];
                echo "<tr>
                  <td>" . $row['Order_id'] . "</td>
                  <td>" . $row['Customer_id'] . "</td>
                  <td>" . $row['Date_and_time'] . "</td>
                  <td><a href='delete_order.php?Order_id=$oid'>Delete</a></td>
                  <td><a href='update_order.php?Order_id=$oid'>Update</a></td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No data found</td></tr>";
        }
        
        $connection->close();
      ?>
    </table>
  </section>
  <footer>
    <center><b><h2>UR CBE BIT &copy; 2024 &reg; Designed by: @winnermwezi</h2></b></center>
  </footer>
  <script>
    function confirmInsert() {
      return confirm("Are you sure you want to insert this record?");
    }
  </script>
</body>
</html>
