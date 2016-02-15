<?php
session_start();

  if ($_GET['user'] != "" && !isset($_SESSION["sid"])){  
     $_GET['user']= "";
     session_destroy();
     header("location:login.php");
  }

  require_once 'connection.php';

  if(isset($_SESSION["sid"]))
  {
  	 if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1400))
     header("location:logout.php");

     $sid=$_SESSION["sid"];
     $rid=$_SESSION["rid"];
     $query="SELECT uniqueid FROM  `tbl` WHERE  `role_id` ='$rid'";
     $fetch1=mysql_query($query);
     $result=mysql_fetch_assoc($fetch1);
     $unid=$result["uniqueid"];
     if( $unid != $sid )
     header('location:login.php');
     
  }
  
  $vid=$_REQUEST['user'];
	$qry="SELECT *  FROM `tbl` WHERE `id` = $vid";
	$raw=mysql_query($qry);
	$res=mysql_fetch_assoc($raw);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="1380;url=logout.php" />
<link rel="stylesheet" type="text/css" href="style-sheet.css">
<title>view user</title>
</head>
<h1><a id="padanchor"  href="logout.php">LOGOUT</a></h1>
<body>
<center>
<div id="adminuser" name="adminuser" class="fetch"> 
<br/>
<div>
<h2><?php echo $res["name"];?></h2>
<div id="loggedinbox">
<div > <td > Email:&nbsp<?php echo $res["email"];?> </td> </div><br/>
<div > <td > Gender:&nbsp<?php echo $res["gender"];?> </td> </div><br/>
<div > <td > PhoneNo:&nbsp<?php echo $res["mobile"];?> </td> </div>
</div>
</div>
</div>
</center>
</body>
</html>
