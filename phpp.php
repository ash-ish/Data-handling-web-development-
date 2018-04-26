<?php
$con = mysqli_connect("localhost","root","","test");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  $fname = '';
  $lname = '';
  $roll = '';
  //insert query
  if (isset($_POST['insert'])) {
  	$fname = $_POST["fname"];
  	$lname = $_POST["lname"];
  	$roll = $_POST["roll"];
  	if (empty($fname)) {
  		echo "enter first name";
  	}elseif (empty($lname)) {
  		echo "enter last name";
  	}elseif (empty($roll)) {
  		echo "enter roll number";
  	}else
	$sql = "INSERT INTO `studdb` (fname,lname,roll) VALUES('$fname','$lname','$roll')";
  	if (mysqli_query($con, $sql)=== true) {
               echo "New record created successfully";
            } else {
               echo "Error: " . $sql . "" . mysqli_error($con);
            }
            $con->close();
         }
// select query
 if (isset($_POST['display'])) {
	$sql = 'SELECT * FROM studdb';
    $result = mysqli_query($con, $sql);

         if ($result && mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
               echo "fName: " . $row["fname"]. "<br>";
               echo "lName: " . $row["lname"]. "<br>";
               echo "roll: " . $row["roll"]. "<br>";
            }
         } else {
            echo "0 results";
         }
}
//update query
    if (isset($_POST['update'])) {
    	$fname = $_POST["fname"];
  		$lname = $_POST["lname"];
  		$roll = $_POST["roll"];
	if(empty($roll))
	{
		echo 'enter user roll number  to update';
	} else{
	$sql = "UPDATE `studdb` SET  fname = '$fname', lname = '$lname', roll = '$roll' WHERE roll = '$roll' ";
      if (mysqli_query($con, $sql)) {
      echo "Record updated successfully";
   } else {
      echo "Error updating record: " . mysqli_error($con);
   } 
	}
}
//delete query
 if (isset($_POST['delete'])) {
    $roll = $_POST["roll"];
	if(empty($roll))
	{
		echo 'enter roll number to delete';
	} else{
	$sql = "DELETE FROM `studdb` WHERE roll = '$roll'";
      if (mysqli_query($con, $sql)===true) {
      echo "Record deleted successfully";
   } else {
      echo "Error deleting record: " . mysqli_error($con);    }   }   }   ?>
<!DOCTYPE html>
<html>
<head>
	<title>Basic CRUD </title>
	<link rel="stylesheet" type="text/css" href="design.css">
</head>
<body>
<form action="phpp.php" method="POST">
<div class="complete">	
	<div align="center" class="heading">
		<h1>Student Data Base</h1>
	</div>
		<div align="center" class="text">
			<div class="field">
				<input type="text" name="fname" placeholder="first name"><br><br> 
				<input type="text" name="lname" placeholder="last name"><br><br>
				<input type="number" name="roll" placeholder="ROLL NUMBER"><br><br>
			</div>
			<div class="button">
				<input type="submit" name="insert" value="Insert">
				<input type="submit" name="display" value="Display All">
				<input type="submit" name="update" value="Update">
				<input type="submit" name="delete" value="Delete">
			</div>
		</div>
</div>		 </form>  
  </body>  
  </html>    