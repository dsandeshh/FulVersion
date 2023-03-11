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
            <div class="round-rules" hidden>
                <okie class="bigRound">Round Name</okie><okie class="onlyround">Round</okie>
                <div class="rulesofround">
                    <li class='rules'>Rule1</li>
                    <li class='rules'>Rule2</li>
                    <li class='rules'>Rule3</li>
                    <li class='rules'>Rule4</li>
                    <li class='rules'>Rule5</li>
                    <li class='rules'>Rule6</li>
                </div>
                <div class="startround" onclick='startRound()'>Start Round</div>
            </div>
            <div class="allresult" hidden>
                <li class='posi'><label class='leader'>J:0</label></li>
                <li class='posi'><label class='leader'>K:0</label></li>
                <li class='posi'><label class='leader'>L:0</label></li>
                <li class='posi'><label class='leader'>M:0</label></li>
                <a href='entering.php'>Home</a>
            </div>
            <div class="quizpart" hidden>
            <div class="main-container center">
        <!-- progress indicator -->
        <div class="circle-container center">
            <div class="semicircle"></div>
            <div class="semicircle"></div>
            <div class="semicircle"></div>
            <div class="outermost-circle"></div>
        </div>
        <div class="timer-container center">
            <div class="timer center"></div>
        </div>
</div>
            <div class="round">Your Round Here</div>
            <div class="question">
                <span class='Qno'>Q</span>.
                <span class="question-text">Your question Here</span>
            </div>
            <div class="option" onclick='checkA()' disabled>a.<a class='a'>Option 1</a><s class="tick"><label class='right' hidden>&#10004;</label><label1 class='wrong' hidden>&#9587;</s></div>
            <div class="option" onclick='checkB()' disabled>b.<a class='b'>Option 2</a><s class="tick"><label class='right' hidden>&#10004;</label><label1 hidden class='wrong'>&#9587;</s></div>
            <div class="option" onclick='checkC()' disabled>c.<a class='c'>Option 3</a><s class="tick"><label class='right' hidden>&#10004;</label><label1 hidden class='wrong'>&#9587;</s></div>
            <div class="option" onclick='checkD()' disabled>d.<a class='d'>Option 4</a><s class="tick"><label class='right' hidden>&#10004;</label><label1 class='wrong' hidden>&#9587;</s></div>
            <div class="option" onclick='checkE()' disabled>e.<a class='e'>Option 5</a><s class="tick"><label class='right' hidden>&#10004;</label><label1 class='wrong' hidden>&#9587;</s></div>
            <div class="option" onclick='checkF()' disabled>f.<a class='f'>Option 4</a><s class="tick"><label class='right' hidden>&#10004;</label><label1 class='wrong' hidden>&#9587;</s></div>
            <div class="imagehere"></div>
        <div class="event">
            <div class="abaft" onclick='abaft()'>	<label>&#8592;<label><label>Abaft</label></div>    <!--Here I am making go back to previous question Option-->
        </div>
        <div class="event pos">
            <div class="abaft" onclick='pass()' >	<label class='pass'>----<label><label>&#8594;</label></div></div>
        <div class="event help" >
        <div class="abaft"  onclick='help()' >	<label class='Help1'>Pass<label><label>&#8594;</label></div></div>   

        <div class="result">
            <div class="group"><label class='player'>J</label>:<num class='marks'>00</num></div>
            <div class="group"><label class='player'>K</label>:<num class='marks'>00</num></div>
            <div class="group"><label class='player'>L</label>:<num class='marks'>00</num></div>
            <div class="group"><label class='player'>M</label>:<num class='marks'>00</num></div>
            <!-- <div class="group"><label>N</label>:<num>00</num></div> -->
            <!-- <div class="group"><label>O</label>:<num>00</num></div> -->
        </div>
        <div class="bottom">
        &#169; Affliated To Horizon Gautam Buddha School,Drivertole,Rupandehi,Nepal.
        </div></div>
</div>
<?php
include("db.php");
$query = "select * from questions";
$data = mysqli_query($connection,$query);
$total = mysqli_num_rows($data);
$que=array();
$que=mysqli_fetch_all($data, MYSQLI_ASSOC);
$querychoice = "select * from choices";
$datachoice = mysqli_query($connection,$querychoice);
$totalchoice = mysqli_num_rows($datachoice);
$quechoice=array();
$quechoice=mysqli_fetch_all($datachoice, MYSQLI_ASSOC);
$queryplayers = "select * from players";
$dataplayer = mysqli_query($connection,$queryplayers);
$totalplayer = mysqli_num_rows($dataplayer);
$queplayer=array();
$queplayer=mysqli_fetch_all($dataplayer, MYSQLI_ASSOC);
?>
 <script src='Home.js'></script>
 <script>
    //taking data from database as object from json code and changing it into array and using . 
    	let questions=<?php echo json_encode($que)?>;   //datas from database
	let question=[];
	for(key in questions){
		question.push([key,questions[key]])
	}
     let choices=<?php echo json_encode($quechoice)?>;   //datas of choice from database
    let choice=[];
    for(key in choices){
        choice.push([key,choices[key]])
    }
    let players=<?php echo json_encode($queplayer)?>;   //datas of choice from database
    let player=[];
    for(key in players){
        player.push([key,players[key]])
    }
    let datafromweb=[];
    let x=0;
    let rightx=0;
    lenques=question.length-1;//for if else
    let lengthchoice=choice.length;
    let Qno=0;
    let questforchoice=Qno+1;
    let playerweb=document.querySelectorAll(".player");
    let quizPart=document.querySelector(".quizpart");
    quizPart.hidden=false;
    let Pass=document.querySelector('.pass');
    let options=document.querySelectorAll(".option");
    let question_text=document.querySelector(".question-text");
    let question_number=document.querySelector('.Qno');
    let right=document.querySelectorAll(".right");
    let wrong=document.querySelectorAll(".wrong");
    let round=document.querySelector(".round");
    let bigRound=document.querySelector(".bigRound");
    let optionA=document.querySelector('.a');
    let optionB=document.querySelector('.b');
    let optionC=document.querySelector('.c');
    let optionD=document.querySelector('.d');
    let optionE=document.querySelector('.e');
    let optionF=document.querySelector('.f');
    let marking=document.querySelectorAll(".marks");
    let leader=document.querySelectorAll(".leader");
    let roundRules=document.querySelector(".round-rules");
    question_number.innerHTML=question[Qno][1].question_number;
    question_text.innerHTML=question[Qno][1].question_text;
    round.innerHTML=question[Qno][1].round;
    let c=0;
    let checkcorrect=[];
    let rightans;
    let player1marks=0;
    let player2marks=0;
    let player3marks=0;
    let player4marks=0;
    let playerjs=player[0][1].player1;
    let onelastsa=0;
    let pvalpercent;
    let marksadd=0;
    for(let l=0;l<player.length;l++){
        playerweb[0].innerHTML=player[0][1].player1;
        playerweb[1].innerHTML=player[0][1].player2;
        playerweb[2].innerHTML=player[0][1].player3;
        playerweb[3].innerHTML=player[0][1].player4;
    }
    marking[0].innerHTML=marksadd;
    marking[1].innerHTML=marksadd;
    marking[2].innerHTML=marksadd;
    marking[3].innerHTML=marksadd;
    let allresult=document.querySelector(".allresult");
    let rightpass=0;
    let pval=0;//passing value for time to renew
    let pvalfail=0;//for passing of wrong answers
    // let sa=pvalfail%3;
    // console.log(sa);
    for(let a=0;a<=lengthchoice;a++){
        if(choice[a][1].question_number==questforchoice){
            c=c+1;
            if(c==1){
                optionA.innerHTML=choice[a][1].choice;
                checkcorrect[0]=choice[a][1].correct;
            }
            if(c==2){
                optionB.innerHTML=choice[a][1].choice;
                checkcorrect[1]=choice[a][1].correct;
            }
            if(c==3){
                optionC.innerHTML=choice[a][1].choice;
                checkcorrect[2]=choice[a][1].correct;
            }
            if(c==4){
                optionD.innerHTML=choice[a][1].choice;
                checkcorrect[3]=choice[a][1].correct;
            }
            if(c==5){
                optionE.innerHTML=choice[a][1].choice;
                checkcorrect[4]=choice[a][1].correct;
            }
            if(c==6){
                optionF.innerHTML=choice[a][1].choice;
                checkcorrect[5]=choice[a][1].correct;
            }
        }
        else{
            c=0;
        }
    }
    function help(){
        pval=0;
            pvalfail=pvalfail+1;
            rightans=rightx%4;
            sa=pvalfail%4;
            if(rightans==0){
            if(sa==0){                    playerjs=player[0][1].player1;            }
            if(sa==1){                    playerjs=player[0][1].player2;
            }
            if(sa==2){                    playerjs=player[0][1].player3;            }
            if(sa==3){                    playerjs=player[0][1].player4;            }}
            if(rightans==1){
            if(sa==0){                    playerjs=player[0][1].player2;            }
            if(sa==1){                    playerjs=player[0][1].player3;
            }
            if(sa==2){                    playerjs=player[0][1].player4;            }
            if(sa==3){                    playerjs=player[0][1].player1;            }}
            if(rightans==2){
            if(sa==0){
                    playerjs=player[0][1].player3;
            }
            if(sa==1){
                    playerjs=player[0][1].player4;

            }
            if(sa==2){
                    playerjs=player[0][1].player1;
            }
            if(sa==3){
                    playerjs=player[0][1].player2;
            }}
            if(rightans==3){
            if(sa==0){
                    playerjs=player[0][1].player4;
            }
            if(sa==1){
                    playerjs=player[0][1].player1;
            }
            if(sa==2){
                    playerjs=player[0][1].player2;
            }
            if(sa==3){
                    playerjs=player[0][1].player3;
            }}
            if(pvalfail==1){
                options[5].style.border='1px solid white';
                options[5].style.backgroundColor='white';
                options[5].style.color='black';
                options[5].style.fontSize='20px';
                wrong[5].hidden=true;
                pass1();
                console.log('passOne');}
        if(pvalfail==2){
                pass2();
                console.log('passTwo');
        }
        if(pvalfail==3){
                options[5].style.border='1px solid white';
                options[5].style.backgroundColor='white';
                options[5].style.color='black';
                options[5].style.fontSize='20px';
                wrong[5].hidden=true;
                pvalfail=2;
                pass3();
                console.log('passThree');
    }}
    function pass(){
        if(x<lenques){
        x=rightx;
        pvalfail=0;
        for(s=0;s<6;s++){
        options[s].style.fontSize='18px';
        options[s].style.color='black';
        options[s].style.border='1px solid yellow';
        options[s].style.backgroundColor='white';
        right[s].hidden=true;
        wrong[s].hidden=true;
        Pass.innerHTML='----';
        if(pval==1){
            secondchangeNext();
            pval=0;
        }
        }
        rightans=rightx%4;
        if(rightans==0){
                playerjs=player[0][1].player1;
            }
            if(rightans==1){
                playerjs=player[0][1].player2;
            }
            if(rightans==2){
                playerjs=player[0][1].player3;
            }
            if(rightans==3){
                playerjs=player[0][1].player4;
            }
        // start();
        // stop();
        question_number.innerHTML=question[x][1].question_number;
        question_text.innerHTML=question[x][1].question_text;
        round.innerHTML=question[x][1].round;
         if(question[rightx][1].round!=question[rightx-1][1].round){
            roundRules.hidden=false;
            quizPart.hidden=true;
            bigRound.innerHTML=question[x][1].round;
         }
        xforchoice=x+1;
        for(let a=0;a<=lengthchoice;a++){
        if(parseInt(choice[a][1].question_number)==xforchoice){
            c=c+1;
            if(c==1){
                optionA.innerHTML=choice[a][1].choice;
                checkcorrect[0]=choice[a][1].correct;
            }
            if(c==2){
                optionB.innerHTML=choice[a][1].choice;
                checkcorrect[1]=choice[a][1].correct;
            }
            if(c==3){
                optionC.innerHTML=choice[a][1].choice;
                checkcorrect[2]=choice[a][1].correct;
            }
            if(c==4){
                optionD.innerHTML=choice[a][1].choice;
                checkcorrect[3]=choice[a][1].correct;
            }
            if(c==5){
                optionE.innerHTML=choice[a][1].choice;
                checkcorrect[4]=choice[a][1].correct;
            }
            if(c==6){
                optionF.innerHTML=choice[a][1].choice;
                checkcorrect[5]=choice[a][1].correct;
            }

        }
        else{
            c=0;
        }
    }
}
else{
    quizPart.hidden=true;
    allresult.hidden=false;
    if(player1marks>player2marks||player1marks>player3marks||player1marks>player4marks){
        leader[0].innerHTML=`${player[0][1].player1}:${player1marks}`;
        if(player2marks>player3marks||player2marks>player4marks){
            leader[1].innerHTML=`${player[0][1].player2}:${player2marks}`;
            if(player3marks>player4marks){
            leader[2].innerHTML=`${player[0][1].player3}:${player3marks}`;
            leader[3].innerHTML=`${player[0][1].player4}:${player4marks}`;
            } 
            if(player4marks>player3marks){
            leader[2].innerHTML=`${player[0][1].player4}:${player4marks}`;
            leader[3].innerHTML=`${player[0][1].player3}:${player3marks}`;
            } 
        }
        if(player3marks>player2marks||player3marks>player4marks){
            leader[1].innerHTML=`${player[0][1].player3}:${player3marks}`;
            if(player2marks>player4marks){
            leader[2].innerHTML=`${player[0][1].player2}:${player2marks}`;
            leader[3].innerHTML=`${player[0][1].player4}:${player4marks}`;
            } 
            if(player4marks>player2marks){
            leader[2].innerHTML=`${player[0][1].player4}:${player4marks}`;
            leader[3].innerHTML=`${player[0][1].player2}:${player2marks}`;
            } 
        }
        if(player4marks>player2marks||player4marks>player3marks){
            leader[1].innerHTML=`${player[0][1].player4}:${player4marks}`;
            if(player2marks>player3marks){
            leader[2].innerHTML=`${player[0][1].player2}:${player2marks}`;
            leader[3].innerHTML=`${player[0][1].player3}:${player3marks}`;
            } 
            if(player3marks>player2marks){
            leader[2].innerHTML=`${player[0][1].player3}:${player3marks}`;
            leader[3].innerHTML=`${player[0][1].player2}:${player2marks}`;
            } 
        }
    }
    //next check
    //yeha euta 1st player vanda 3rd player sano huda eutas error xa ra first player>4player
    if(player2marks>player1marks||player2marks>player3marks||player2marks>player4marks){
        leader[0].innerHTML=`${player[0][1].player2}:${player2marks}`;
        if(player1marks>player3marks||player1marks>player4marks){
            leader[1].innerHTML=`${player[0][1].player1}:${player1marks}`;
            if(player3marks>player4marks){
            leader[2].innerHTML=`${player[0][1].player3}:${player3marks}`;
            leader[3].innerHTML=`${player[0][1].player4}:${player4marks}`;
            } 
            if(player4marks>player3marks){
            leader[2].innerHTML=`${player[0][1].player4}:${player4marks}`;
            leader[3].innerHTML=`${player[0][1].player3}:${player3marks}`;
            } 
        }
        if(player3marks>player1marks||player3marks>player4marks){
            leader[1].innerHTML=`${player[0][1].player3}:${player3marks}`;
            if(player1marks>player4marks){
            leader[2].innerHTML=`${player[0][1].player1}:${player1marks}`;
            leader[3].innerHTML=`${player[0][1].player4}:${player4marks}`;
            } 
            if(player4marks>player1marks){
            leader[2].innerHTML=`${player[0][1].player4}:${player4marks}`;
            leader[3].innerHTML=`${player[0][1].player1}:${player1marks}`;
            } 
        }
        if(player4marks>player1marks||player4marks>player3marks){
            leader[1].innerHTML=`${player[0][1].player4}:${player4marks}`;
            if(player1marks>player3marks){
            leader[2].innerHTML=`${player[0][1].player1}:${player1marks}`;
            leader[3].innerHTML=`${player[0][1].player3}:${player3marks}`;
            } 
            if(player3marks>player1marks){
            leader[2].innerHTML=`${player[0][1].player3}:${player3marks}`;
            leader[3].innerHTML=`${player[0][1].player1}:${player1marks}`;
            } 
        }
    }
    if(player3marks>player1marks||player3marks>player2marks||player3marks>player4marks){
        leader[0].innerHTML=`${player[0][1].player3}:${player3marks}`;
        if(player2marks>player1marks||player2marks>player4marks){
            leader[1].innerHTML=`${player[0][1].player2}:${player2marks}`;
            if(player1marks>=player4marks){
            leader[2].innerHTML=`${player[0][1].player1}:${player1marks}`;
            leader[3].innerHTML=`${player[0][1].player4}:${player4marks}`;
            } 
            if(player4marks>player1marks){
            leader[2].innerHTML=`${player[0][1].player4}:${player4marks}`;
            leader[3].innerHTML=`${player[0][1].player1}:${player1marks}`;
            } 
        }
        if(player1marks>player2marks||player1marks>player4marks){
            leader[1].innerHTML=`${player[0][1].player1}:${player1marks}`;
            if(player2marks>player4marks){
            leader[2].innerHTML=`${player[0][1].player2}:${player2marks}`;
            leader[3].innerHTML=`${player[0][1].player4}:${player4marks}`;
            } 
            if(player4marks>player2marks){
            leader[2].innerHTML=`${player[0][1].player4}:${player4marks}`;
            leader[3].innerHTML=`${player[0][1].player2}:${player2marks}`;
            } 
        }
        if(player4marks>player2marks||player4marks>player1marks){
            leader[1].innerHTML=`${player[0][1].player4}:${player4marks}`;
            if(player2marks>player1marks){
            leader[2].innerHTML=`${player[0][1].player2}:${player2marks}`;
            leader[3].innerHTML=`${player[0][1].player1}:${player1marks}`;
            } 
            if(player1marks>player2marks){
            leader[2].innerHTML=`${player[0][1].player1}:${player1marks}`;
            leader[3].innerHTML=`${player[0][1].player2}:${player2marks}`;
            } 
        }
    }
    if(player4marks>player2marks||player4marks>player3marks||player4marks>player1marks){
        leader[0].innerHTML=`${player[0][1].player4}:${player4marks}`;
        if(player2marks>player3marks||player2marks>player1marks){
            leader[1].innerHTML=`${player[0][1].player2}:${player2marks}`;
            if(player3marks>player1marks){
            leader[2].innerHTML=`${player[0][1].player3}:${player3marks}`;
            leader[3].innerHTML=`${player[0][1].player1}:${player1marks}`;
            } 
            if(player1marks>player3marks){
            leader[2].innerHTML=`${player[0][1].player1}:${player1marks}`;
            leader[3].innerHTML=`${player[0][1].player3}:${player3marks}`;
            } 
        }
        if(player3marks>player2marks||player3marks>player1marks){
            leader[1].innerHTML=`${player[0][1].player3}:${player3marks}`;
            if(player2marks>player1marks){
            leader[2].innerHTML=`${player[0][1].player2}:${player2marks}`;
            leader[3].innerHTML=`${player[0][1].player1}:${player1marks}`;
            } 
            if(player1marks>player2marks){
            leader[2].innerHTML=`${player[0][1].player1}:${player1marks}`;
            leader[3].innerHTML=`${player[0][1].player2}:${player2marks}`;
            } 
        }
        if(player1marks>player2marks||player1marks>player3marks){
            leader[1].innerHTML=`${player[0][1].player1}:${player1marks}`;
            if(player2marks>player3marks){
            leader[2].innerHTML=`${player[0][1].player2}:${player2marks}`;
            leader[3].innerHTML=`${player[0][1].player3}:${player3marks}`;
            } 
            if(player3marks>player2marks){
            leader[2].innerHTML=`${player[0][1].player3}:${player3marks}`;
            leader[3].innerHTML=`${player[0][1].player2}:${player2marks}`;
            } 
        }
    }

}
}
    function startRound(){
        roundRules.hidden=true;
        quizPart.hidden=false;
        secondchangeNext();
    }
function abaft(){
        if(x>0){
            x=x-1;
            question_text.innerHTML=question[x][1].question_text;
            question_number.innerHTML=question[x][1].question_number;
            round.innerHTML=question[x][1].round;
            xforchoice=x+1;
            if(question[x][1].round!=question[x+1][1].round){
            roundRules.hidden=false;
            quizPart.hidden=true;
            bigRound.innerHTML=question[x+1][1].round;
        }
        for(let a=0;a<=lengthchoice;a++){
        if(choice[a][1].question_number==xforchoice){
            c=c+1;
            if(c==1){
                optionA.innerHTML=choice[a][1].choice;
                checkcorrect[0]=choice[a][1].correct;
            }
            if(c==2){
                optionB.innerHTML=choice[a][1].choice;
                checkcorrect[1]=choice[a][1].correct;
            }
            if(c==3){
                optionC.innerHTML=choice[a][1].choice;
                checkcorrect[2]=choice[a][1].correct;
            }
            if(c==4){
                optionD.innerHTML=choice[a][1].choice;
                checkcorrect[3]=choice[a][1].correct;

            }
            if(c==5){
                optionE.innerHTML=choice[a][1].choice;
                checkcorrect[4]=choice[a][1].correct;
            }
            if(c==6){
                optionf.innerHTML=choice[a][1].choice;
                checkcorrect[5]=choice[a][1].correct;
            }

        }
        else{
            c=0;
        }
        }
    }}
    function checkA(){
        datafromweb[0]="1";
        datafromweb[1]="0";
        datafromweb[2]="0";
        datafromweb[3]="0";
        datafromweb[4]="0";
        datafromweb[5]="0";
        let y=0;
        for(z=0;z<4;z++){
            if(datafromweb[z]==checkcorrect[z]){
                y=y+1;
        }}
        if(y==4){
            rightx=rightx+1;
            options[0].style.border='1px solid limegreen';
            options[0].style.color='white';
            options[0].style.fontSize='20px';
            options[0].style.backgroundColor='limegreen';
            right[0].hidden=false;
            Pass.innerHTML='Next &#8594';
            right[0].style.fontSize='25px';
            pval++;
            rightans=rightx%4;
            if(pvalfail==0){
            if(rightans==1){
                player1marks=player1marks+parseInt(player[0][1].marks);
                marking[0].innerHTML=player1marks;
            }
            if(rightans==2){
                player2marks=player2marks+parseInt(player[0][1].marks);
                marking[1].innerHTML=player2marks;
            }
            if(rightans==3){
                player3marks=player3marks+parseInt(player[0][1].marks);
                marking[2].innerHTML=player3marks;
            }
            if(rightans==0){
                player4marks=player4marks+parseInt(player[0][1].marks);
                marking[3].innerHTML=player4marks;
            }
        }
        if(pvalfail==1){
            if(rightans==1){
                player2marks=player2marks+parseInt(player[0][1].pm);
                marking[1].innerHTML=player2marks;
            }
            if(rightans==2){
                player3marks=player3marks+parseInt(player[0][1].pm);
                marking[2].innerHTML=player3marks;
            }
            if(rightans==3){
                player4marks=player4marks+parseInt(player[0][1].pm);
                marking[3].innerHTML=player4marks;
            }
            if(rightans==0){
                player1marks=player1marks+parseInt(player[0][1].pm);
                marking[0].innerHTML=player1marks;
            }
        }
        if(pvalfail==2){
            if(rightans==1){
                player3marks=player3marks+parseInt(player[0][1].pm);
                marking[2].innerHTML=player3marks;
            }
            if(rightans==2){
                player4marks=player4marks+parseInt(player[0][1].pm);
                marking[3].innerHTML=player4marks;
            }
            if(rightans==3){
                player1marks=player1marks+parseInt(player[0][1].pm);
                marking[0].innerHTML=player1marks;
            }
            if(rightans==0){
                player2marks=player2marks+parseInt(player[0][1].pm);
                marking[1].innerHTML=player2marks;
            }
        }
        if(pvalfail==3){
            if(rightans==1){
                player4marks=player4marks+parseInt(player[0][1].pm);
                marking[3].innerHTML=player4marks;
            }
            if(rightans==2){
                player1marks=player1marks+parseInt(player[0][1].pm);
                marking[0].innerHTML=player1marks;
            }
            if(rightans==3){
                player2marks=player2marks+parseInt(player[0][1].pm);
                marking[1].innerHTML=player2marks;
            }
            if(rightans==0){
                player3marks=player3marks+parseInt(player[0][1].pm);
                marking[2].innerHTML=player3marks;
            }
        }
        pvalfail=0;
        start();
        stop();
        }
        else{
            options[0].style.border='1px solid red';
            options[0].style.color='white';
            options[0].style.fontSize='20px';
            options[0].style.backgroundColor='red';
            wrong[0].hidden=false;
            wrong[0].style.fontSize='25px';
            pval=0;
            pvalfail=pvalfail+1;
            rightans=rightx%4;
            sa=pvalfail%4;
            if(rightans==0){
            if(sa==0){
                setTimeout(() => {
                    playerjs=player[0][1].player1;
                }, 1500);
            }
            if(sa==1){
                setTimeout(() => {
                    playerjs=player[0][1].player2;

                }, 1500);
            }
            if(sa==2){
                setTimeout(() => {
                    playerjs=player[0][1].player3;
                }, 1500);
            }
            if(sa==3){
                setTimeout(() => {
                    playerjs=player[0][1].player4;
                }, 1500);
            }}
            if(rightans==1){
            if(sa==0){
                setTimeout(() => {
                    playerjs=player[0][1].player2;
                }, 1500);
            }
            if(sa==1){
                setTimeout(() => {
                    playerjs=player[0][1].player3;

                }, 1500);
            }
            if(sa==2){
                setTimeout(() => {
                    playerjs=player[0][1].player4;
                }, 1500);
            }
            if(sa==3){
                setTimeout(() => {
                    playerjs=player[0][1].player1;
                }, 1500);
            }}
            if(rightans==2){
            if(sa==0){
                setTimeout(() => {
                    playerjs=player[0][1].player3;
                }, 1500);
            }
            if(sa==1){
                setTimeout(() => {
                    playerjs=player[0][1].player4;

                }, 1500);
            }
            if(sa==2){
                setTimeout(() => {
                    playerjs=player[0][1].player1;
                }, 1500);
            }
            if(sa==3){
                setTimeout(() => {
                    playerjs=player[0][1].player2;
                }, 1500);
            }}
            if(rightans==3){
            if(sa==0){
                setTimeout(() => {
                    playerjs=player[0][1].player4;
                }, 1500);
            }
            if(sa==1){
                setTimeout(() => {
                    playerjs=player[0][1].player1;

                }, 1500);
            }
            if(sa==2){
                setTimeout(() => {
                    playerjs=player[0][1].player2;
                }, 1500);
            }
            if(sa==3){
                setTimeout(() => {
                    playerjs=player[0][1].player3;
                }, 1500);
            }}
            if(pvalfail==1){
            setTimeout(() => {
                options[0].style.border='1px solid white';
                options[0].style.backgroundColor='white';
                options[0].style.color='black';
                options[0].style.fontSize='20px';
                wrong[0].hidden=true;
                pass1();
                console.log('passOne');
            }, 1500);}

        }
        if(pvalfail==2){
            setTimeout(() => {
                options[0].style.border='1px solid white';
                options[0].style.backgroundColor='white';
                options[0].style.color='black';
                options[0].style.fontSize='20px';
                wrong[0].hidden=true;
                pass2();
                console.log('passTwo');
            }, 1500);
        }
        if(pvalfail==3){
            setTimeout(() => {
                options[0].style.border='1px solid white';
                options[0].style.backgroundColor='white';
                options[0].style.color='black';
                options[0].style.fontSize='20px';
                wrong[0].hidden=true;
                pvalfail=2;
                pass3();
                console.log('passThree');
            }, 1500);
        }
    }
    function checkB(){
        datafromweb[0]="0";
        datafromweb[1]="1";
        datafromweb[2]="0";
        datafromweb[3]="0";
        datafromweb[4]="0";
        datafromweb[5]="0";
        let y=0;
        for(z=0;z<4;z++){
            if(datafromweb[z]==checkcorrect[z]){
                y=y+1;
        }}
        if(y==4){
            rightx=rightx+1;
            options[1].style.border='1px solid limegreen';
            options[1].style.color='white';
            Pass.innerHTML='Next &#8594';
            options[1].style.backgroundColor='limegreen';
            options[1].style.fontSize='20px';
            right[1].hidden=false;
            right[1].style.fontSize='25px';            pval++;
            rightans=rightx%4;
           /* if(rightans==1){
                player1marks=player1marks+parseInt(player[0][1].marks);
                marking[0].innerHTML=player1marks;
                // console.log()
            }
            if(rightans==2){
                player2marks=player2marks+parseInt(player[0][1].marks);
                marking[1].innerHTML=player2marks;
            }
            if(rightans==3){
                player3marks=player3marks+parseInt(player[0][1].marks);
                marking[2].innerHTML=player3marks;
            }
            if(rightans==0){
                player4marks=player4marks+parseInt(player[0][1].marks);
                marking[3].innerHTML=player4marks;
            }*/
            if(pvalfail==0){
            if(rightans==1){
                player1marks=player1marks+parseInt(player[0][1].marks);
                marking[0].innerHTML=player1marks;
                console.log(player1marks);
            }
            if(rightans==2){
                player2marks=player2marks+parseInt(player[0][1].marks);
                marking[1].innerHTML=player2marks;
            }
            if(rightans==3){
                player3marks=player3marks+parseInt(player[0][1].marks);
                marking[2].innerHTML=player3marks;
            }
            if(rightans==0){
                player4marks=player4marks+parseInt(player[0][1].marks);
                marking[3].innerHTML=player4marks;
            }
        }
        if(pvalfail==1){
            if(rightans==1){
                player2marks=player2marks+parseInt(player[0][1].pm);
                marking[1].innerHTML=player2marks;
            }
            if(rightans==2){
                player3marks=player3marks+parseInt(player[0][1].pm);
                marking[2].innerHTML=player3marks;
            }
            if(rightans==3){
                player4marks=player4marks+parseInt(player[0][1].pm);
                marking[3].innerHTML=player4marks;
            }
            if(rightans==0){
                player1marks=player1marks+parseInt(player[0][1].pm);
                marking[0].innerHTML=player1marks;
            }
        }
        if(pvalfail==2){
            if(rightans==1){
                player3marks=player3marks+parseInt(player[0][1].pm);
                marking[2].innerHTML=player3marks;
            }
            if(rightans==2){
                player4marks=player4marks+parseInt(player[0][1].pm);
                marking[3].innerHTML=player4marks;
            }
            if(rightans==3){
                player1marks=player1marks+parseInt(player[0][1].pm);
                marking[0].innerHTML=player1marks;
            }
            if(rightans==0){
                player2marks=player2marks+parseInt(player[0][1].pm);
                marking[1].innerHTML=player2marks;
            }
        }
        if(pvalfail==3){
            if(rightans==1){
                player4marks=player4marks+parseInt(player[0][1].pm);
                marking[3].innerHTML=player4marks;
            }
            if(rightans==2){
                player1marks=player1marks+parseInt(player[0][1].pm);
                marking[0].innerHTML=player1marks;
            }
            if(rightans==3){
                player2marks=player2marks+parseInt(player[0][1].pm);
                marking[1].innerHTML=player2marks;
            }
            if(rightans==0){
                player3marks=player3marks+parseInt(player[0][1].pm);
                marking[2].innerHTML=player3marks;
            }
        }

        

        pvalfail=0;

        start();
        stop();
        }
        else{
            options[1].style.border='1px solid red';
            options[1].style.color='white';
            options[1].style.fontSize='20px';
            wrong[1].hidden=false;
            options[1].style.backgroundColor='red';
            wrong[1].style.fontSize='25px';
            pval=0;
            pvalfail=pvalfail+1;
            sa=pvalfail%4;
            rightans=rightx%4;
            /*if(sa==0){
                setTimeout(() => {
                    playerjs=player[0][1].player1;
                }, 1500);
            }
            if(sa==1){
                setTimeout(() => {
                    playerjs=player[0][1].player2;

                }, 1500);
            }
            if(sa==2){
                setTimeout(() => {
                    playerjs=player[0][1].player3;
                }, 1500);
            }
            if(sa==3){
                setTimeout(() => {
                    playerjs=player[0][1].player4;
                }, 1500);
            }*/
            if(rightans==0){
            if(sa==0){
                setTimeout(() => {
                    playerjs=player[0][1].player1;
                }, 1500);
            }
            if(sa==1){
                setTimeout(() => {
                    playerjs=player[0][1].player2;

                }, 1500);
            }
            if(sa==2){
                setTimeout(() => {
                    playerjs=player[0][1].player3;
                }, 1500);
            }
            if(sa==3){
                setTimeout(() => {
                    playerjs=player[0][1].player4;
                }, 1500);
            }}
            if(rightans==1){
            if(sa==0){
                setTimeout(() => {
                    playerjs=player[0][1].player2;
                }, 1500);
            }
            if(sa==1){
                setTimeout(() => {
                    playerjs=player[0][1].player3;

                }, 1500);
            }
            if(sa==2){
                setTimeout(() => {
                    playerjs=player[0][1].player4;
                }, 1500);
            }
            if(sa==3){
                setTimeout(() => {
                    playerjs=player[0][1].player1;
                }, 1500);
            }}
            if(rightans==2){
            if(sa==0){
                setTimeout(() => {
                    playerjs=player[0][1].player3;
                }, 1500);
            }
            if(sa==1){
                setTimeout(() => {
                    playerjs=player[0][1].player4;

                }, 1500);
            }
            if(sa==2){
                setTimeout(() => {
                    playerjs=player[0][1].player1;
                }, 1500);
            }
            if(sa==3){
                setTimeout(() => {
                    playerjs=player[0][1].player2;
                }, 1500);
            }}
            if(rightans==3){
            if(sa==0){
                setTimeout(() => {
                    playerjs=player[0][1].player4;
                }, 1500);
            }
            if(sa==1){
                setTimeout(() => {
                    playerjs=player[0][1].player1;

                }, 1500);
            }
            if(sa==2){
                setTimeout(() => {
                    playerjs=player[0][1].player2;
                }, 1500);
            }
            if(sa==3){
                setTimeout(() => {
                    playerjs=player[0][1].player3;
                }, 1500);
            }}
            if(pvalfail==1){
            setTimeout(() => {
                options[1].style.border='1px solid white';
                options[1].style.backgroundColor='white';
                options[1].style.color='black';
                options[1].style.fontSize='20px';
                wrong[1].hidden=true;
                pass1();
                console.log('passOne');
            }, 1500);}

        }
        if(pvalfail==2){
            setTimeout(() => {
                options[1].style.border='1px solid white';
                options[1].style.backgroundColor='white';
                options[1].style.color='black';
                options[1].style.fontSize='20px';
                wrong[1].hidden=true;
                pass2();
                console.log('passTwo');
            }, 1500);
        }
        if(pvalfail==3){
            setTimeout(() => {
                options[1].style.border='1px solid white';
                options[1].style.backgroundColor='white';
                options[1].style.color='black';
                options[1].style.fontSize='20px';
                wrong[1].hidden=true;
                pass3();
                console.log('passThree');
            }, 1500);
        }
    }
    
    function checkC(){
        datafromweb[0]="0";
        datafromweb[1]="0";
        datafromweb[2]="1";
        datafromweb[3]="0";
        datafromweb[4]="0";
        datafromweb[5]="0";
        let y=0;
        for(z=0;z<4;z++){
            if(datafromweb[z]==checkcorrect[z]){
                y=y+1;
        }}
        if(y==4){
            rightx=rightx+1;
            options[2].style.border='1px solid limegreen';
            options[2].style.color='white';
            Pass.innerHTML='Next &#8594';
            options[2].style.fontSize='20px';
            options[2].style.backgroundColor='limegreen';
            right[2].hidden=false;
            right[2].style.fontSize='25px';            pval++;            
            rightans=rightx%4;
            if(pvalfail==0){
            if(rightans==1){
                player1marks=player1marks+parseInt(player[0][1].marks);
                marking[0].innerHTML=player1marks;
                console.log(player1marks);
            }
            if(rightans==2){
                player2marks=player2marks+parseInt(player[0][1].marks);
                marking[1].innerHTML=player2marks;
            }
            if(rightans==3){
                player3marks=player3marks+parseInt(player[0][1].marks);
                marking[2].innerHTML=player3marks;
            }
            if(rightans==0){
                player4marks=player4marks+parseInt(player[0][1].marks);
                marking[3].innerHTML=player4marks;
            }
        }
        if(pvalfail==1){
            if(rightans==1){
                player2marks=player2marks+parseInt(player[0][1].pm);
                marking[1].innerHTML=player2marks;
            }
            if(rightans==2){
                player3marks=player3marks+parseInt(player[0][1].pm);
                marking[2].innerHTML=player3marks;
            }
            if(rightans==3){
                player4marks=player4marks+parseInt(player[0][1].pm);
                marking[3].innerHTML=player4marks;
            }
            if(rightans==0){
                player1marks=player1marks+parseInt(player[0][1].pm);
                marking[0].innerHTML=player1marks;
            }
        }
        if(pvalfail==2){
            if(rightans==1){
                player3marks=player3marks+parseInt(player[0][1].pm);
                marking[2].innerHTML=player3marks;
            }
            if(rightans==2){
                player4marks=player4marks+parseInt(player[0][1].pm);
                marking[3].innerHTML=player4marks;
            }
            if(rightans==3){
                player1marks=player1marks+parseInt(player[0][1].pm);
                marking[0].innerHTML=player1marks;
            }
            if(rightans==0){
                player2marks=player2marks+parseInt(player[0][1].pm);
                marking[1].innerHTML=player2marks;
            }
        }
        if(pvalfail==3){
            if(rightans==1){
                player4marks=player4marks+parseInt(player[0][1].pm);
                marking[3].innerHTML=player4marks;
            }
            if(rightans==2){
                player1marks=player1marks+parseInt(player[0][1].pm);
                marking[0].innerHTML=player1marks;
            }
            if(rightans==3){
                player2marks=player2marks+parseInt(player[0][1].pm);
                marking[1].innerHTML=player2marks;
            }
            if(rightans==0){
                player3marks=player3marks+parseInt(player[0][1].pm);
                marking[2].innerHTML=player3marks;
            }
        }

        pvalfail=0;
        start();
        stop();
        }
        else{
            options[2].style.border='1px solid red';
            options[2].style.color='white';
            options[2].style.fontSize='20px';
            wrong[2].hidden=false;
            wrong[2].style.fontSize='25px';
            options[2].style.backgroundColor='red';
            pval=0;
            pvalfail=pvalfail+1;
            sa=pvalfail%4;            rightans=rightx%4;

            if(rightans==0){
            if(sa==0){
                setTimeout(() => {
                    playerjs=player[0][1].player1;
                }, 1500);
            }
            if(sa==1){
                setTimeout(() => {
                    playerjs=player[0][1].player2;

                }, 1500);
            }
            if(sa==2){
                setTimeout(() => {
                    playerjs=player[0][1].player3;
                }, 1500);
            }
            if(sa==3){
                setTimeout(() => {
                    playerjs=player[0][1].player4;
                }, 1500);
            }}
            if(rightans==1){
            if(sa==0){
                setTimeout(() => {
                    playerjs=player[0][1].player2;
                }, 1500);
            }
            if(sa==1){
                setTimeout(() => {
                    playerjs=player[0][1].player3;

                }, 1500);
            }
            if(sa==2){
                setTimeout(() => {
                    playerjs=player[0][1].player4;
                }, 1500);
            }
            if(sa==3){
                setTimeout(() => {
                    playerjs=player[0][1].player1;
                }, 1500);
            }}
            if(rightans==2){
            if(sa==0){
                setTimeout(() => {
                    playerjs=player[0][1].player3;
                }, 1500);
            }
            if(sa==1){
                setTimeout(() => {
                    playerjs=player[0][1].player4;

                }, 1500);
            }
            if(sa==2){
                setTimeout(() => {
                    playerjs=player[0][1].player1;
                }, 1500);
            }
            if(sa==3){
                setTimeout(() => {
                    playerjs=player[0][1].player2;
                }, 1500);
            }}
            if(rightans==3){
            if(sa==0){
                setTimeout(() => {
                    playerjs=player[0][1].player4;
                }, 1500);
            }
            if(sa==1){
                setTimeout(() => {
                    playerjs=player[0][1].player1;

                }, 1500);
            }
            if(sa==2){
                setTimeout(() => {
                    playerjs=player[0][1].player2;
                }, 1500);
            }
            if(sa==3){
                setTimeout(() => {
                    playerjs=player[0][1].player3;
                }, 1500);
            }}
            if(pvalfail==1){
            setTimeout(() => {
                options[2].style.border='1px solid white';
                options[2].style.backgroundColor='white';
                options[2].style.color='black';
                options[2].style.fontSize='20px';
                wrong[2].hidden=true;
                pass1();
                console.log('passOne');
            }, 1500);}

        }
        if(pvalfail==2){
            setTimeout(() => {
                options[2].style.border='1px solid white';
                options[2].style.backgroundColor='white';
                options[2].style.color='black';
                options[2].style.fontSize='20px';
                wrong[2].hidden=true;
                pass2();
                console.log('passTwo');
            }, 1500);
        }
        if(pvalfail==3){
            setTimeout(() => {
                options[2].style.border='1px solid white';
                options[2].style.backgroundColor='white';
                options[2].style.color='black';
                options[2].style.fontSize='20px';
                wrong[2].hidden=true;
                pass3();
                console.log('passThree');
            }, 1500);
        }
}
    function checkD(){
        datafromweb[0]="0";
        datafromweb[1]="0";
        datafromweb[2]="0";
        datafromweb[3]="1";
        datafromweb[4]="0";
        datafromweb[5]="0";
        let y=0;
        for(z=0;z<4;z++){
            if(datafromweb[z]==checkcorrect[z]){
                y=y+1;
        }}
        if(y==4){
            rightx=rightx+1;
            options[3].style.border='1px solid limegreen';
            options[3].style.color='white';
            options[3].style.fontSize='20px';
            Pass.innerHTML='Next &#8594';
            options[3].style.backgroundColor='limegreen';
            right[3].hidden=false;
            right[3].style.fontSize='25px';            pval++;            
            rightans=rightx%4;
            if(pvalfail==0){
            if(rightans==1){
                player1marks=player1marks+parseInt(player[0][1].marks);
                marking[0].innerHTML=player1marks;
                console.log(player1marks);
            }
            if(rightans==2){
                player2marks=player2marks+parseInt(player[0][1].marks);
                marking[1].innerHTML=player2marks;
            }
            if(rightans==3){
                player3marks=player3marks+parseInt(player[0][1].marks);
                marking[2].innerHTML=player3marks;
            }
            if(rightans==0){
                player4marks=player4marks+parseInt(player[0][1].marks);
                marking[3].innerHTML=player4marks;
            }
        }
        if(pvalfail==1){
            if(rightans==1){
                player2marks=player2marks+parseInt(player[0][1].pm);
                marking[1].innerHTML=player2marks;
            }
            if(rightans==2){
                player3marks=player3marks+parseInt(player[0][1].pm);
                marking[2].innerHTML=player3marks;
            }
            if(rightans==3){
                player4marks=player4marks+parseInt(player[0][1].pm);
                marking[3].innerHTML=player4marks;
            }
            if(rightans==0){
                player1marks=player1marks+parseInt(player[0][1].pm);
                marking[0].innerHTML=player1marks;
            }
        }
        if(pvalfail==2){
            if(rightans==1){
                player3marks=player3marks+parseInt(player[0][1].pm);
                marking[2].innerHTML=player3marks;
            }
            if(rightans==2){
                player4marks=player4marks+parseInt(player[0][1].pm);
                marking[3].innerHTML=player4marks;
            }
            if(rightans==3){
                player1marks=player1marks+parseInt(player[0][1].pm);
                marking[0].innerHTML=player1marks;
            }
            if(rightans==0){
                player2marks=player2marks+parseInt(player[0][1].pm);
                marking[1].innerHTML=player2marks;
            }
        }
        if(pvalfail==3){
            if(rightans==1){
                player4marks=player4marks+parseInt(player[0][1].pm);
                marking[3].innerHTML=player4marks;
            }
            if(rightans==2){
                player1marks=player1marks+parseInt(player[0][1].pm);
                marking[0].innerHTML=player1marks;
            }
            if(rightans==3){
                player2marks=player2marks+parseInt(player[0][1].pm);
                marking[1].innerHTML=player2marks;
            }
            if(rightans==0){
                player3marks=player3marks+parseInt(player[0][1].pm);
                marking[2].innerHTML=player3marks;
            }
        }

            pvalfail=0;
        start();
        stop();
        }
        else{
            options[3].style.border='1px solid red';
            options[3].style.color='white';
            options[3].style.fontSize='20px';
            options[3].style.backgroundColor='red';
            wrong[3].hidden=false;
            wrong[3].style.fontSize='25px';
            pval=0;
            pvalfail=pvalfail+1;
            sa=pvalfail%4;            rightans=rightx%4;

            /*if(sa==0){
                setTimeout(() => {
                    playerjs=player[0][1].player1;
                }, 1500);
            }
            if(sa==1){
                setTimeout(() => {
                    playerjs=player[0][1].player2;

                }, 1500);
            }
            if(sa==2){
                setTimeout(() => {
                    playerjs=player[0][1].player3;
                }, 1500);
            }
            if(sa==3){
                setTimeout(() => {
                    playerjs=player[0][1].player4;
                }, 1500);
            }*
            */
            if(rightans==0){
            if(sa==0){
                setTimeout(() => {
                    playerjs=player[0][1].player1;
                }, 1500);
            }
            if(sa==1){
                setTimeout(() => {
                    playerjs=player[0][1].player2;

                }, 1500);
            }
            if(sa==2){
                setTimeout(() => {
                    playerjs=player[0][1].player3;
                }, 1500);
            }
            if(sa==3){
                setTimeout(() => {
                    playerjs=player[0][1].player4;
                }, 1500);
            }}
            if(rightans==1){
            if(sa==0){
                setTimeout(() => {
                    playerjs=player[0][1].player2;
                }, 1500);
            }
            if(sa==1){
                setTimeout(() => {
                    playerjs=player[0][1].player3;

                }, 1500);
            }
            if(sa==2){
                setTimeout(() => {
                    playerjs=player[0][1].player4;
                }, 1500);
            }
            if(sa==3){
                setTimeout(() => {
                    playerjs=player[0][1].player1;
                }, 1500);
            }}
            if(rightans==2){
            if(sa==0){
                setTimeout(() => {
                    playerjs=player[0][1].player3;
                }, 1500);
            }
            if(sa==1){
                setTimeout(() => {
                    playerjs=player[0][1].player4;

                }, 1500);
            }
            if(sa==2){
                setTimeout(() => {
                    playerjs=player[0][1].player1;
                }, 1500);
            }
            if(sa==3){
                setTimeout(() => {
                    playerjs=player[0][1].player2;
                }, 1500);
            }}
            if(rightans==3){
            if(sa==0){
                setTimeout(() => {
                    playerjs=player[0][1].player4;
                }, 1500);
            }
            if(sa==1){
                setTimeout(() => {
                    playerjs=player[0][1].player1;

                }, 1500);
            }
            if(sa==2){
                setTimeout(() => {
                    playerjs=player[0][1].player2;
                }, 1500);
            }
            if(sa==3){
                setTimeout(() => {
                    playerjs=player[0][1].player3;
                }, 1500);
            }}
            if(pvalfail==1){
            setTimeout(() => {
                options[3].style.border='1px solid white';
                options[3].style.backgroundColor='white';
                options[3].style.color='black';
                options[3].style.fontSize='20px';
                wrong[3].hidden=true;
                pass1();
                console.log('passOne');
            }, 1500);}

        }
        if(pvalfail==2){
            setTimeout(() => {
                options[3].style.border='1px solid white';
                options[3].style.backgroundColor='white';
                options[3].style.color='black';
                options[3].style.fontSize='20px';
                wrong[3].hidden=true;
                pass2();
                console.log('passTwo');
            }, 1500);
        }
        if(pvalfail==3){
            setTimeout(() => {
                options[3].style.border='1px solid white';
                options[3].style.backgroundColor='white';
                options[3].style.color='black';
                options[3].style.fontSize='20px';
                wrong[3].hidden=true;
                pass3();
                console.log('passThree');
            }, 1500);
        }
    }
    function checkE(){
        datafromweb[0]="0";
        datafromweb[1]="0";
        datafromweb[2]="0";
        datafromweb[3]="0";
        datafromweb[4]="1";
        datafromweb[5]="0";
        let y=0;
        for(z=0;z<6;z++){
            if(datafromweb[z]==checkcorrect[z]){
                y=y+1;
        }}
        if(y==6){
            rightx=rightx+1;
            options[4].style.border='1px solid limegreen';
            options[4].style.color='white';
            options[4].style.fontSize='20px';
            options[4].style.backgroundColor='limegreen';
            right[4].hidden=false;
            Pass.innerHTML='Next &#8594';
            right[4].style.fontSize='25px';
            pval++;
            rightans=rightx%4;
            if(pvalfail==0){
            if(rightans==1){
                player1marks=player1marks+parseInt(player[0][1].marks);
                marking[0].innerHTML=player1marks;
                console.log(player1marks);
            }
            if(rightans==2){
                player2marks=player2marks+parseInt(player[0][1].marks);
                marking[1].innerHTML=player2marks;
            }
            if(rightans==3){
                player3marks=player3marks+parseInt(player[0][1].marks);
                marking[2].innerHTML=player3marks;
            }
            if(rightans==0){
                player4marks=player4marks+parseInt(player[0][1].marks);
                marking[3].innerHTML=player4marks;
            }
        }
        if(pvalfail==1){
            if(rightans==1){
                player2marks=player2marks+parseInt(player[0][1].pm);
                marking[1].innerHTML=player2marks;
            }
            if(rightans==2){
                player3marks=player3marks+parseInt(player[0][1].pm);
                marking[2].innerHTML=player3marks;
            }
            if(rightans==3){
                player4marks=player4marks+parseInt(player[0][1].pm);
                marking[3].innerHTML=player4marks;
            }
            if(rightans==0){
                player1marks=player1marks+parseInt(player[0][1].pm);
                marking[0].innerHTML=player1marks;
            }
        }
        if(pvalfail==2){
            if(rightans==1){
                player3marks=player3marks+parseInt(player[0][1].pm);
                marking[2].innerHTML=player3marks;
            }
            if(rightans==2){
                player4marks=player4marks+parseInt(player[0][1].pm);
                marking[3].innerHTML=player4marks;
            }
            if(rightans==3){
                player1marks=player1marks+parseInt(player[0][1].pm);
                marking[0].innerHTML=player1marks;
            }
            if(rightans==0){
                player2marks=player2marks+parseInt(player[0][1].pm);
                marking[1].innerHTML=player2marks;
            }
        }
        if(pvalfail==3){
            if(rightans==1){
                player4marks=player4marks+parseInt(player[0][1].pm);
                marking[3].innerHTML=player4marks;
            }
            if(rightans==2){
                player1marks=player1marks+parseInt(player[0][1].pm);
                marking[0].innerHTML=player1marks;
            }
            if(rightans==3){
                player2marks=player2marks+parseInt(player[0][1].pm);
                marking[1].innerHTML=player2marks;
            }
            if(rightans==0){
                player3marks=player3marks+parseInt(player[0][1].pm);
                marking[2].innerHTML=player3marks;
            }
        }
        pvalfail=0;
        start();
        stop();
        }
        else{
            options[4].style.border='1px solid red';
            options[4].style.color='white';
            options[4].style.fontSize='20px';
            options[4].style.backgroundColor='red';
            wrong[4].hidden=false;
            wrong[4].style.fontSize='25px';
            pval=0;
            pvalfail=pvalfail+1;
            rightans=rightx%4;

            sa=pvalfail%4;
            if(rightans==0){
            if(sa==0){
                setTimeout(() => {
                    playerjs=player[0][1].player1;
                }, 1500);
            }
            if(sa==1){
                setTimeout(() => {
                    playerjs=player[0][1].player2;

                }, 1500);
            }
            if(sa==2){
                setTimeout(() => {
                    playerjs=player[0][1].player3;
                }, 1500);
            }
            if(sa==3){
                setTimeout(() => {
                    playerjs=player[0][1].player4;
                }, 1500);
            }}
            if(rightans==1){
            if(sa==0){
                setTimeout(() => {
                    playerjs=player[0][1].player2;
                }, 1500);
            }
            if(sa==1){
                setTimeout(() => {
                    playerjs=player[0][1].player3;

                }, 1500);
            }
            if(sa==2){
                setTimeout(() => {
                    playerjs=player[0][1].player4;
                }, 1500);
            }
            if(sa==3){
                setTimeout(() => {
                    playerjs=player[0][1].player1;
                }, 1500);
            }}
            if(rightans==2){
            if(sa==0){
                setTimeout(() => {
                    playerjs=player[0][1].player3;
                }, 1500);
            }
            if(sa==1){
                setTimeout(() => {
                    playerjs=player[0][1].player4;

                }, 1500);
            }
            if(sa==2){
                setTimeout(() => {
                    playerjs=player[0][1].player1;
                }, 1500);
            }
            if(sa==3){
                setTimeout(() => {
                    playerjs=player[0][1].player2;
                }, 1500);
            }}
            if(rightans==3){
            if(sa==0){
                setTimeout(() => {
                    playerjs=player[0][1].player4;
                }, 1500);
            }
            if(sa==1){
                setTimeout(() => {
                    playerjs=player[0][1].player1;

                }, 1500);
            }
            if(sa==2){
                setTimeout(() => {
                    playerjs=player[0][1].player2;
                }, 1500);
            }
            if(sa==3){
                setTimeout(() => {
                    playerjs=player[0][1].player3;
                }, 1500);
            }}
            if(pvalfail==1){
            setTimeout(() => {
                options[4].style.border='1px solid white';
                options[4].style.backgroundColor='white';
                options[4].style.color='black';
                options[4].style.fontSize='20px';
                wrong[4].hidden=true;
                pass1();
                console.log('passOne');
            }, 1500);}

        }
        if(pvalfail==2){
            setTimeout(() => {
                options[4].style.border='1px solid white';
                options[4].style.backgroundColor='white';
                options[4].style.color='black';
                options[4].style.fontSize='20px';
                wrong[4].hidden=true;
                pass2();
                console.log('passTwo');
            }, 1500);
        }
        if(pvalfail==3){
            setTimeout(() => {
                options[4].style.border='1px solid white';
                options[4].style.backgroundColor='white';
                options[4].style.color='black';
                options[4].style.fontSize='20px';
                wrong[4].hidden=true;
                pvalfail=2;
                pass3();
                console.log('passThree');
            }, 1500);
        }
    }
    function checkF(){
        datafromweb[0]="0";
        datafromweb[1]="0";
        datafromweb[2]="0";
        datafromweb[3]="0";
        datafromweb[4]="0";
        datafromweb[5]="1";
        let y=0;
        for(z=0;z<6;z++){
            if(datafromweb[z]==checkcorrect[z]){
                y=y+1;
        }}
        if(y==6){
            rightx=rightx+1;
            options[5].style.border='1px solid limegreen';
            options[5].style.color='white';
            options[5].style.fontSize='20px';
            options[5].style.backgroundColor='limegreen';
            right[5].hidden=false;
            Pass.innerHTML='Next &#8594';
            right[5].style.fontSize='25px';
            pval++;
            rightans=rightx%4;
            if(pvalfail==0){
            if(rightans==1){
                player1marks=player1marks+parseInt(player[0][1].marks);
                marking[0].innerHTML=player1marks;
                console.log(player1marks);
            }
            if(rightans==2){
                player2marks=player2marks+parseInt(player[0][1].marks);
                marking[1].innerHTML=player2marks;
            }
            if(rightans==3){
                player3marks=player3marks+parseInt(player[0][1].marks);
                marking[2].innerHTML=player3marks;
            }
            if(rightans==0){
                player4marks=player4marks+parseInt(player[0][1].marks);
                marking[3].innerHTML=player4marks;
            }
        }
        if(pvalfail==1){
            if(rightans==1){
                player2marks=player2marks+parseInt(player[0][1].pm);
                marking[1].innerHTML=player2marks;
            }
            if(rightans==2){
                player3marks=player3marks+parseInt(player[0][1].pm);
                marking[2].innerHTML=player3marks;
            }
            if(rightans==3){
                player4marks=player4marks+parseInt(player[0][1].pm);
                marking[3].innerHTML=player4marks;
            }
            if(rightans==0){
                player1marks=player1marks+parseInt(player[0][1].pm);
                marking[0].innerHTML=player1marks;
            }
        }
        if(pvalfail==2){
            if(rightans==1){
                player3marks=player3marks+parseInt(player[0][1].pm);
                marking[2].innerHTML=player3marks;
            }
            if(rightans==2){
                player4marks=player4marks+parseInt(player[0][1].pm);
                marking[3].innerHTML=player4marks;
            }
            if(rightans==3){
                player1marks=player1marks+parseInt(player[0][1].pm);
                marking[0].innerHTML=player1marks;
            }
            if(rightans==0){
                player2marks=player2marks+parseInt(player[0][1].pm);
                marking[1].innerHTML=player2marks;
            }
        }
        if(pvalfail==3){
            if(rightans==1){
                player4marks=player4marks+parseInt(player[0][1].pm);
                marking[3].innerHTML=player4marks;
            }
            if(rightans==2){
                player1marks=player1marks+parseInt(player[0][1].pm);
                marking[0].innerHTML=player1marks;
            }
            if(rightans==3){
                player2marks=player2marks+parseInt(player[0][1].pm);
                marking[1].innerHTML=player2marks;
            }
            if(rightans==0){
                player3marks=player3marks+parseInt(player[0][1].pm);
                marking[2].innerHTML=player3marks;
            }
        }
        pvalfail=0;
        start();
        stop();
        }
        else{
            options[5].style.border='1px solid red';
            options[5].style.color='white';
            options[5].style.fontSize='20px';
            options[5].style.backgroundColor='red';
            wrong[5].hidden=false;
            wrong[5].style.fontSize='25px';
            pval=0;
            pvalfail=pvalfail+1;
            rightans=rightx%4;

            sa=pvalfail%4;
            if(rightans==0){
            if(sa==0){
                setTimeout(() => {
                    playerjs=player[0][1].player1;
                }, 1500);
            }
            if(sa==1){
                setTimeout(() => {
                    playerjs=player[0][1].player2;

                }, 1500);
            }
            if(sa==2){
                setTimeout(() => {
                    playerjs=player[0][1].player3;
                }, 1500);
            }
            if(sa==3){
                setTimeout(() => {
                    playerjs=player[0][1].player4;
                }, 1500);
            }}
            if(rightans==1){
            if(sa==0){
                setTimeout(() => {
                    playerjs=player[0][1].player2;
                }, 1500);
            }
            if(sa==1){
                setTimeout(() => {
                    playerjs=player[0][1].player3;

                }, 1500);
            }
            if(sa==2){
                setTimeout(() => {
                    playerjs=player[0][1].player4;
                }, 1500);
            }
            if(sa==3){
                setTimeout(() => {
                    playerjs=player[0][1].player1;
                }, 1500);
            }}
            if(rightans==2){
            if(sa==0){
                setTimeout(() => {
                    playerjs=player[0][1].player3;
                }, 1500);
            }
            if(sa==1){
                setTimeout(() => {
                    playerjs=player[0][1].player4;

                }, 1500);
            }
            if(sa==2){
                setTimeout(() => {
                    playerjs=player[0][1].player1;
                }, 1500);
            }
            if(sa==3){
                setTimeout(() => {
                    playerjs=player[0][1].player2;
                }, 1500);
            }}
            if(rightans==3){
            if(sa==0){
                setTimeout(() => {
                    playerjs=player[0][1].player4;
                }, 1500);
            }
            if(sa==1){
                setTimeout(() => {
                    playerjs=player[0][1].player1;

                }, 1500);
            }
            if(sa==2){
                setTimeout(() => {
                    playerjs=player[0][1].player2;
                }, 1500);
            }
            if(sa==3){
                setTimeout(() => {
                    playerjs=player[0][1].player3;
                }, 1500);
            }}
            if(pvalfail==1){
            setTimeout(() => {
                options[5].style.border='1px solid white';
                options[5].style.backgroundColor='white';
                options[5].style.color='black';
                options[5].style.fontSize='20px';
                wrong[5].hidden=true;
                pass1();
                console.log('passOne');
            }, 1500);}

        }
        if(pvalfail==2){
            setTimeout(() => {
                options[5].style.border='1px solid white';
                options[5].style.backgroundColor='white';
                options[5].style.color='black';
                options[5].style.fontSize='20px';
                wrong[5].hidden=true;
                pass2();
                console.log('passTwo');
            }, 1500);
        }
        if(pvalfail==3){
            setTimeout(() => {
                options[5].style.border='1px solid white';
                options[5].style.backgroundColor='white';
                options[5].style.color='black';
                options[5].style.fontSize='20px';
                wrong[5].hidden=true;
                pvalfail=2;
                pass3();
                console.log('passThree');
            }, 1500);
        }
    }
</script>
</body>
</html>