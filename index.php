
<?php
$servername = 'localhost'; $username = 'root'; $password = 'mysql'; $dbname = 'mini_project';
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
die('Connection failed: ' . mysqli_connect_error());
}
if(isset($_GET['action']) and $_GET['action'] == 'delete'){
$sql = 'DELETE FROM Employees WHERE id = ?';
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $_GET['id']);
$res = $stmt->execute();
$stmt->close();
mysqli_close($conn);
header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
die();
}
?>
<!DOCTYPE html>
<html lang='en'>
<head>
<meta charset='UTF-8'>
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
<title>DARBUOTOJAI</title>
<style>
* {
font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif;
}
table {
border-collapse: collapse;
width: 100%;
}
table td, table th {
border: 1px solid #ddd;
padding: 8px;
}
table tr:nth-child(even){
background-color: skyblue;
}
table tr:hover{
background-color: #ddd;
}
table th {
padding-top: 12px;
padding-bottom: 12px;
text-align: left;
background-color: yellowgreen;
color: white;
}
</style>
</head>
<body>


<?php


include "config.php";

	if (isset($_POST['submit'])) {
		// get variables from the form
		$first_name = $_POST['firstname'];
		$last_name = $_POST['lastname'];
	

		

		$sql = "INSERT INTO `employees`(`firstname`, `lastname`) VALUES ('$first_name','$last_name')";

	
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

<h2>Pridėti duomenis</h2>

<form action="" method="POST">
  <fieldset>
    <legend>Personal information:</legend>
    Name:<br>
    <input type="text" name="firstname">
    <br>
    Surname:<br>
    <input type="text" name="lastname">
    <br>
    <br><br>
    <input type="submit" name="submit" value="submit">
  </fieldset>
</form>


<?php
$sql = 'SELECT id, firstname, lastname FROM Employees';
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    print('<a href="indexx.php"><button>PROJEKTAI</button></a>');
print('<table>');
print('<thead>');
print('<tr><th>Id</th><th>Name</th><th>Surname</th><th>Actions</th></tr>');
print('</thead>');
print('<tbody>');
while($row = mysqli_fetch_assoc($result)) {
print('<tr>'
. '<td>' . $row['id'] . '</td>'
. '<td>' . $row['firstname'] . '</td>'
. '<td>' . $row['lastname'] . '</td>'
. '<td>' . '<a href="?action=delete&id=' . $row['id'] . '"><button>DELETE</button></a>' . '</td>'

. '</tr>');
}
print('</tbody>');
print('</table>');
} else {
echo '0 results';
}
mysqli_close($conn);



?>
</body>
</html>