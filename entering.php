<!DOCTYPE html>
<html>
<head>
    <title>Welcome to HGBS QUIZ</title>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Quize</title>
	<link rel="stylesheet" type="text/css" href="entering.css">
</head>
<body>
	
<div id="menu">
    <div id="menu-items">
	<img src="Blogo.png"width='250'>
      <div class="menu-item"><a href="#">Home</a></div>
      <div class="menu-item"><a href="firstround.php" onclick="quiz()">Start Quiz</a></div>
	  <div class="menu-item"><a href ="playersymbol.php">Add Question</a></div>
	  <div class="menu-item"><a href ="delete.php">Delete Question</a></div>
	  <div class="menu-item"><a href ="phoenix.php">PHOENIX</a></div>
      <div class="menu-item"><a href="#">Sign up</a></div>
    </div>
    
  </div>
  
  
  <style>
		body {
			margin: 0;
			padding: 0;
			overflow: hidden;
		}
		video{
		position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit:cover;
    opacity: 0.8;
	z-index: -1;
}
.overlay{
    position: absolute;
    top: 0;
    left: 0;
    width:100%;
    height: 100%;
    background:black;
    opacity: 0.75;
	z-index: -1;
}

/*
		video {
			position: fixed;
			top: 50%;
			left: 50%;
			min-width: 100%;
			min-height: 100%;
			width: auto;
			height: auto;
			z-index: -100;
			transform: translateX(-50%) translateY(-50%);
			background-size: cover;
			object-fit: contain;
		}*/
	</style>
	<script>
		function quiz(){
			confirm("Are You Sure To Start Quiz?")
		}
		</script>
</head>
<body>
    <h1></h1>
    <div class="video">
	<video autoplay muted loop>
		<source src="My Movie 13.mov" type="video/mp4">
	</video>
	<div class="overlay"></div>
    </div>
</body>
</html>
