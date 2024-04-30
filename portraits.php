<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Our Portraits</title>
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <style>
    /* Normal link */
    a {
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
    <h1><u>Portrait Form</u></h1>
    <form method="post">
      <label for="pid">Portrait ID:</label>
      <input type="number" id="pid" name="pid"><br><br>
      <label for="aid">Artist ID:</label>
      <input type="number" id="aid" name="aid"><br><br>
      <label for="wid">Warehouse ID:</label>
      <input type="number" id="wid" name="wid"><br><br>
      <label for="pname">Portrait Name:</label>
      <input type="text" id="pname" name="pname" required><br><br>
      <label for="pcost">Portrait Cost:</label>
      <input type="number" id="pcost" name="pcost" required><br><br>
      <input type="submit" name="add" value="Insert" onclick="return confirmInsert()"><br><br>
      <a class="button" href='home.html'>back to home</a>

    </form>
    
      
    <?php
      // PHP code for adding a new portrait record
     include('db_connection.php');
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $stmt = $connection->prepare("INSERT INTO Portrait (Portrait_id, Artist_id, Warehouse_id, Portrait_name, Portrait_cost) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $pid, $aid, $wid, $pname, $pcost);
        $pid = $_POST['pid'];
        $aid = $_POST['aid'];
        $wid = $_POST['wid'];
        $pname = $_POST['pname'];
        $pcost = $_POST['pcost'];
        if ($stmt->execute() == TRUE) {
          echo "New record has been added successfully";
        } else {
          echo "Error: " . $stmt->error;
        }
        $stmt->close();
      }
      $connection->close();
    ?>
    <h2>Table of Portraits</h2>
    <table border="5">
      <tr>
        <th>Portrait ID</th>
        <th>Artist ID</th>
        <th>Warehouse ID</th>
        <th>Portrait Name</th>
        <th>Portrait Cost</th>
        <th>Delete</th>
        <th>Update</th>
      </tr>
      <?php
       include('db_connection.php');
        $sql = "SELECT * FROM Portrait";
        $result = $connection->query($sql);
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            // Check if the keys exist before accessing them
            $pid = isset($row['Portrait_id']) ? $row['Portrait_id'] : '';
            $artistId = isset($row['Artist_id']) ? $row['Artist_id'] : '';
            $warehouseId = isset($row['Warehouse_id']) ? $row['Warehouse_id'] : '';
            $portraitName = isset($row['Portrait_name']) ? $row['Portrait_name'] : '';
            $portraitcost = isset($row['Portrait_cost']) ? $row['Portrait_cost'] : '';

            echo "<tr>
              <td>" . $pid . "</td>
              <td>" . $artistId . "</td>
              <td>" . $warehouseId . "</td>
              <td>" . $portraitName . "</td>
              <td>" . $portraitcost . "</td>
              <td><a style='padding:4px' href='delete_portraits.php?Portrait_id=$pid'>Delete</a></td> 
              <td><a style='padding:4px' href='update_portraits.php?Portrait_id=$pid'>Update</a></td> 
            </tr>";
          }
        } else {
          echo "<tr><td colspan='7'>No data found</td></tr>";
        }
        $connection->close();
      ?>
    </table>
  </section>
  <footer>
    <div style="text-align: center;"><b><h2>UR CBE BIT &copy; 2024 &reg; Designed by: @winnermwezi</h2></b></div>
  </footer>
  <script>
    function confirmInsert() {
      return confirm("Are you sure you want to insert this record?");
    }
  </script>
</body>
</html>
