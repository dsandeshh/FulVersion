<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Delete questions</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        *{
            font-family:'poppins',sans-serif;
        }
        body{
            overflow:hidden;
        }
        .heading{
            
            font-style:bold;
			color:white;
           
            

        }
        input{
            width:30%;
            text-color:#fff;
            height:5%;
            border:1px;
            border-radius:05px;
            padding:8px 15px 8px 15px;
        }
        table td{
            color:black;
            font-size:1.2em;
            padding:10px;
            text-align:center;
            
        }
        .btn{
            background:#fff;
            color:darkorange;
            font-size:1.2em;
            padding:5px 30px;
            text-decoration:none;
        }
        body{
            background:orangered;
        }
        table{
            background:white;
            
            min-width:max-content;
        }
        
        u{
            color:white;
            position:sticky;
        }
        .head{
    position: relative;
    left:50px;
    top: 20px;
    cursor: pointer;
}
   th{
    position:sticky;
    top:0px;
    background-color:orange;
    
   }
   .table-wrapper{
    max-height :300px;
    overflow-y:scroll;
    
   }
   th,td{
    padding: 10px;
   }  
   .link{
    margin-bottom :20px;
   }
   .link a{
    border: 1px solid white;
    background-color:white;
    color:black;
    width:60px;
    padding:5px 10px;
    border-radius:20px;
    text-align:center;
    text-decoration:none;
    position:relative;
    bottom:-10px;
    /* left:1200px; */
   }
   
    </style>
</head>
<body>
    <h2 class="head"><img src="logo.png"width='250'></h2>
    <center> <br> 
    <div class="heading"> 
        <u><h1>Delete Your Questions</h1></u>
</div>
        <div class="outer-wrapper">
            <div class="table-wrapper">
        <table  border="2px">
            <tr>
                <th>Question number</th>
                <th>Questions</th>
                <th>Choices</th>
                <th>Operation</th>
            </tr>
            <!-- <div class="link"> -->
                <!-- <div class="home"><a href='entering.php'>Home</a></div> -->
                <!-- <div class="addquestion"><a href='addquestion.php'>Home</a></div> -->
            <!-- </div> -->
            <?php
            include("db.php");
            if (isset($_GET['question_number'])){
                $question_number=$_GET['question_number'];
                
                // Delete from 'choices' table
                $delete_choices = mysqli_query($connection, "DELETE FROM `choices` WHERE question_number = '$question_number'");
                
                // Delete from 'questions' table
                $delete_questions = mysqli_query($connection, "DELETE FROM `questions` WHERE question_number = '$question_number'");
                
                if ($delete_choices && $delete_questions) {
                    echo '<script type="text/javascript">alert("Data Deleted")</script>';
                } else {
                    echo '<script type="text/javascript">alert("Data not Deleted")</script>';
                }
            }
            $query = "SELECT q.question_number, q.question_text, GROUP_CONCAT(c.choice SEPARATOR '|') AS choices
          FROM questions q
          JOIN choices c ON q.question_number = c.question_number
          GROUP BY q.question_number";
$data = mysqli_query($connection, $query);
$total = mysqli_num_rows($data);

if ($total != 0) {
    while (($result = mysqli_fetch_assoc($data))) {
        $choices = explode('|', $result['choices']);
        echo "
        <tr>
            <td>".$result['question_number']."</td>
            <td>".$result['question_text']."</td>
            <td>".implode(', ', $choices)."</td>
            <td>
                <a href='delete.php?question_number=".$result['question_number']."' class='btn'>Delete</a>
            </td>
        </tr>
        ";
    }
} else {
    echo "No records found";
}
mysqli_close($connection);

?>
</table>

</center>
<div class="link">
                <div class="home"><a href='entering.php'>Home</a></div>
                <div class="addquestion"><a href='addquestion.php'>Add Question</a></div>
            </div>

</div>
</body>
</html>