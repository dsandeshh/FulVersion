<?php
include("db.php");
$query = "select * from questions";
$data = mysqli_query($connection,$query);
$total = mysqli_num_rows($data);
$que=array();
$que=mysqli_fetch_all($data, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HITS IT QUIZ 2023</title>
    <link rel='stylesheet'  href='Home.css'>
</head>
<body>
<div class="backgroundNHC">
     <video src="My Movie 13.mov" muted loop autoplay></video> 
            <div class="overlay"></div> 
    <div class="QandA">
    <h2 class="head"><img src="logo.png"width='250'></h2>
    <div class="round-rules">
    <okie class="bigRound">Round Name</okie><okie class="onlyround">Round</okie>
                <div class="rulesofround">
                    <li class='rules'>Player must Give Their answer before 5seconds</li>
                    <li class='rules'>Rule2</li>
                    <li class='rules'>Rule3</li>
                    <li class='rules'>Rule4</li>
                    <li class='rules'>Rule5</li>
                    <li class='rules'>Rule6</li>
                </div>
                <div class="startround"><a href='Home.php' text-decoration='none'>Start Round</a></div>
            </div>
</div>
</div>
<script>
       	let questions=<?php echo json_encode($que)?>;   //datas from database
	let question=[];
	for(key in questions){
		question.push([key,questions[key]])
	}
    let round=document.querySelector(".bigRound");
    round.innerHTML=question[0][1].round;
    </script>
</body>
</html>