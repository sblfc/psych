<?php
@session_start();
include("db.php");

if(isset($_POST['adduser'])){
    $sql = "INSERT INTO user (name, ip, added) VALUES (?,?,?)";
    $stmt= $pdo->prepare($sql);
    $stmt->execute([$_POST['user'], $_SERVER['REMOTE_ADDR'], time()]);
    $id = $pdo->lastInsertId();
    echo $id;
    $_SESSION['id'] = $id;
    $_SESSION['name'] = $_POST['user'];
}elseif(isset($_POST['joinGame'])) {
    $_SESSION['gameID'] = $_POST['gameID'];

    $count=$pdo->prepare("select * from games where id = :id");
    $count->bindParam(":id",$_POST['gameID'],PDO::PARAM_INT,1);
    if($count->execute()){
        $row = $count->fetch(PDO::FETCH_OBJ);
        echo $row->id;
        if($row->p1 == $_SESSION['id'] || $row->p2 == $_SESSION['id'] || $row->p3 == $_SESSION['id'] || $row->p4 == $_SESSION['id'] || $row->p5 == $_SESSION['id'] || $row->p6 == $_SESSION['id'] || $row->p7 == $_SESSION['id'] || $row->p8 == $_SESSION['id'] || $row->p9 == $_SESSION['id']){
            echo "already in game";
        }else {
            $newUserCount = $row->users + 1;
            $player = "p" . $newUserCount;
            $sql = "UPDATE games SET " . $player . "=?, users=? WHERE id=?";
            $pdo->prepare($sql)->execute([$_SESSION['id'], $newUserCount, $row->id]);
            $_SESSION['player'] = $player;
            echo $_SESSION['player'];
        }
    }else{
        echo "error";
    }
}elseif(isset($_POST['startAGame'])) {
    $sql = "INSERT INTO games (started, p1) VALUES (?,?)";
    $stmt= $pdo->prepare($sql);
    $stmt->execute([time(), $_SESSION['id']]);
    $id = $pdo->lastInsertId();
    $_SESSION['gameID'] = $id;
    $_SESSION['gameAdmin'] = $id;
    $_SESSION['player'] = "p1";
    echo $id;
}elseif(isset($_POST['startGame'])) {
    $sql = "UPDATE games SET round='1' WHERE id=?";
    $pdo->prepare($sql)->execute([$_SESSION['gameID']]);
    echo "success: Game Started";
}elseif(isset($_POST['submitAnswer'])) {
    $sql = "UPDATE rounds SET `".$_SESSION['player']."` = ? WHERE `gameID` = ?";
    $pdo->prepare($sql)->execute([$_POST['answer'], $_SESSION['gameID']]);
    echo json_encode(array("error1" => "false"));
    //echo var_dump()
}else{
    echo "error";
}

?>