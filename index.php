<!--
    David Spiegel
    Description: 
-->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">

    <title>FunGames</title>

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=2">

  <!-- Get the CSS file needed for Bootstrap from the Web.  It will be cached the first time -->

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="style.css" type="text/css" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

  <title> Fun Games!</title>
       
        
    </head>

    <?php
    session_start();
    $result = '';
    if (isset($_SESSION['curTribe']) && isset($_SESSION['user'])){
        $_SESSION['searchTerm'] = $_SESSION['curTribe'];
        $result .= '<body onload="start()"  class = "bottom_background">';
    }else{
        $result .= '<body onload="showTribes()" class = "bottom_background">';
    }
    echo $result;
   ?>
    
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
                  
                    <h4 style = "border-style: solid; "><a href = "index.php"><span class = "newSpan">Tribal</span></a></h4>
                </div>   
        <div class = "side-panel">
    <?php
    
    if (isset($_SESSION['user'])){
        if ($_SESSION['user'] === 'admin'){
            $result= '<form action="./controller.php" method="post"><button class = "button_type" name = "delete">delete </button>';
            $result .= '<textarea name = "written" cols="10" placeholder="deleteMe"></textarea></form>';
            echo $result;
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
       
        
<br>
<br>

<div id = "frontDiv"></div>
<hr>
<p><b>New Arivals</b></p>
<hr>

<div id = "div2Change">
Change me
</div>

    <script>

        function showPanel(){
            document.querySelector(".wrapper").classList.toggle("side-panel-open");
        
        }

        function start(){
            showTribes();
            displaySearch();
        }
        window.onload = start;
        var element = document.getElementById("div2Change");
        function showTribes(){
            let ajax = new XMLHttpRequest();
            ajax.open('GET','controller.php?command=getTribes',true);
            ajax.send();
            ajax.onreadystatechange = function(){

                if (ajax.readyState == 4 && ajax.status == 200){
                    let array = JSON.parse(ajax.responseText);
                    element.innerHTML = array;
                }
            }
        }

        function setTribePage(){
            let ajax = new XMLHttpRequest();
            ajax.open('GET','controller.php?command=setTribe',true);
            ajax.send();
            

        }


        var el = document.getElementById("frontDiv");
        function displaySearch(){
            
            let ajax = new XMLHttpRequest();
            ajax.open('GET','controller.php?command=getSearch2',true);
            ajax.send();
            ajax.onreadystatechange = function(){

                if (ajax.readyState == 4 && ajax.status == 200){
                    let array = JSON.parse(ajax.responseText);
                    el.innerHTML = array;
                }
            }
        }
        </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</div>
</body>
    </html>