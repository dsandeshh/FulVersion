<?php  include 'db.php';
if(isset($_POST['submit'])){
	$player1 = $_POST['player1'];//to store players Symbol
	$player2 = $_POST['player2'];
	$player3 = $_POST['player3'];
	$player4 = $_POST['player4'];
	$marks = $_POST['marks'];
	$pm = $_POST['pm'];
	// Choice Array
	$choice = array();
	$query = "INSERT INTO players (";  //inserting the QN qnd question in the fields
	$query .= "player1,player2,player3,player4,marks,pm)";//table has two fieds 
	$query .= "VALUES (";
	$query .= " '{$player1}','{$player2}','{$player3}','{$player4}','{$marks}','{$pm}' ";//taking the values from top of the code
	$query .= ")";

	$result = mysqli_query($connection,$query);//we have includes the db.php file so connection can be used
    //then executing the query
		$message = "Players has been added successfully";
}	
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Round Sequence | HITS IT QUIZ 2023</title>
    <link rel='stylesheet'  href='Home.css'>
    <link rel='stylesheet'  href='add.css'>
</head>
<body>
<div class="backgroundNHC">
     <video src="My Movie 13.mov" muted loop autoplay></video> 
            <div class="overlay"></div> 
            <div class="QandA">
    <h2 class="head"><img src="logo.png"width='250'></h2>
    <div class="container">
		<h2>Enter The one letter Symbol of the players</h2>
	 <form method="POST" action="">
		<!-- </div> -->
	 <div class="question-design">
	 	<P>
	 		<label>One letter Symbol of the players at</label><br>
	 	<p>
	 		<label>Player 1:</label><br>
	 		<input type="text" name="player1" placeholder='Player 1'>
	 	</p>
	 	<p>
	 		<label>Player 2:</label><br>
	 		<input type="text" name="player2" placeholder='Player 2'>
	 	</p>
	 	<p>
	 		<label>Player 3:</label><br>
	 		<input type="text" name="player3" placeholder="Player 3">

	 	</p>
	 	<p>
	 		<label>Player 4:</label><br>
	 		<input type="text" name="player4" placeholder='Player 4'>	
	 	</p>
		 <p>
	 		<label>Enter marks for a question:</label><br>
	 		<input type="number" name="marks" placeholder='Marks'>	
	 	</p>
		 <p>
		 <label>Enter passed marks for same question:</label><br>
	 		<input type="number" name="pm" placeholder='Passed Marks'>	
	 	</p>
        <div class="submit">
	 	<input type="submit" name="submit" value="Submit"></div>
		<a href='addquestion.php'>Done</a>
</div>
<!--<div class="round">
			<label>Round:</label><br>
		     <input type='text' name='round' placeholder='Enter Round' id='round' value='<?php echo $roundname;?>'>
		</div>-->
	 </form>
        <div class="pass">
            <a href='' class="change" onClick='rate()'>Rate Us</a>
            <a href='Home.php' class='change' onclick='change()'>Go To Home Page
        </div>
	</div>
	<script>

		</script>
    </body>
    </html>
    