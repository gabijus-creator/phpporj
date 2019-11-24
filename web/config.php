<?php
$link = pg_connect(getenv("DATABASE_URL"));

 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>