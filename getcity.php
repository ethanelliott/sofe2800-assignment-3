<select name="city" id="select_city">

<?php

$q = intval($_GET['q']);
'<br>';

$servername = "localhost";
$username =   "ethanell_hbs";
$password =   "password123";
$dbname =     "ethanell_sofe2800";
$con = new mysqli($servername, $username, $password, $dbname);
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"city");
$sql="SELECT * FROM city WHERE Cty_province_id = '".$q."'";
$result = mysqli_query($con,$sql);


      if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
              echo "<option value=". $row["Cty_id"].">" . $row['Cty_Name'] . "</option>";
          }
      } else {
          echo "0 results";
      }

mysqli_close($con);
?>

</select>
