<?php
@session_start();
if(!isset($_SESSION['id'])){
    $loggedIn = false;
}else{
    $loggedIn = true;
}
if(!isset($_SESSION['gameID'])){
    $_SESSION['gameID'] = 0;
}elseif($_SESSION['gameID'] == 0){
    $gameID = 0;
}else{
    $gameID = $_SESSION['gameID'];
}
?>
<head>
    <meta charset="utf-8">
    <title>Psych Alex</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="css/bootstrap.css" media="screen">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

</head>
<body>
    <div class="navbar navbar-expand-lg fixed-top navbar-light bg-light" style="" id="navBar">
        <div class="container">
            <a href="/quiz/" class="navbar-brand">Psych Alex</a>
            <button class="navbar-toggler collapsed" type="button" id="navbartoggle" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="navbarResponsive" style="">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="themes">Themes <span class="caret"></span></a>
                        <div class="dropdown-menu" aria-labelledby="themes">
                            <a class="dropdown-item" href="/quiz/index.php">Play</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="viewQuestions.php">View All Questions</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <br />
    <div id="navSpacer">
        <br />
        <br />
    </div>
    <div class="container">
        <div class="jumbotron">

            <div id="startPage">
                <h1 class="display-3">Better Psych</h1>
                <p class="lead">Welcome to my own version of psych where the servers actually work!</p>
                <hr class="my-4">
                <p class="lead">
                    <center>
                        <button type="button" id="joinGame" class="btn btn-primary btn-lg btn-block">Join a Game</button>
                        <button type="button" id="startAGame" class="btn btn-primary btn-lg btn-block">Start a Game</button>
                    </center>
                </p>
            </div>

            <div id="joinGamePage">
                <h1 class="display-3">Join a game</h1>
                <p class="lead">Enter game number to join a game!</p>
                <hr class="my-4">
                <p class="lead">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="text" class="form-control" id="gameIDInput" placeholder="Game ID">
                            </div>
                            <div class="input-group-append">
                                <button type="button" id="joinGameSubmit"class="btn btn-primary">Join</button>
                            </div>
                        </div>
                    </div>
                </p>
            </div>

            <div id="gamePage">

                <div id="gameWaitPage">
                    <p class="lead">Waiting for players to join game!</p>
                    <p class="lead" id="gameWaitingPageGameID">Your game ID is : '.$_SESSION['gameID'].'</p>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="'.$numberOfPlayersPercent.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$numberOfPlayersPercent.'%"></div>
                    </div>
                    <p class="lead">
                    <div class="form-group">
                        <ul class="list-group list-group-flush" id="gameWaitingPagePlayerList">
                            <div id="gameWaitingPageP1"></div>
                            <div id="gameWaitingPageP2"></div>
                            <div id="gameWaitingPageP3"></div>
                            <div id="gameWaitingPageP4"></div>
                            <div id="gameWaitingPageP5"></div>
                            <div id="gameWaitingPageP6"></div>
                            <div id="gameWaitingPageP7"></div>
                            <div id="gameWaitingPageP8"></div>
                            <div id="gameWaitingPageP9"></div>
                        </ul>
                        <hr>
                        <div id="startGameButton">
                            <button type="button" id="startGame2" class="btn btn-primary btn-lg btn-block">Start Game</button>
                        </div>
                    </div>
                    </p>
                </div>

                <div id="gameRoundPage">
                    <div class="card text-white bg-secondary mb-3" style="max-width: 20rem;">
                        <div class="card-header">Question</div>
                        <div class="card-body">
                            <p class="card-text" id="gameRoundPageQuestion"></p>
                            <hr>
                            <div class="form-group">
                                <label for="answerTextArea">Type your answer below!</label>
                                <textarea class="form-control" id="answerTextArea" rows="3"></textarea>
                                <hr>
                                <button type="button" id="submitAnswer" class="btn btn-primary btn-lg btn-block">Submit Answer</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="gameRoundWaitPage">
                    <p class="lead">Waiting for players submit their answers!!</p>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
                    </div>
                    <p class="lead">
                    <div class="form-group">
                        <ul class="list-group list-group-flush" id="gameRoundWaitingPagePlayerList">
                            <div id="gameRoundWaitingPageP1"></div>
                            <div id="gameRoundWaitingPageP2"></div>
                            <div id="gameRoundWaitingPageP3"></div>
                            <div id="gameRoundWaitingPageP4"></div>
                            <div id="gameRoundWaitingPageP5"></div>
                            <div id="gameRoundWaitingPageP6"></div>
                            <div id="gameRoundWaitingPageP7"></div>
                            <div id="gameRoundWaitingPageP8"></div>
                            <div id="gameRoundWaitingPageP9"></div>
                        </ul>
                        <hr>
                    </div>
                    </p>
                </div>

                <div id="gamePickPage">
                    <p class="lead" id="gamePickQuestion"></p>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
                    </div>
                    <p class="lead">
                    <div class="form-group">
                        <ul class="list-group list-group-flush" id="gameRoundWaitingPagePlayerList">
                            <hr>
                            <blockquote class="blockquote text-center" style="font-size:75%;">
                                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                            </blockquote>
                            <hr>
                            <div id="gameRoundPickPageP1"></div>
                            <div id="gameRoundPickPageP2"></div>
                            <div id="gameRoundPickPageP3"></div>
                            <div id="gameRoundPickPageP4"></div>
                            <div id="gameRoundPickPageP5"></div>
                            <div id="gameRoundPickPageP6"></div>
                            <div id="gameRoundPickPageP7"></div>
                            <div id="gameRoundPickPageP8"></div>
                            <div id="gameRoundPickPageP9"></div>
                        </ul>
                    </div>
                    </p>
                </div>

            </div>
        </div>
    </div>
</body>

<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Getting Started...</h5>
            </div>
            <div class="modal-body">
                <form data-bitwarden-watching="1">
                    <fieldset>
                        <legend>Your Name</legend>
                        <div class="form-group">
                            <input type="text" class="form-control" id="userInput" aria-describedby="userHelp" placeholder="Your Name">
                            <small id="userHelp" class="form-text text-muted">This will be your name for all the games</small>
                        </div>
                        <center><button type="submit" id="submitUser" class="btn btn-primary">Get Started!</button></fieldset></form></center>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="js/bootstrap.min.js"></script>
<?php

if($loggedIn == false){
    echo '<script> $(\'#loginModal\').modal();</script>';
}
?>
<script>
    function getGame(){

        $.post( "back/game.php", function( data ) {
            setTimeout(function(){getGame();}, 2000);
            console.log(data);
            if(data.page == "waitingPage"){
                console.log("waiting page");
                $('#gameWaitPage').show(600);
                $('#gameWaitingPageGameID').html("Your game ID is : " + data.gameID);

                for (var counter = 0; counter < data.numberOfPlayers; counter++) {
                    var counterPlus1 = counter + 1;
                    $('#gameWaitingPageP' + counterPlus1).html("<li class=\"list-group-item\">" + data.players["p" + counterPlus1] + "</li>");
                 }
            }
            if(data.page == "roundPage"){
                $('#startGameButton').hide();
                $('#gameWaitPage').hide(600);
                $('#gameRoundPage').show(600);
                $('#gameRoundPageQuestion').html(data.question);
            }
            if(data.page == "roundWaitingPage"){
                $('#gameRoundWaitPage').show(100);
                $('#startGameButton').hide();
                $('#gameWaitPage').hide(600);
                //Better way of doing things, need to fix gameWaitingPagePx
                for (var counter = 0; counter < data.totalPlayers; counter++) {
                    var counterPlus1 = counter + 1;
                    $('#gameRoundWaitingPageP' + counterPlus1).html("<li class=\"list-group-item\">" + data.players["p" + counterPlus1] + " " + data["p" + counterPlus1] + "</li>");
                }
            }
            if(data.page == "roundPickPage"){
                $('#gameRoundWaitPage').hide(100);
                $('#gamePickPage').show(100);
                for (var counter = 0; counter < data.totalPlayers; counter++) {
                    var counterPlus1 = counter + 1;
                    // TODO: add this below<hr><blockquote class="blockquote text-center" style="font-size:75%;"><p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p></blockquote>
                    $('#gameRoundPickPageP' + counterPlus1).html("<li class=\"list-group-item\">" + data.players["p" + counterPlus1] + " " + data["p" + counterPlus1] + "</li>");
                }
            }
        }, "json");
    }
    $( document ).ready(function() {
        $('#joinGamePage').hide();
        $('#GamePage').hide();
        $('#startGameButton').hide();
        $('#startGame2').hide();
        $('#gameWaitPage').hide();
        $('#gameRoundPage').hide();
        $('#gameRoundWaitPage').hide();
        $('#gamePickPage').hide();
    });

    $('#joinGame').click(function() {
        $('#startPage').hide(600);
        $('#joinGamePage').show(600);
        setTimeout(function(){
            getGame();
        },800);
    });

    $('#submitUser').click(function() {
        user = $('#userInput').val();
        $.post( "back/requests.php", { adduser: true, user: user})
            .done(function( data ) {
                if(data == "error") {
                    console.log("error: " + data);
                }else{

                    $('#loginModal').modal('hide');
                    console.log("success: " + data);
                }
            });
    });

    $('#joinGameSubmit').click(function() {
        gameID = $('#gameIDInput').val();
        $.post( "back/requests.php", { joinGame: true, gameID: gameID})
            .done(function( data ) {
                if(data == "error") {
                    console.log("error: " + data);
                }else{
                    $('#gameIDInput').addClass("is-valid");
                    console.log("success: " + data);
                    $('#joinGamePage').delay(800).hide(600);
                    $('#gamePage').delay(800).show(600);
                    $('#navBar').delay(800).hide(600);
                    $('#navSpacer').delay(800).hide(600);
                    $('#startGameButton').show();
                    setTimeout(function(){
                        getGame();
                    },800);
                }
            });
    });
    $('#startAGame').click(function() {
        $.post( "back/requests.php", { startAGame: true
        })
            .done(function( data ) {
                if(data == "error") {
                    console.log("error: " + data);
                }else{
                    $('#gameIDInput').addClass("is-valid");
                    console.log("success: " + data);
                    $('#startPage').hide(600);
                    $('#joinGamePage').hide(600);
                    $('#gamePage').show(600);
                    $('#navBar').hide(600);
                    $('#navSpacer').hide(600);
                    $('#startGameButton').show(600);
                    $('#startGame2').show(600);
                    setTimeout(function(){
                        getGame();
                    },800);
                }
            });
    });
    $('#startGame2').click(function() {
        $.post( "back/requests.php", { startGame: true })
            .done(function( data ) {
                if(data == "error") {
                    console.log("error: " + data);
                }else{
                    console.log("success: " + data);
                    $('#startGameButton').hide();
                    $('#gameWaitPage').hide(600);
                    setTimeout(function(){
                        getGame();
                    },800);
                }
            });
    });
    $('#submitAnswer').click(function() {
        var answer1 = $('#answerTextArea').val();
        $.post( "back/requests.php", { submitAnswer: true, answer: answer1}, function( data ) {
                if(data.error1 != "false") {
                    console.log("error: " + data.error1);
                }else{
                    if(data.answered != ''){
                        console.log("answered")
                        $('#gameRoundPage').hide(600);
                        $('#gameRoundWaitPage').show(600);
                        setTimeout(function(){
                            getGame();
                        },800);
                    }
                }
        }, "json");
    });
</script>

