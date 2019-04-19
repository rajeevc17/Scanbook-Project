<?php
session_start();
include 'head.php';

?>




<div class="container">
<div class="row">
	<div class="col-md-12">

<h1 class="text-center" style="margin-top:1%">Search for a book by entering it's ISBN number:</h1>
<form method="post" action="books.php" style="margin-top:2%">
<div class="form-row">
<div class=" form-group col-sm-10" style="padding:0px !important;">
 
    <input type="text" value="" class="form-control" name="isbn" placeholder="ISBN Number" style="text-transform: uppercase;">
    </div>
    
    <input class="btn btn-danger form-group col-md-2" style="height: 33px !important"  value="Search" type="submit" name="submit">
    
  </div>
  
</form>

		<?php
		$conn=mysqli_connect("localhost","root","rootdatabase","scanbook");

if ($conn->connect_error) {
    
	die("Connection failed: " . $conn->connect_error);

}else {
 
}

$sql = "SELECT DISTINCT `ISBN`, `title`,`author`,`pagecount`,`desc` from book;";
$result=$conn->query($sql);

while($row=$result->fetch_assoc())

{

	$title=$row["title"];
	$author=$row["author"];
	$pagecount=$row["pagecount"];
	$description=$row["desc"];
	

	echo"
	<div class='col-md-4'>
	<h2>Title:</h2>
	<p>$title</p>
	

	<h2>Author:</h2>
	<p>$author</p>
	

	<h2>Description:</h2>
	<p style='text-align:justify'>$description</p>
	

	<h2>Pagecount:</h2>
	<p>$pagecount</p></div>";

}
	?>	
		
	</div>
</div>
</div>
<?php
include 'footer.php';
?>