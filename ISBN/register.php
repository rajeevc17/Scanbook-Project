<!DOCTYPE>
<?php
$conn=mysqli_connect("localhost","root","rootdatabase","scanbook");

if ($conn->connect_error) {
    
	die("Connection failed: " . $conn->connect_error);

}else {
 
}

session_start();
include("head.php");
?>
<html>
	<head>
		<title></title>

	</head>
<body>
<form action="register.php" method="post" enctype="multipart/form-data">
<table align="center">

<tr>
<td><h2>Create an Account</h2></td>
</tr>


<tr>
<td>Enter First Name</td>
<td><input type="text" name="fname" required></td>
</tr>

<tr>
<td>Enter Last Name</td>
<td><input type="text" name="lname" required></td>
</tr>

<tr>
<td>Enter Address</td>
<td><textarea rows="3" cols="22" name="address" required></textarea></td>
</tr>

<tr>
<td>Enter Age</td>
<td><input type="text" name="age" required></td>
</tr>

<tr>
<td>Enter Email</td>
<td><input type="text" name="email" required></td>
</tr>

<tr>
<td>Enter Phone</td>
<td><input type="text" name="phone" required></td>
</tr>


<tr>
<td>Enter Password</td>
<td><input type="password" name="pass" required></td>
</tr>

<tr align="center">
<td><input type="submit" name="register" value="Create Account"></td>
</tr>

</table>
</form>
</div>

</body>
</html>


<?php

if(isset($_POST['register']))
{

$fname=$_POST['fname'];
$lname=$_POST['lname'];
$address=$_POST['address'];
$age=$_POST['age'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$pass=$_POST['pass'];

$statement="insert into user (fname,lname,address,age,email,phone,pass) values ('$fname','$lname','$address','$age','$email','$phone','$pass')";
$result=mysqli_query($conn, $statement);


if(!$result){
echo mysqli_error($conn);
}
else
{
$_SESSION['email']=$email;
echo"<script>alert('Account has been created Successfully')</script>";
echo "<script>window.open('index.php','_self')</script>";

}

}

include("footer.php");

?>
