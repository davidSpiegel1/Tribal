<!--
    David Spiegel
    Description: 
-->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">

<title>Search Page</title>

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=2">

  <!-- Get the CSS file needed for Bootstrap from the Web.  It will be cached the first time -->

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="style.css" type="text/css" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        <title> Fun Games!</title>
    </head>

    
    <body  class = "bottom_background" onload="displaySearch()">
        
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
       <br>
       <br>
       <br>
       


        <hr>
        <div class = "bottom_background">
        <div class = "row" >
            <div class = "col-lg-12">
                <b>Results</b>
            </div>
            <br>
                    </div>
            </div>

       

        <hr>
        <div id = "div2Change2">

    <script>
        function showPanel(){
            document.querySelector(".wrapper").classList.toggle("side-panel-open");
        
        }
        var el = document.getElementById("div2Change2");
        function displaySearch(){
            let ajax = new XMLHttpRequest();
            ajax.open('GET','controller.php?command=getSearch',true);
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



</div>


</body>
    </html>