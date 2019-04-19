<?php
session_start();

if(!isset(($_SESSION['email']))){

	echo '<script>alert("Please Login First");location="login.php";</script>';

}
else{
	$email = $_SESSION['email'];
include 'head.php';
$conn=mysqli_connect("localhost","root","rootdatabase","scanbook");

if ($conn->connect_error) {
    
	die("Connection failed: " . $conn->connect_error);

}else {
 
}

require 'GoogleBooks.php';
?>

<div class="container">
<div class="row">
	<div class="col-md-12">
		<?php
if(isset($_POST['submit']))
{
$query = $_POST['isbn'];

$sq = "SELECT `ISBN` FROM book where `email` = '$email' and `ISBN` = '$query'";
$res = $conn->query($sq);
$rw = $res->fetch_assoc();
$isbn = $rw['ISBN'];

if($isbn == $query){

$sql= "SELECT * FROM book where `ISBN`= '$query' and `email`='$email'";
$result=$conn->query($sql);

while($row=$result->fetch_assoc())

{

	$title=$row["title"];
	$author=$row["author"];
	$pagecount=$row["pagecount"];
	$description=$row["desc"];
	$read = $row['read'];
	$comm = $row['comments'];


	echo <<<eod
	
	<h2>Title:</h2>
	<p>$title</p>
	
	<h2>Author:</h2>
	<p>$author</p>
	

	<h2>Description:</h2>
	<p style='text-align:justify'>$description</p>


	<h2>Pagecount:</h2>
	<p>$pagecount</p>
	

	<h2>Read:</h2>
	<p>$read</p>
	

	<h2>Commment:</h2>
	<p>$comm</p>
	
	

eod;




}

}
else{

	if(isset($_POST['submit'])){


		$key = 'AIzaSyDtYMrwhEBkwtV6qJmS2TuwX-2qH-xSSBs';
		$book = new GoogleBooks\GoogleBooks($key);


		if ($book->searchByISBN($query)) {

		    // success

		    $title = $book->getTitle();

		    $author = implode(", ", $book->getAuthors());

			$pagecount = $book->getPageCount();

		    $description = mysqli_real_escape_string($conn, $book->getDescription());



			$sql="insert into book values ('$query','$title','$author','$description', '$pagecount','$email','','')";
			$res = mysqli_query($conn, $sql);
			if($res){
			echo <<<eod
			
			<h2>Title:</h2>
			<p>$title</p>
			

			<h2>Author:</h2>
			<p>$author</p>


			<h2>Description:</h2>
			<p style='text-align:justify'>$description</p>
			</div>

			<h2>Pagecount:</h2>
			<p>$pagecount</p>

			

eod;
		}
		else {
			echo mysqli_error($conn);
		}

		}else {

	    	echo 'ISBN not Valid. Please try again';

		}

	}else {
	echo 'Please enter ISBN';

	}
}
}

?>
<?php
/*
$sql= "Select book.ISBN,book.desc,book.title,book.author,book.pagecount,notes.read,notes.comments from book join notes on notes.isbn = book.ISBN where notes.email='.S_SESSION['email'].'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
$read= $row['read'];

while($row)
{
$comm = $row['comm'];
echo $comm."<br>";	
}
*/
?>

<h2 style="margin-top:3%">Additional Comments</h2>

 
   
    
    
  </div>
<form action="comments.php" method="post">
	
<input type="radio" name="read" value="yes">YES</br>
<input type="radio"  name="read" value="no">NO</br>
<input type="hidden" name="isbn" value="<?php echo $query?>">
<textarea name="comm" class="form-control" row="4" col="50" ></textarea></br>

<input type="submit" class="btn btn-danger form-group" style="height: 33px !important" name="submit" value="Submit" >

</form>
</div>
</div>
</div>

<?php
}
include 'footer.php';
?>