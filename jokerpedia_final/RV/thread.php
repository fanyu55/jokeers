<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Jokerpedia: View Thread</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
		.wrapper{ width: 80%; padding: 50px; margin:auto; }
    </style>
</head>
<body>
<?php
// Initialize the session
session_start();

// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../logout.php");
    exit;
}

// Include config file
require_once __DIR__.'\..\core\config.php';

// Define and Initialize Variables
$username = $_SESSION["username"];
$pid = $_GET['pid'];

?>

<!------------------------------------------------------------------------------------------------>
									<!-- RV THREAD --> 
<!------------------------------------------------------------------------------------------------>

<?php		
	// Prepare SELECT statement
	$sql = "SELECT * FROM review WHERE pid ='$pid'";
	
	// Execute Query
	$result = $mysqli->query($sql);
	
	// SQL query to get Title
	$sql1="SELECT title FROM post WHERE pid='$pid'" ;
	$result1 = $mysqli->query($sql1);
	$arrayResult1 = mysqli_fetch_array($result1);
	$title = $arrayResult1['title']; // store result into $title	
?>

<h1 class="my-5">Title: <?php echo $title ?><b> [<?php echo $username ?>]</b></h1>

<table class="wrapper" width=100% border=5px solid style=text-align:center>
	<?php
		if(mysqli_num_rows($result) > 0){
		//TABLE TOP ROW HEADINGS
			echo "<tr>";
			echo "<th>"."Date Time"."</th>";
			echo "<th>"."Posted By"."</th>";
			echo "<th>"."Comment"."</th>";
			echo "<th>"."Rating"."</th>";
			echo "<th>"."Action"."</th>";
			echo "</tr>";
			
			//Populate Queries
			while($row = mysqli_fetch_array($result)){
				echo "<tr>";
				echo "<td>". $row['datetime']."</td>";
				echo "<td>". $row['bidder']. "</td>";
				echo "<td>". $row['quote']."<br><br><br>".$row['comment']. "</td>";
				echo "<td>". $row['rating']. "</td>";
				echo "<td>". "<a href=replyThread.php?rid=".$row['rid']." class='btn btn-info'>Reply</a>". "</td>";
				echo "</tr>";
			}
		}
		else
			echo "<tr>"."<b>You have yet to review anything!</b>"."</tr>";
	?>	
</table>	
<!------------------------------------------------------------------------------------------------>
<br>
<br>
<a href="viewBid.php" class="btn btn-primary">Back</a>
</body>
</html>