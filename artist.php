<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Our Artists</title>
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
    <h1><u>Artist Form</u></h1>
    <form method="post" onsubmit="return confirmInsert();">
      <label for="aid">Artist ID:</label>
      <input type="number" id="aid" name="aid"><br><br>
      <label for="names">Names:</label>
      <input type="text" id="names" name="names" required><br><br>
      <label for="age">Age:</label>
      <input type="number" id="age" name="age" required><br><br>
      <label for="gender">Gender:</label>
      <input type="text" id="gender" name="gender" required><br><br>
      <label for="nationality">Nationality:</label>
      <input type="text" id="nationality" name="nationality" required><br><br>
      <label for="exp">Experience:</label>
      <input type="text" id="exp" name="exp" required><br><br>
      <input type="submit" name="add" value="Insert" onclick="return confirmInsert()"><br><br>
      <a class="button" href='home.html'>back to home</a>

    </form>
    
      
    <?php
      // PHP code for adding a new artist record
      $host = "localhost";
      $user = "root";
      $pass = "";
      $database = "online_portrait_selling_management_system";
      $connection = new mysqli($host, $user, $pass, $database);
      if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
      }
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $stmt = $connection->prepare("INSERT INTO artist (Artist_id, Names, Age, Gender, Nationality, Experience) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", $aid, $names, $age, $gender, $nationality, $exp);
        $aid = $_POST['aid'];
        $names = $_POST['names'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $nationality = $_POST['nationality'];
        $exp = $_POST['exp'];
        if ($stmt->execute() == TRUE) {
          echo "New record has been added successfully";
        } else {
          echo "Error: " . $stmt->error;
        }
        $stmt->close();
      }
      $connection->close();
    ?>
    <h2>Table of Artist</h2>
    <table border="5">
      <tr>
        <th>Artist ID</th>
        <th>Names</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Nationality</th>
        <th>Experience</th>
        <th>Delete</th>
        <th>Update</th>
      </tr>
      <?php
        $host = "localhost";
        $user = "root";
        $pass = "";
        $database = "online_portrait_selling_management_system";
        $connection = new mysqli($host, $user, $pass, $database);
        if ($connection->connect_error) {
          die("Connection failed: " . $connection->connect_error);
        }
        $sql = "SELECT * FROM artist";
        $result = $connection->query($sql);
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $aid = $row['Artist_id'];
            echo "<tr>
              <td>" . $row['Artist_id'] . "</td>
              <td>" . $row['Names'] . "</td>
              <td>" . $row['Age'] . "</td>
              <td>" . $row['Gender'] . "</td>
              <td>" . $row['Nationality'] . "</td>
              <td>" . $row['Experience'] . "</td>
              <td><a style='padding:4px' href='delete_artist.php?Artist_id=$aid'>Delete</a></td> 
              <td><a style='padding:4px' href='update_artist.php?Artist_id=$aid'>Update</a></td> 
            </tr>";
          }
        } else {
          echo "<tr><td colspan='6'>No data found</td></tr>";
        }
        $connection->close();
      ?>
    </table>
  </section>
  <footer>
    <center>
      <b><h2>UR CBE BIT &copy; 2024 &reg; Designed by: @Winner MWEZI</h2></b>
    </center>
  </footer>
  <script>
    function confirmInsert() {
      return confirm("Are you sure you want to insert this record?");
    }
  </script>
</body>
</html>
