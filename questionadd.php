<?php  include 'db.php';
if(isset($_POST['submit'])){
	$question_number = $_POST['question_number'];//storing value of question number
	$question_text = $_POST['question_text'];//storing the submitted text
	$correct_choice = $_POST['correct_choice'];//storing the submutted right choice

	// Choice Array
	$choice = array();
	$choice[1] = $_POST['choice1'];
	$choice[2] = $_POST['choice2'];
	$choice[3] = $_POST['choice3'];
	$choice[4] = $_POST['choice4'];

 // First Query for Questions Table

	$query = "INSERT INTO questions (";  //inserting the QN qnd question in the fields
	$query .= "question_number, question_text )";//table has two fieds 
	$query .= "VALUES (";
	$query .= " '{$question_number}','{$question_text}' ";//taking the values from top of the code
	$query .= ")";

	$result = mysqli_query($connection,$query);//we have includes the db.php file so connection can be used
    //then executing the query

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
		

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Quize Question adding</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header>
		<div class="container">
			<P>QUIZE HGBS</P>
		</div>
	</header>

<main>
	<div class="container">
		<h2>ADD A QUESTION</h2>
		<?php if(isset($message)){
			echo "<h4>".$message ."<h4>";
		}?>
	 <form method="POST" action="questionadd.php">
	 	<P>
	 		<label>Question Number:</label>
	 		<input type="number" name="question_number" value="<?php echo $next; ?>">
	 	</P>

	 	<p>
	 		<label>Enter the Quesion:</label>
	 		<input type="text" name="question_text">

	 	</p>
	 	<p>
	 		<label>Choice 1:</label>
	 		<input type="text" name="choice1">
	 	</p>
	 	<p>
	 		<label>Choice 2:</label>
	 		<input type="text" name="choice2">
	 	</p>
	 	<p>
	 		<label>Choice 3:</label>
	 		<input type="text" name="choice3">

	 	</p>
	 	<p>
	 		<label>Choice 4:</label>
	 		<input type="text" name="choice4">	
	 	</p>
	 	<p>
	 		<label>Correct option Number is:</label>
	 		<input type="number" name="correct_choice">
	 	</p>
	 	<input type="submit" name="submit" value="submit">
	 </form>
	</div>
</main>
</body>
</html>