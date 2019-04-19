<?php

$conn=mysqli_connect("localhost","root","rootdatabase","scanbook");

if ($conn->connect_error) {
    
	die("Connection failed: " . $conn->connect_error);

}else {
 
}
session_start();
include("head.php");
?>

<div>
<form method="post">
<table width="600" align="center" bgcolor="skyblue">

<tr align="center">
<td><h3>Login or Sign</h3></td>
</tr>

<tr>
<td><b>Email:</b></td>
<td><input type="text" name="email" placeholder="Enter Email" required></td>
</tr>
<tr>
<td><b>Password:</b></td>
<td><input type="password" name="pass" placeholder="Enter Password" required></td>
</tr>
<tr align="center">
<td><input type="submit" name="login" value="login"></td>
</tr>
</table>

	<h2 align="center"><a href="register.php" style="text-decoration:none">Create New Account</a></h2>
</form>
<?php

if(isset($_POST['login']))
{

$email=$_POST['email'];
$pass=$_POST['pass'];

$state="select * from user where email='$email' and pass='$pass'";
$run=mysqli_query($conn, $state);
$check=mysqli_num_rows($run);

if($check==0)
{

echo"<script>alert('Email or Password incorrect')</script>";
exit();
}
else
{
$_SESSION['email']=$email;
echo"<script>alert('Login Successfull');location:index.php;</script>";
echo "<script>window.open('index.php','_self')</script>";
}
}

?>

</div>
<?php

include("footer.php");
?>