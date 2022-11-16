<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Jokerpedia: Reply</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
		.wrapper{ width: 75%; padding: 50px; margin:auto; }
    </style>
</head>
<body>

<?php

// Initialize the session
session_start();

// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["usertype"] !== 'Reviewer'){
    header("location: ../logout.php");
    exit;
}

// Include config file
require_once __DIR__.'\..\core\config.php';

// Define and Initialize Variables (Bidder Username)
$bidder = $_SESSION["username"];


// Check if id is set or not if true toggle
    if (isset($_GET['rid'])){
  
        // Store the value from get to a local variable "$rid"
        $rid=$_GET['rid'];
		
		// SQL query to retrive data
		$sql="SELECT * FROM review WHERE rid='$rid'" ;
		$result = $mysqli->query($sql);
		$arrayResult = mysqli_fetch_array($result);
		$title = $arrayResult['title']; // store result into $title
		$author = $arrayResult['author']; // store result into $author
		$quote = $arrayResult['comment']; // store result into $quote
		$pid = $arrayResult['pid']; // store result into $pid
		$username = $arrayResult['bidder']; // store original poster name into $username
		
		// Rating as N/A (for replies)
		$rating = "NA";
	}
?>

<!------------------------------------------------------------------------------------------------>
									<!-- RV REPLY THREAD --> 
<!------------------------------------------------------------------------------------------------>
<h1>Reply Thread <b>[<?php echo $bidder ?>]</b></h1>

<?php
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

	$comment = trim($_POST["comment"]);
	$title = trim($_POST["title"]);
	$author = trim($_POST["author"]);
	$quote = trim($_POST["quote"]);
	$pid = trim($_POST["pid"]);
	$username = trim($_POST["bidder"]);
	$rating = trim($_POST["rating"]);
	
	// Actual quote that will be posted after inserting quoted
	$actualQuote = "Quoted From: ".$username."<br>"."< ".$quote." >";
	
	// Prepare SQL statement to insert replied comment
	$sql = "INSERT INTO review (pid,title,author,bidder,rating,quote,comment) VALUES ('$pid', '$title', '$author', '$bidder', '$rating', '$actualQuote', '$comment')";
	$mysqli->query($sql);
	
	// Close connection and return back
	$mysqli->close();
	echo ("<script LANGUAGE='JavaScript'>
			window.alert('Comment SENT!')
			window.location.href='viewBid.php' 
			</script>");
	exit;
		
}
?>

<!-- REVIEW DETAILS -->
	<div class="wrapper">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> 			
            <div class="form-group"> 
				<label>Comment</label>
				<br/>
                <textarea id="comment" name="comment" rows="5" cols="75" style="font-size:1em;padding-left:3px;min-height:60px;width:75%;"></textarea>
            </div> 
            <div class="form-group">
				<input type="hidden" id="pid" name="pid" value="<?php echo $pid; ?>">
				<input type="hidden" id="author" name="author" value="<?php echo $author ?>">
				<input type="hidden" id="title" name="title" value="<?php echo $title ?>">
				<input type="hidden" id="bidder" name="bidder" value="<?php echo $username ?>">
				<input type="hidden" id="quote" name="quote" value="<?php echo $quote ?>">
				<input type="hidden" id="rating" name="rating" value="<?php echo $rating ?>">				
                <input type="submit" class="btn btn-warning" value="Submit">
				<a href="viewBid.php" class="btn btn-primary">Back</a>
            </div>
        </form>
    </div>    
</body>
</html>