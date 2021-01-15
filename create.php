<?php 
include "config.php";

	if (isset($_POST['submit'])) {
		// get variables from the form
		$first_name = $_POST['firstname'];
		$last_name = $_POST['lastname'];
	

		//write sql query

		$sql = "INSERT INTO `employees`(`firstname`, `lastname`) VALUES ('$first_name','$last_name')";

		// execute the query

		$result = $conn->query($sql);

		if ($result == TRUE) {
			echo "New record created successfully.";
		}else{
			echo "Error:". $sql . "<br>". $conn->error;
		}

		$conn->close();

	}



?>

<!DOCTYPE html>
<html>
<body>

<h2>Signup Form</h2>

<form action="" method="POST">
  <fieldset>
    <legend>Personal information:</legend>
    First name:<br>
    <input type="text" name="firstname">
    <br>
    Last name:<br>
    <input type="text" name="lastname">
    <br>
    <br><br>
    <input type="submit" name="submit" value="submit">
  </fieldset>
</form>

</body>
</html>