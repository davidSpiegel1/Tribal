<!DOCTYPE html>
<html>

<head>
    <title> Tribe Page </title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="style.css" type="text/css" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

</head>
<body class = "bottom_background" onload="showStream()">
<div class = "stripHolder" class = "row">

    <div class = "wrapper">
        <div class = "main1 ">
        <form action="./controller.php" class = "searchBar">
            <textarea name = "written" rows='1' cols='17' placeholder="Search"></textarea>
            <button name="search">
                <span class="material-symbols-outlined">
                            search
                </span>
                </button>
        </form>

        </div>
        <button onclick="showPanel()" class = "side-panel-toggle" >
        <span class="material-symbols-outlined">
                            menu
        </span>
        </button>
        <div class = "icon">
                    <h4 style = "border-style: solid; border-radius: 15px;"><a href = "index.php"><span class = "newSpan">Tribal</span></a></h4>
                </div>   
        <div class = "side-panel">
    <?php
    session_start();
    if (isset($_SESSION['user'])){
        if ($_SESSION['user'] === 'admin'){
            echo '<a href=""><button class = "button_type">delete </button></a>';
        }
        echo 'Hello '.htmlspecialchars($_SESSION['user']).'!';
        echo '<a href="./logout.php"><button class = "button_type">logout</button></a><br>';
    }else{
        echo '<a href="./login.php"><button class = "button_type"> Login</button></a><br>';
        echo '<a href="./register.php"><button class = "button_type">Register</button></a><br>';
    }
    ?>

        <a href="./addTribe.php"><button class = "button_type">add Tribe</button></a>
        </div>
        <?php
    if (isset($_SESSION['user'])){
        $result = '<div class = "userIcon">';
        $result .= '<h2 style = "border-style: solid; border-radius: 15px;"><span class = "newSpan2">'.htmlspecialchars($_SESSION['user']).'</span></h2>';
        $result .= '</div>';
        echo $result;


    }
    ?>
    </div>
</div>
<hr>
<?php
$str = "";
if (isset($_SESSION['user']) && $_SESSION['user'] === 'admin') {
    $str .= "<br>";
    $str .= "<form action = 'controller.php' method='post'>";
    $str .= "<textarea placeholder='write tribe name' name = 'deleteText'></textarea><br>";
    $str .= "<button class = 'button_type' name = 'deleteTribeStream'> Delete Tribe Stream </button>";
    $str .= "</form>";
}
if (isset($_SESSION['curName'])){
    $str .= "<hr><hr>";
    $str .= "<h2> Tribe: ".$_SESSION['curName']." </h2>";
    $str .= "<hr>";
    $str .= " <p> <b>Description:</b> " . $_SESSION['curDescription']."</p>";
    if (isset($_SESSION['curTribe']) && $_SESSION['curTribe'] === $_SESSION['curName']) {
        $str .= "<form action = 'controller.php' method = 'post'>";
        $str .= "<textarea name = 'stream' rows='3' cols='30' placeholder='Enter Stream' class = 'commentClass'></textarea><br>";
        $str .= "<button name='addStream' class = 'buttonComment'>Add stream</button>";
        $str .= "<input type='hidden' name='streamUser' value='" . $_SESSION['curName'] . "'>";
        $str .= "</form>";
    }else{
        $str .= "<form action = 'controller.php' method = 'post'>";
        $str .= "<button class='button_type' name='beTribe'>Join Tribe</button></form>";
    }
}

$str .= "<hr>";


echo $str;

?>
<div id = "streamEl">Hey</div>
<script>
    var element = document.getElementById("streamEl");
    function showPanel(){
            document.querySelector(".wrapper").classList.toggle("side-panel-open");

        }
    function showStream(){

        let ajax = new XMLHttpRequest();
        ajax.open('GET','controller.php?command=tribeStream',true);
        ajax.send();
        ajax.onreadystatechange = function (){

            if (ajax.readyState == 4 && ajax.status == 200){
                let array = JSON.parse(ajax.responseText);
                element.innerHTML = array;
            }

        };
    }
</script> 

</body>
</html>