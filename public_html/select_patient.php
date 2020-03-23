<!DOCTYPE html>
<html>
<head>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>

<?php
require_once('db_setup.php');
$sql = "USE jyoung32_1;";
if ($conn->query($sql) === TRUE) {
   // echo "using Database tbiswas2_company";
} else {
   echo "Error using  database: " . $conn->error;
}
// Query:
$sql = "SELECT * FROM PATIENT";
$result = $conn->query($sql);
if($result->num_rows > 0){

?>
   <table class="table table-striped">
      <tr>
         <th>First name</th>
         <th>Middle Name</th>
         <th>Last name</th>
         <th>SSN</th>
         <th>Phone</th>
         <th>Address</th>
         <th>Email</th>
         <th>DOB</th>
         <th>Insurance Provider</th>
         <th>Provider Ssn</th>
      </tr>
<?php
while($row = $result->fetch_assoc()){

?>

      <tr>
          <td><?php echo $row['Fname']?></td>
          <td><?php echo $row['Mname']?></td>
          <td><?php echo $row['Lname']?></td>
          <td><?php echo $row['Ssn']?></td>
          <td><?php echo $row['Phone']?></td>
          <td><?php echo $row['Address']?></td>
          <td><?php echo $row['Email']?></td>
          <td><?php echo $row['DOB']?></td>
          <td><?php echo $row['Insurance_provider']?></td>
          <td><?php echo $row['Provider_Ssn']?></td>
      </tr>

<?php
}
}
else {
echo "Nothing to display";
}
?>

    </table>

<?php
$conn->close();
?>  

</body>
</html>
