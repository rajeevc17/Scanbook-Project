<?php
session_start();
$conn=mysqli_connect("localhost","root","rootdatabase","scanbook");

if ($conn->connect_error) {
    
	die("Connection failed: " . $conn->connect_error);

}else {
 
}
if( isset($_POST['submit'])){

$read = $_POST['read'];
$comm=$_POST['comm'];
$email = $_SESSION['email'];
$query= $_POST['isbn'];

$sql="UPDATE book SET `read` = '$read', `comments` = '$comm' WHERE `email`='$email' AND `ISBN`='$query'";

$res = mysqli_query($conn, $sql);

if(!$res){

		echo mysqli_error($conn);
}

else{

	echo"<script>alert('Çomment Added');location='index.php';</script>";
}
}
?>