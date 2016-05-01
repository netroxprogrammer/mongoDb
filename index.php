

<?php 

if(isset($_POST["submit"])){
	header("Locatiion: level1.php");
}
?>


<html>
<head>
<link rel="stylesheet" type="text/css" href="css/level5.css" />
</head>
<body>
<form method="post">
<input type="submit" name="submit" /> 
</form>
<div class="wrapper">
<br><br>
    <div class="container">
        <p>Welcome to ON The mind please Complete the following  the questionaire below</p>       
        <form  method="post">
        1.Why have you decided to use this app?
            <input type="text" placeholder="Enter Text" name="decide" required="required">
            <br><br>
        2.what three things would like to get out of using this app?
            <input type="text" placeholder="Enter Text" required="required" name="thing1">
            <input type="text" placeholder="Enter Text" required="required" name="thing2">
            <input type="text" placeholder="Enter Text" required="required" name="thing3">
           
            <br><br>
            3.What time constraints do you forese and how can you plan around them?
            <input type="text" placeholder="Enter Text" required="required" name="constrain" >
            <br><br>
            <input type="submit" name="submit" />
          
        </form>
    </div>
</div>

</body>
</html>