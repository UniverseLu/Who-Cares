<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<?php
   $street = $_GET['street'];
   $city = $_GET['city'];
   $state = $_GET['states'];
   setcookie("mystreet","$street");
   setcookie("mycity","$city");
   setcookie("mystate","$state");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Homepage</title>
    <link rel="stylesheet" type="text/css" href="mainframe.css">
    <style TYPE="text/css">
        body {
            font-family:Arial, Helvetica, sans-serif;
            background-color: #FF9966;
            background-repeat: repeat;
            margin: 0 0 0 0;}
    </style>
</head>

<body>
<div id="header">
    <div id="headerBar">WhoCares</div>
    <div id="headerRight"><button type="button"  onClick="open_login()">Log out</button></div>
    <div id="headerRight" ><button type="button"  onClick="create()" >My Page</button></div>
</div>
<div id="content" >
    <IFRAME  id="framem" width="100%" height="100%" src="homepage.php" frameborder="0" ></IFRAME></div>
<div id="footer" class="afooter"><BR>Website Designed by <a href="mailto:herong@ufl.edu">RR</a>  All Rights Reserved</div>
</body>
</html>