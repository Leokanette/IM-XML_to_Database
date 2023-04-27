<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<?php

// Set up database connection
// $servername = "localhost";
// $username = "username";
// $password = "password";
// $dbname = "mydb";

$conn = mysqli_connect("localhost","root","","mydb");

$affectedRow = 0;

$xml = simplexml_load_file("employeedata.xml")
        or die("Error: Cannot create object");


foreach ($xml->children() as $row) {
   
    $employee_id = $row->employee_id;
    $first_name = $row->first_name;
    $Last_name = $row->Last_name;
    $email = $row->email;
    $phone_number = $row->phone_number;
    $hire_date = $row->hire_date;
    $job_id = $row->job_id;
    $salary = $row->salary;



    $sql = "INSERT INTO employee (employee_id,first_name,Last_name,email,phone_number,hire_date,job_id,salary) VALUES ('$employee_id','$first_name','$Last_name','$email','$phone_number','$hire_date','$job_id','$salary')";

    $result = mysqli_query($conn, $sql);

    if(! empty($result)){
        $affectedRow ++;
    } else {
        $error_message = mysqli_error($conn) . "\n";
    }
}
?>   
<center><h1>XML Data storing in Database</h1>

<?php 
if ($affectedRow > 0) {
    $message = $affectedRow . " records inserted";

}else {
    $message = "No records inserted";
}

?>
<style>
    body {
        max-width: 550px;
        font-family:  Arial;
    }
    .affected-row {
        background:  #cae4ca;
        padding: 10px;
        margin-bottom:  20px;
        border: #bdd6bd 1px solid;
        border-radius: 2px;
        color: #6e716e;
    }

    .error-message{

        background: #eac0c0;
        padding: 10px;
        margin-bottom:  20px;
        border: #dab2b2 1px solid;
        border-radius: 2px;
        color: #5d5b5b;
    }

</style>

<div class="affected-row">
    <?php echo $message; ?>

</div>

<?php

// MySQL database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Select all employees from database
$sql = "SELECT * FROM employee";
$result = mysqli_query($conn, $sql);

// Check if any employees were returned
if (mysqli_num_rows($result) > 0) {
  // Output data of each employee
  echo '<table class="table table-dark table-striped" cellpadding=5>
  <tr><th>Employee ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone Number</th><th>Hire Date</th><th>Job ID</th><th>Salary</th></tr>';

  while($row = mysqli_fetch_assoc($result)) {
    echo "<tr><td>".$row["employee_id"]."</td><td>".$row["first_name"]."</td><td>".$row["Last_name"]."</td><td>".$row["email"]."</td><td>".$row["phone_number"]."</td><td>".$row["hire_date"]."</td><td>".$row["job_id"]."</td><td>".$row["salary"]."</td></tr>";
  }
  echo "</table>";
} else {
  echo "0 results";
}


// Close connection
mysqli_close($conn);

?>
</center>