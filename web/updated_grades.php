<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school";

// Create connection
$conn = pg_connect(getenv("DATABASE_URL"));

// Check connection
if ($conn->connect_error) {
    die("Connection to database failed: " . $conn->connect_error);
} 

$student=$_POST["student"];
$course=$_POST["course"];
$grades=$_POST["grades"];


$sql = "SELECT id FROM students WHERE first_name= '$student'";
$result = $conn->query($sql);
$studentId = $result->fetch_assoc();
 
$sql = "SELECT id FROM lessons WHERE name= '$course'";
$result = $conn->query($sql); 
$courseID=$result->fetch_assoc(); 
  

  $sql = "SELECT * FROM `grades` WHERE student_id='$studentId[id]' AND lesson_id= '$courseID[id]'";
   $result = $conn->query($sql);
   if ($result->num_rows > 0) {
   
		  $sql = " UPDATE `grades` 
		  SET `grade`='$grades'
		  WHERE grades.student_id='$studentId[id]'
		  AND grades.lesson_id= '$courseID[id]'";
		 
		 if ($conn->query($sql) === TRUE) {
			echo "Grade updated successfully <br>";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
   }}
   else{

		$sql= "INSERT INTO `grades`(`student_id`, `lesson_id`, `grade`) VALUES ('$studentId[id]','$courseID[id]','$grades')";
		 
		 if ($conn->query($sql) === TRUE) {
			echo "Grade inserted successfully <br>";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
   }}


   echo  'Student name: '.$student.'  Id: ' .$studentId["id"].'.<br> Lesson: ' .$course.'  Id:  '.$courseID["id"] .'.<br>The grade is: '. $grades; 
   echo '<htref= students.php >';
   echo '<br><a href="students.php "> Return back</a>';


?>