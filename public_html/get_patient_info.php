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
</head>
<body>

<?php
require_once('db_setup.php');
$sql = "USE jyoung32_1";
if ($conn->query($sql) === TRUE) {
   // echo "using Database tbiswas2_company";
} else {
   echo "Error using  database: " . $conn->error;
}

$Patient_fname = $_POST['Fname'];
$Patient_lname = $_POST['Lname'];
$Patient_DOB = $_POST['DOB'];

$sql1 = "SELECT * FROM PATIENT
	WHERE Fname='$Patient_fname' AND Lname='$Patient_lname' AND DOB='$Patient_DOB';";

$result = $conn->query($sql1);

if($result->num_rows > 0){
$row = $result->fetch_assoc();
$Patient_Ssn=$row['Ssn'];

$sql2 = "SELECT * FROM PRESCRIPTION NATURAL JOIN MEDICATION
	 WHERE Patient_Ssn='$Patient_Ssn';";
$sql3 = "SELECT * FROM APPOINTMENT, PROVIDER
	 WHERE Patient_Ssn='$Patient_Ssn' AND Provider_Ssn=Ssn;";
$sql4 = "SELECT * FROM DIAGNOSIS
	 WHERE Patient_Ssn='$Patient_Ssn';";
//if(TRUE){ 
?>
   <h3><p class="indented">Patient contact information</p></h3>
   <table class="table table-striped">
      <tr>
         <th>First name</th>
	 <th>Middle name</th>
         <th>Last name</th>
         <th>Email</th>
	 <th>Address</th>
      </tr>

      <tr>
          <td><?php echo $row['Fname']?></td>
	  <td><?php echo $row['Mname']?></td>
          <td><?php echo $row['Lname']?></td>
          <td><?php echo $row['Email']?></td>
          <td><?php echo $row['Address']?></td>
      </tr>


   </table>
   <h3><p class="indented">Current prescriptions</p></h3>
   <table class="table table-striped">
      <tr>
         <th>Brand name</th>
	 <th>Chemical name</th>
         <th>Date prescribed</th>
         <th>Dosage</th>
      </tr>

<?php
$result = $conn->query($sql2);
while($row = $result->fetch_assoc()){
?>
      <tr>
          <td><?php echo $row['Brand_name']?></td>
          <td><?php echo $row['Chemical_name']?></td>
          <td><?php echo $row['Dosage']?></td>
          <td><?php echo $row['DATE_PRESCRIBED']?></td>
      </tr>
<?php
}
?>
      </table>
      <h3><p class="indented">Upcoming appointments</p></h3>
      <table class="table table-striped">
        <tr>
         <th>Date</th>
	 <th>Time</th>
         <th>Provider name</th>
         <th>Copayment</th>
         <th>Reason for visit</th>
      </tr>
<?php
$result = $conn->query($sql3);
while($row = $result->fetch_assoc()) {
?>
      <tr>
          <td><?php echo $row['Appt_date']?></td>
          <td><?php echo $row['Appt_time']?></td>
          <td><?php echo $row['Fname'] . " " . $row['Lname']?></td>
          <td><?php echo $row['Copayment']?></td>
          <td><?php echo $row['Reason_for_visit']?></td>
      </tr>
<?php
}
?>

      </table>
      <h3><p class="indented">Active conditions</p></h3>
      <table class="table table-striped">
        <tr>
         <th>Condition name</th>
	 <th>Date diagnosed</th>
      </tr>
<?php
$result = $conn->query($sql4);
while($row = $result->fetch_assoc()) {
?>
      <tr>
          <td><?php echo $row['Condition_name']?></td>
          <td><?php echo $row['Date_diagnosed']?></td>
      </tr>
<?php
}
}
else {
echo "Item not found";
}
?>

    </table>

    <p class="indented"><a href="welcome.html">Return to homepage</a></p>
<?php
$conn->close();
?>  

</body>
</html>
