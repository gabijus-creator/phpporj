<?php
echo '<script>
 function showAddStudent() {    document.getElementById("formAdd").style.display="block"; document.getElementById("showbutton").style.display="none";}
 function showGrades() {    document.getElementById("formGrade").style.display="block"; document.getElementById("showUpdatebutton").style.display="none";}
</script>';


// Create connection
$conn = pg_connect(getenv("DATABASE_URL"));

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

	
	
	
$sql = "SELECT id, first_name, surname, address,telephone FROM students";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
	
    while($row = $result->fetch_assoc()) {
		echo '<table width="50%" border="1 " align="center">' ;
        echo "<tr align=center><td>id: " . $row["id"]."</td></tr> <tr align=center><td> Name: " . $row["first_name"]. "  " . $row["surname"]."</td></tr> <tr align=center><td>Address: " . $row["address"]."</td></tr><tr align=center><td>telephone: " . $row["telephone"]."</td></tr> <br>";
    echo '</table><br>';
	}
} else {
    echo "0 results"; }
	

$conn->close();
?> 