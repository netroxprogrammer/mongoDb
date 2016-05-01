<?php 
session_start();
//session_destroy();
if(!isset($_SESSION['name']) && !isset($_SESSION['userName']) && !isset($_SESSION['hidden'])){
	header("Location: login.php?error=Please login");

}
else{

	
	
	
	?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/level5.css" />
<title>Untitled Document</title>
</head>

<body>
<div class="wrapper">
<br><br>
    <div class="container">
        <h2><p>Welcome to ON The mind please Complete the following  the questionaire below</p></h2>       
        <form class="form">
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
            <input type="submit" name="submit" >
          
        </form>
    </div>
</div>
</body>
</html>
<?php }?>