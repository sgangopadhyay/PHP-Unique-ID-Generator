<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Unique ID Generator</title>
    <style media="screen">
      body{
        font-family: sans-serif;
      }
      header{
        font-size: 20px;
        text-align: center;
        text-decoration: underline;
        font-weight: bold;
      }
    </style>
  </head>
  <body>
    <!-- Unique ID Generator in PHP
    Program : PHP program to generate unique ID based on YEAR, MONTH and DATE
    Programmmed By : Suman Gangopadhyay
    Date : 20-July-2015
    Database : php_mysqli
    Table : unique_id
    Caveats : Please create a table of id(int)AUTO INCREMENT, unique_id(VARCHAR(11)), timestamp(timestamp) -->
    <header>Unique ID Generator in PHP</header>
    <form action="#" method="post">
      <input type="submit" name="submit" value="Generate Unique ID">
    </form>
    <?php
    // Program : PHP program to generate unique ID based on YEAR, MONTH and DATE
    // Programmmed By : Suman Gangopadhyay
    // Date : 20-July-2015
    //Database : php_mysqli
    //Table : unique_id
    //Caveats : Please create a table of id(int)AUTO INCREMENT, unique_id(VARCHAR(11)), timestamp(timestamp)
    define("IP","localhost");
    define("USERNAME","root");
    define("PASSWORD","suman");
    define("DBNAME","php_mysqli");
    $connection = mysqli_connect(IP, USERNAME, PASSWORD, DBNAME);
    if (isset($_POST['submit'])) {
      $sql_read = "SELECT `id` FROM unique_id";
      $sl_no = 0;
      $result = mysqli_query($connection,$sql_read);
      while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
        $sl_no = $sl_no + 1;
      }
      $last_id = $sl_no;
      $last_id = $last_id + 1;
      $date = date('d-m-Y');
      $day=date("d",strtotime($date));
      $month=date("m",strtotime($date));
      $year=date("Y",strtotime($date));
      $whole_date=$year.$month.$day;
      $unique_id=$whole_date.$last_id;
      // Insert the Unique ID into the Database in its specific column of the table
      $sql_write = "INSERT INTO unique_id (`unique_id`) VALUES('{$unique_id}')";
      if(!mysqli_query($connection, $sql_write)){
        echo "<script>alert('ERROR : Unique ID Generation Failed');</script>";
      }
      mysqli_close($connection);
    }
    // define("IP","localhost");
    // define("USERNAME","root");
    // define("PASSWORD","suman");
    // define("DBNAME","php_mysqli");
    $connection = mysqli_connect(IP, USERNAME, PASSWORD, DBNAME);
    $sql_read = "SELECT * FROM unique_id";
    $result = mysqli_query($connection, $sql_read);
    if($result){
      echo "<table id='tbl'>
    <tr>
      <th>Sl. No.</th>
      <th>ID</th>
      <th>Unique ID</th>
      <th>Time Stamp</th>
    </tr>";
    $sl_no = 0;
    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
      $sl_no = $sl_no + 1;
      echo "<tr>";
      echo "<td>".$sl_no."</td>";
      echo "<td>".$row['id']."</td>";
      echo "<td>".$row['unique_id']."</td>";
      echo "<td>".$row['timestamp']."</td>";
      echo "</tr>";
    }
    echo "</table>";
    }
    mysqli_close($connection);
    ?>
  </body>
</html>
