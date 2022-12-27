<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="style.css" type="text/css" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

</head>
<body class = "bottom_background">
   
<div class = "stripHolder" class = "row">

<div class = "wrapper">
    <div class = "main1 ">
    <form action="./controller.php" class = "searchBar" method="post">
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

if (isset($_SESSION['user'])){
    if ($_SESSION['user'] === 'admin'){
        echo '<a href=""><button class = "button_type">delete </button></a>';
    }
    echo 'Hello '.htmlspecialchars($_SESSION['user']).'!<br>';
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
<hr>
<h1> Login</h1>
<div id = "div2Change"></div>

<div class ='containerLog'>

    <form action = 'controller.php' method='post'>
    <textarea name = 'username' rows='1' cols='16' placeholder='Username'></textarea><br>
    <input type='password' name='password' placeholder='Password'required></input><br>
    <button name = 'login'>Login</button>
    <br>

</form>
<div class = 'coolRed'>

<?php
session_start();
if (isset($_SESSION['notUser'])){
    echo "Invalid Username and/or Password";
}
?>
</div>

</body>
</html>