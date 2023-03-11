<?php  include 'db.php';
if(isset($_POST['submit'])){
	$question_number = $_POST['question_number'];//storing value of question number
	$question_text = $_POST['question_text'];//storing the submitted text
	$correct_choice = $_POST['correct_choice'];//storing the submutted right choice
	$round=$_POST['round'];
	$display=$_POST['display'];
	// Choice Array
	$choice = array();
	$choice[1] = $_POST['choice1'];
	$choice[2] = $_POST['choice2'];
	$choice[3] = $_POST['choice3'];
	$choice[4] = $_POST['choice4'];
	$choice[5] = $_POST['choice5'];
	$choice[6] = $_POST['choice6'];

	// $roundname='sa';
 // First Query for Questions Table

	$query = "INSERT INTO questions (";  //inserting the QN qnd question in the fields
	$query .= "question_number, question_text,round,display)";//table has two fieds 
	$query .= "VALUES (";
	$query .= " '{$question_number}','{$question_text}','{$round}','{$display}' ";//taking the values from top of the code
	$query .= ")";

	$result = mysqli_query($connection,$query);//we have includes the db.php file so connection can be used
    //then executing the query
	$check=0;
	//Validate First Query
	if($result){
		foreach($choice as $choices => $value){
			if($value != ""){
				if($correct_choice == $choices){
					$correct = 1;
				}else{
					$correct = 0;
				}

				//Second Query for Choices Table
				$query = "INSERT INTO choices (";
				$query .= "question_number,correct,choice)";
				$query .= " VALUES (";
				$query .=  "'{$question_number}','{$correct}','{$value}' ";
				$query .= ")";

				$insert_row = mysqli_query($connection,$query);
				
				// Validate Insertion of Choices
				if($insert_row){
					continue;
				}else{
					die("2nd Query for Choices could not be executed" . $query);
					
				}

			}
		}
		$message = "Question has been added successfully";
	}

	



//for the automatic increment of question added in database table
}

		$query = "SELECT * FROM questions";//taking the values from question name table
		$questions = mysqli_query($connection,$query);//executing and reslt store in variable questions
		$total = mysqli_num_rows($questions); //row = questions
		$next = $total+1;
		if($next==1){
			$roundname='1';
		}
		else{
			$roundname=$round;
		}		

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD QUESTION | HITS IT QUIZ 2023</title>
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
		<h2>ADD A QUESTION</h2>
        <!-- <div class="question-design"> -->
	 <form method="POST" action="addquestion.php">
		<!-- <div class="round"> -->
			<!-- <label>Round:</label><br> -->
		     <!-- <input type='text' name='round' placeholder='Enter Round' id='round'> -->
		<!-- </div> -->
	 <div class="question-design">
	 <label class="round">
			<label>Round:</label><br>
		     <input type='text' name='round' placeholder='Enter Round' id='round' value='<?php echo $roundname;?>'>
			 <label><abbr title='Enter the number for this when to be display'> Display at:</abbr></label>
			 <input type='number' name='display' placeholder='Round Display' id="display" value='<?php echo $display?>'>
	</label>
	 	<P>
	 		<label>Question Number:</label><br>
	 		<input type="number" name="question_number" value="<?php echo $next; ?>" id='ques' >
	 	</P>
		<!-- <input type='text' name='round' placeholder='Enter Round' id='round'> -->
	 	<p>
	 		<label>Enter the Quesion:</label><br>
	 		<input type="text" name="question_text" placeholder='Enter Your Question'>

	 	</p>
	 	<p>
	 		<label>Option 1:</label><br>
	 		<input type="text" name="choice1" placeholder='Option 1'>
	 	</p>
	 	<p>
	 		<label>Option 2:</label><br>
	 		<input type="text" name="choice2" placeholder='Option 2'>
	 	</p>
	 	<p>
	 		<label>Option 3:</label><br>
	 		<input type="text" name="choice3" placeholder="Option 3">

	 	</p>
	 	<p>
	 		<label>Option 4:</label><br>
	 		<input type="text" name="choice4" placeholder='Option 4'>	
	 	</p>
		 <p>
		 <label>Option 5:</label><br>
		 <input type="text" name="choice5" placeholder='Option 5'>	
		 </p>
		 <p>
		 <label>Option 6:</label><br>
		 <input type="text" name="choice6" placeholder='Option 6'>	
	 	</p>

	 	<p>
	 		<label>Correct option Number is:</label><br>
	 		<input type="number" name="correct_choice">
	 	</p>
        <div class="submit">
	 	<input type="submit" name="submit" value="Submit"></div>
		<a href='entering.php'>Done</a>
	 </form>
	 </div>

    <div class="massage">
		<?php if(isset($message)){
			echo "<h4>".$message ."<h4>";
		}?></div>
        <div class="pass">
            <a href='delete.php' class="change" onClick='deletefunc()'>Delete Questions</a>
            <a href='entering.php' class='change' onclick='change()'>Go To Home Page
        </div>
	</div>
	<script>

		</script>
    </body>
    </html>
    