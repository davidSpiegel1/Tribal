<!DOCTYPE html>
<html>
    <head>
        <title>AddTribe</title>

<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body class = "bottom_background" >

<h1>Add a Tribe</h1>
<div id = "tribe"></div>
<form action='controller.php' method='post'>
    <textarea name='tribe' rows='2' col='20' placeholder='Enter tribe name'></textarea>
    <br>
    <br>
    <textarea name = 'mission' rows='5' col='20' placeholder='Enter tribe mission statement'></textarea>

    <br>
    <button name='addTribe'>add Tribe</button>


</form>
</div>

</body>
</html>