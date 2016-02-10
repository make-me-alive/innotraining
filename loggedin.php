<?php
session_start();
    
    // if(isset($_SESSION["aid"]))
    // {
    // unset($_SESSION["sid"]);    
    // header("location:userlist.php");
    // }
    if(isset($_SESSION["sid"]) && isset($_SESSION["rid"]))
       { 
             // unset($_SESSION["sid"]);
                          // unset($_SESSION["aid"]);
         // session_destroy();  
         header("location:userlist.php");
       }

    if(!isset($_SESSION["sid"]))
    {
	   $_SESSION["msg"]="You need to login first";	
	   header("location:login.php");
	  }
     
     if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1380))
     header("location:logout.php");
     $_SESSION['LAST_ACTIVITY'] = time();
     
$conn=mysql_connect("localhost","root","password1");
mysql_select_db("tbl_user",$conn);

$sid=$_SESSION["sid"];
// print_r($sid);
$qry="SELECT * FROM  `tbl` WHERE  `uniqueid` =  '$sid' ";
$raw=mysql_query($qry);
$res=mysql_fetch_assoc($raw);
?>


<!-- $qry="SELECT *  FROM `tbl` WHERE `id` = $sid"; -->


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style-sheet.css">
<title>logged-in</title>
</head>
<h1>
<div ><a id="padanchor" href="logout.php">LOGOUT</a></div> 
</h1>
<body>
<center>

<div id="adminuser" name="loggedin" class="fetch"> 
      <br/>
        <div>
            <h2>Welcome <span ><?php echo $res["name"];?></span></h2>
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

  