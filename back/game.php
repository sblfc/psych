<?php
@session_start();
include("db.php");

function waitingPage($pdo, $gameID){
    //Waits for people to join, once next button is pressed game is started.
    $count = $pdo->prepare("select * from games where id = :id");
    $count->bindParam(":id", $gameID, PDO::PARAM_INT,1);
    if($count->execute()) {
        $game = $count->fetch(PDO::FETCH_OBJ);

        $playerArray = array("p1"=> "", "p2" => "", "p3" => "", "p4" => "", "p5" => "", "p6" => "", "p7" => "", "p8" => "", "p9" => "");
        $playerList = "";
        foreach($playerArray as $playerNum => $playerName){
            if(isset($game->$playerNum)){
                $count = $pdo->prepare("select * from user where id = :id");
                $count->bindParam(":id", $game->$playerNum, PDO::PARAM_INT,1);
                if($count->execute()) {
                    $user = $count->fetch(PDO::FETCH_OBJ);
                    if(isset($user->name)) {
                        $playerArray[$playerNum] = $user->name;
                    }
                }else{
                    return "player not found";
                }
            }
        }
        $numberOfPlayers = 0;
        foreach($playerArray as $playerNum => $playerName) {
            if($playerName != NULL){
                $playerList .= '<li class="list-group-item">'.$playerName.'</li>';
                $numberOfPlayers += 1;
            }
        }
        $numberOfPlayersPercent = $numberOfPlayers*10;
        return json_encode(array("error" => "false","page" => "waitingPage", "gameID" => $gameID, "players" => $playerArray, "numberOfPlayers" => $numberOfPlayers));
    }else{
        return "error: gameID not found";
    }
}
function roundPage($pdo, $gameID){
    //Display questions and a submit button
    $count = $pdo->prepare("SELECT * FROM games WHERE id = :id");
    $count->bindParam(":id", $gameID, PDO::PARAM_INT,1);
    if($count->execute()) {
        $game = $count->fetch(PDO::FETCH_OBJ);

        $sql = "SELECT count(*) FROM rounds WHERE gameID = :id";
        $result = $pdo->prepare($sql);
        $result->bindParam(":id", $gameID, PDO::PARAM_INT,1);
        $result->execute();
        $numberOfRounds = $result->fetchColumn();

        if($numberOfRounds+1 <= $game->round){
            //TODO: make sure same question doesnt get picked twice
            $stm = $pdo->prepare("SELECT * FROM questions WHERE approved = '1' ORDER BY RAND() LIMIT 1");
            $stm->execute();
            $data = $stm->fetch();

            $sql = "INSERT INTO rounds (gameID, round, questionID) VALUES (?, ?, ?)";
            $stmt= $pdo->prepare($sql);
            $stmt->execute([$gameID, $numberOfRounds+1, $data['id']]);
            $id = $pdo->lastInsertId();

        }else{

            $stm = $pdo->prepare("SELECT * FROM rounds WHERE gameID = ? AND round = ?");
            $stm->execute(array($gameID, $game->round));
            $roundData = $stm->fetch();

            $stm = $pdo->prepare("SELECT * FROM questions WHERE id = ?");
            $stm->execute(array($roundData['questionID']));
            $data = $stm->fetch();

            $answered = $roundData[$_SESSION['player']];
            return json_encode(array("error" => "false","page" => "roundPage", "question" => $data["question"], "answered" => $answered));
        }
    }else{
        echo "error";
    }
}

function roundWaitingPage($pdo, $game){
    //display waiting page after question submitted
    $stm = $pdo->prepare("SELECT * FROM rounds WHERE gameID = ? AND round = ?");
    $stm->execute(array($_SESSION['gameID'], $game));
    $roundData = $stm->fetch();

    $count = $pdo->prepare("SELECT * FROM games WHERE id = :id");
    $count->bindParam(":id", $_SESSION['gameID'], PDO::PARAM_INT,1);
    $count->execute();
    $gameRow = $count->fetch(PDO::FETCH_OBJ);

    for ($x = 1; $x <= 9; $x++) {
        ${"p$x"} = (isset($roundData["p".$x])) ? "<font color=\"green\"> - Ready</font>" : "<font color=\"red\"> - Waiting...</font>";
    }

    //TODO: make a function for this as it's used twice
    $playerArray = array("p1"=> "", "p2" => "", "p3" => "", "p4" => "", "p5" => "", "p6" => "", "p7" => "", "p8" => "", "p9" => "");
    foreach($playerArray as $playerNum => $playerName){
        if(isset($gameRow->$playerNum)){
            $count = $pdo->prepare("select * from user where id = :id");
            $count->bindParam(":id", $gameRow->$playerNum, PDO::PARAM_INT,1);
            if($count->execute()) {
                $user = $count->fetch(PDO::FETCH_OBJ);
                if(isset($user->name)) {
                    $playerArray[$playerNum] = $user->name;
                }
            }else{
                return "player not found";
            }
        }
    }

    $numberReady = 0;
    for ($x = 1; $x <= 9; $x++) {
        if(${"p$x"} == "Ready"){
            $numberReady++;
        }
    }
    return json_encode(array("error" => "false","page" => "roundWaitingPage", "p1" => $p1, "p2" => $p2, "p3" => $p3, "p4" => $p4, "p5" => $p5, "p6" => $p6, "p7" => $p7, "p8" => $p8, "p9" => $p9, "players" => $gameRow->users, "numberReady" => $numberReady, "players" => $playerArray, "totalPlayers" => (int)$gameRow->users));
}

function roundPickPage($pdo, $totalPlayers){
    //TODO: FINISH: display waiting page after question submitted
    $stm = $pdo->prepare("SELECT * FROM rounds WHERE gameID = ? AND round = ?");
    $stm->execute(array($_SESSION['gameID'], $game));
    $roundData = $stm->fetch();

    return json_encode(array("error" => "false","page" => "roundPickPage", "totalPlayers" => $totalPlayers));
}

function roundWinnerPage(){
    //TODO: call after all users submitted answer
}

function gameWinnerPage(){
    //TODO: Winner page
}

$count = $pdo->prepare("select * from games where id = :id");
$count->bindParam(":id",$_SESSION['gameID'],PDO::PARAM_INT,1);
if($count->execute()) {
    $game = $count->fetch(PDO::FETCH_OBJ);

    $stm = $pdo->prepare("SELECT * FROM rounds WHERE gameID = ? AND round = ?");
    $stm->execute(array($_SESSION['gameID'], $game->round));
    $roundData = $stm->fetch();
    //Working out how many players have submitted their answer
    $amountReady = 0;
    for ($x = 1; $x <= 9; $x++) {
        (isset($roundData["p".$x])) ?  $amountReady++ : "";
    }

    if ($game->round == "0") {
        echo waitingPage($pdo, $_SESSION['gameID']); //waiting page before game starts
    } elseif ($game->round > "0") {
        if($roundData[$_SESSION['player']] != null){
            if($game->users == $amountReady){
                //TODO: pick answers
                echo roundPickPage($pdo, $game->users);
            }else{
                echo roundWaitingPage($pdo, $game->round); //Waiting page after round
                echo "waiting page after round";
            }
            //TODO add results page
        }else{
            echo roundPage($pdo, $_SESSION['gameID']);
        }
    } elseif ($game->round > "9") {
        //TODO: Display winner page
    }
}else{
    die(json_encode(array("error" => "Could not find game ID")));
}