<?php
// Within this file we will contruct our controller
session_start();
require_once './DatabaseAdaptor.php';
$theDBA = new DatabaseAdaptor();

if (isset($_GET['command']) && $_GET['command'] === 'getTribes'){
    $arr = $theDBA->getAllTribes();
    unset($_GET['command']);
    echo json_encode(getTribesAsHTML($arr));
}

if (isset($_POST['tribe']) && isset($_POST['mission'])){
    $theDBA->addTribe($_POST['tribe'], $_POST['mission']);
    //unset($_POST['tribe']);
    //unset($_POST['mission']);
    header("Location: index.php");

}
if (isset($_POST['beTribe'])){
    $theDBA->beTribe($_SESSION['curName'],$_SESSION['user']);
    $_SESSION['curTribe'] = $_SESSION['curName'];
    header('Location: tribePage.php');
}

if (isset($_POST['search'])){
    $_SESSION['searchTerm'] = $_POST['written'];
    header("Location: searchPage.php");
}

if (isset($_POST['curName']) && isset($_POST['curDecription'])){

    $_SESSION['curName'] = $_POST['curName'];
    $_SESSION['curDescription'] = $_POST['curDecription'];
    header("Location: tribePage.php");

}
if (isset($_POST['delete'])){
    $theDBA->deleteTribe($_POST['written']);
    unset($_POST['delete']);
    unset($_POST['written']);
    header("Location: index.php");
}
if (isset($_POST['addStream'])){
    if (isset($_SESSION['user'])){
        $theDBA->addStream($_POST['streamUser'],$_POST['stream'],$_SESSION['user']);
    } else {
        $theDBA->addStream($_POST['streamUser'], $_POST['stream'], "None");
    }
    header("Location: tribePage.php");
}

if (isset($_POST['deleteTribeStream'])){
    if (isset($_POST['deleteText']) && isset($_SESSION['curTribe'])){
        $theDBA->deleteTribeStream($_POST['deleteText'], $_SESSION['curTribe']);
        //header("Location: tribePage.php");

    }
    header("Location: tribePage.php");

}
if (isset($_GET['command']) && $_GET['command'] === 'tribeStream'){
    $arr = $theDBA->getTribeStreamWhen($_SESSION['curName']);
    //unset($_POST['tribeStream']);
    unset($_GET['command']);
    //header("Location: tribePage.php");
    echo json_encode(getTribeStreamAsHTML($arr));
}

if (isset($_GET['command']) && $_GET['command'] === 'getSearch'){
    $arr = $theDBA->getTribeStreamWhen($_SESSION['searchTerm']);
    $arr1 = $theDBA->getTribeWhen($_SESSION['searchTerm']);
    unset($_GET['command']);
    echo json_encode(getResultAsHTML($arr,$arr1));

}
if (isset($_GET['command']) && $_GET['command'] === 'getSearch2'){
    $arr = $theDBA->getTribeStreamWhen($_SESSION['searchTerm']);
    $arr1 = $theDBA->getTribeWhen($_SESSION['searchTerm']);
    unset($_GET['command']);
    echo json_encode(getMainResultAsHTML($arr,$arr1));

}

if (isset($_POST['reg'])){
    $theDBA->addUser($_POST['username'], $_POST['password']);
    header("Location: index.php");
}

if (isset($_POST['login'])){
   //if ($theDBA->verifyCredentials($_POST['username'],$_POST['password'])){
        $_SESSION['user'] = $_POST['username'];
        header("Location: index.php");

   // }


}

function getTribeStreamAsHTML($arr){
    $result = '';
    foreach($arr as $stream){
        $result .= '<div class = "containerStream"><b>';
        $result .= $stream['point'].'</b><br>';
        $result .= '<i>'.$stream['user'] . '</i>&nbsp;<b style="list-style:circle;">'.$stream['tribe'].'</b>';
        
        
        $result .= '</div>';
    
    }
    return $result;
}
function getTribesAsHTML($arr){
    $result = '';
    
    $result .= '<div class = "row horizontal-scrollable">';
    foreach ($arr as $tribe){
        
        $result .= '<div class = "col">';
       
        $result .= '<form action="controller.php" method="post">';
        
        $result .= '<button class = "game_container"><b>' . $tribe['name'] . '</b><br>' . $tribe['description'];
        
        $result .=  '</button>';
        $result .= '<input type = "hidden" name= "curName" value="'.$tribe['name'].'">';
        $result .= '<input type = "hidden" name= "curDecription" value="' . $tribe['description'] . '">';
        
        $result .= '</form>';
        
        $result .= '<br></div><br>';
    }
    $result .= '</div>';
    return $result;
}

function getMainResultAsHTML($arr,$arr1){
    $result = '';
    $result .= '<div class = "main_container">';
    $rating = '';
    foreach ($arr1 as $tribe){
        $rating .= $tribe['rating'];
        $result .= '<p><b>Current Tribe - ' . $tribe['name'].'</b></p>';
        $result .= '<form action="controller.php" method="post">';
        $result .= '<button class = "game_main_container"><b>' . $tribe['name'].'</b><br>'.$tribe['description'] . '</button>';
        $result .= '<input type = "hidden" name= "curName" value="'.$tribe['name'].'">';
        $result .= '<input type = "hidden" name= "curDecription" value="' . $tribe['description'] . '">';
        $result .= '</form>';
        $result .= '';
    }
    $result .= '</div>';
    $count = 0;
    foreach($arr as $stream){
        $count++;
    }
    $result .= '<div class = "row">';
    $result .= '<div class = "col-md-4">';
    $result .= 'Hi';
    
    $result .= '</div><div class = "col-md-4">HII';
   
    $result .= '</div>';
    $result .= '<div class = "col-md-4">';
    $result .= ' <form action = "controller.php" class = "ratingBox" method="post"><button class = "buttonComment"><span class = "material-symbols-outlined">thumb_up</span></button>'.$rating.'<button class = "buttonComment"><span class="material-symbols-outlined">thumb_down</span></button></form>';
    $result .= '</div></div><br><br>';
    $result .= '  '.$count . ' Comment(s) <br><br> ';
    if (isset($_SESSION['user'])){

    $result .= '<div class = "containerStream">';
    $result .= '<div class = "userCircle"><i><span class = "newSpan2">'.htmlspecialchars($_SESSION['user']).'</span></i></div>';
    $result .= "<form action = 'controller.php' method = 'post' >";   
    $result .= "<textarea class ='commentClassTwo' name = 'stream' rows='1' cols='30' placeholder='Add a stream...'></textarea>";
    $result .= "<button name='addStream' class='buttonComment'>Add stream</button>";
    $result .= "<input type='hidden' name='streamUser' value='" . $_SESSION['curName'] . "'>";
    $result .= "</form>";
    $result .= '</div>';
    }

    foreach($arr as $stream){

        $result .= '<div class = "containerStream">';
        
        $result .= '<div class = "userCircle"><i><span class = "newSpan2">'.$stream['user'] . '</span></i></div>';
        $result .= '<b>'.$stream['point'].'</b>';
        
        $result .= '</div>';
    }
    
    return $result;

}

function getResultAsHTML($arr,$arr1){
    $result = '';
    $result .= '<h3><b> Tribe(s) Found: </b> </h3>';
    $result .= '<div class = "row horizontal-scrollable">';

    foreach ($arr1 as $tribe){
        $result .= '<div class = "col">';
        $result .= '<form action="controller.php" method="post">';
        $result .= '<button class = "game_container"><b>' . $tribe['name'].'</b><br>'.$tribe['description'] . '</button>';
        $result .= '<input type = "hidden" name= "curName" value="'.$tribe['name'].'">';
        $result .= '<input type = "hidden" name= "curDecription" value="' . $tribe['description'] . '">';
        $result .= '</form>';
        $result .= '<br></div><br>';
    }
    $result .= '</div>';
    $result .= '<h3><b> Tribe Stream Related:</b> </h3>';
    
    foreach($arr as $stream){
        $result .= '<div class = "containerStream"><b><br>';
        $result .= '<i>'.$stream['user'] . '</i><br>';
        $result .= $stream['point'].'</b>';
        $result .= '</div>';
    
    }
    return $result;

}



?>