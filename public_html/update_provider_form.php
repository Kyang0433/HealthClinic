<!DOCTYPE html>
<html>
<head>

  <style>
    .indented {
      padding-left: 7px;
    }
  </style>

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="form8.css">
  <script src="form8.js"></script>

</head>
<body>

  <?php
  require_once('db_setup.php');
  $sql = "USE jyoung32_1";
  if ($conn->query($sql) === TRUE) {
    //echo "using Database jyoung32_1";
  } else {
   echo "Error using  database: " . $conn->error;
 }
 session_start();
 $Ssn = $_POST['Ssn'];
 $_SESSION['Ssn'] = $Ssn;

 $sql = "SELECT * FROM PROVIDER WHERE Ssn='$Ssn';";
 $result = $conn->query($sql);

 if($result->num_rows > 0){
  $row = $result->fetch_assoc();
  $Fname=$row['Fname'];
  $Mname=$row['Mname'];
  $Lname=$row['Lname'];
  $Title=$row['Title'];
  $Phone=$row['Phone'];
  $Email=$row['Email'];
  $Salary=$row['Salary'];
  ?>
  <div class="center">
    <div class="form-style-8">
      <h2> Update provider information</h2>
      <form action="update_provider.php" method="post">
        <label for="Fname">First Name: </label> <input value=<?php echo '"' . $Fname . '"'?> type="text" name="Fname" id="Fname" required><br>
        <label for="Mname">Middle Name: </label> <input value=<?php echo '"' . $Mname . '"'?> type="text" name="Mname" id="Mname"><br>
        <label for="Lname">Last Name: </label> <input value=<?php echo '"' . $Lname . '"'?> type="text" name="Lname" id="Lname" required><br>
        <label for="Title">Title: </label> <input value=<?php echo '"' . $Title . '"'?> type="text" name="Title" id="Title"  required><br>
        <label for="Ssn">SSN: </label> <input value=<?php echo '"' . $Ssn . '"'?> type="text" name="Ssn" id="Ssn" pattern="[0-9]{9}" required><br>
        <label for="Phone">Phone Number: </label> <input value=<?php echo '"' . $Phone . '"'?> type="text" name="Phone" id="Phone" required><br>
        <label for="Email">Email: </label> <input value=<?php echo '"' . $Email . '"'?> type="text" name="Email" id="Email" required><br>
        <label for="Salary">Salary: </label> <input value=<?php echo '"' . $Salary . '"'?> type="text" name="Salary" id="Salary" required><br>
        <input type="submit" value="Submit">
      </form>
    </div>
  </div>
  <?php
}
else {
  echo "Matching record not found.";
}
$conn->close();
?>  

</body>
</html>
