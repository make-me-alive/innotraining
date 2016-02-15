<?php
session_start();

if(isset($_SESSION["sid"])) {
if(isset($_SESSION["sid"]) && isset($_SESSION["rid"]))
header("location:userlist.php");
header("location:loggedin.php");
}

require_once 'connection.php';

if(isset($_GET["add"]) && $_GET["add"]==334)
{
	 $username=$_POST["username"];
	 $password=$_POST["password"];
	 $encpassword=md5($password);
     $qry= " SELECT `uniqueid`, `timeid`FROM `tbl` WHERE `username` = '$username' 
     AND `encpassword` = '$encpassword' ";
	 $fetch=mysql_query($qry);
	 $res=mysql_fetch_assoc($fetch);
     $uid=$res["uniqueid"];
     $tid =$res["timeid"];
     $now =time();

	 if (!empty($tid) && !empty($uid)){
	 	if ($now - $tid > 1400 ){	
	    $qry= "  UPDATE `tbl` SET `uniqueid`= '',`timeid`= '' WHERE `uniqueid`= '$uid'   ";
	    $fetch=mysql_query($qry);
	    session_destroy();

	    $_SESSION["msg"]="you didnot log out the previous time.log-in again with the same credentials to enter";
	    header("location:login.php");
	 	}
	 	$_SESSION["msg"]="the current username is logged in.pls log out first"; 
		header("location:".$_SERVER['PHP_SELF']);
		exit();
	    }
 

else{
         $qry="SELECT role_id  FROM `tbl` WHERE `username` = '$username' AND `encpassword` = '$encpassword'";
		 $fetch=mysql_query($qry);
		 $count=mysql_num_rows($fetch);
		 $adminres=mysql_fetch_assoc($fetch);
         
	         if($adminres['role_id'] == 1 || $adminres['role_id'] == 2 )
	         {
	            
	            if(isset($_SESSION["sid"]))
				header("location:loggedin.php");
			    else{
			        $user_id=session_id();
			        $user_time= time();
					$qry="UPDATE `tbl` SET `uniqueid`='$user_id',`timeid`='$user_time' WHERE 
					`username` = '$username' AND `encpassword` = '$encpassword'";
			        $fetch=mysql_query($qry);
			        $_SESSION["sid"]=$user_id;
			        $_SESSION["rid"]=$adminres['role_id'];
	                $_SESSION['LAST_ACTIVITY']=$user_time;
			        header('Refresh:2; url=userlist.php');
			        $var = "You are being redirected"."<br>"."Welcome 2 ADMIN panel";
		           }
	         }
	         
	        else
	        {
				 $qry= "SELECT *  FROM `tbl` WHERE `username` = '$username' AND `encpassword` = '$encpassword'";
				 $fetch=mysql_query($qry);
				 $count=mysql_num_rows($fetch);
				 $res=mysql_fetch_assoc($fetch);
				        if($count>0) {
					  	if(isset($_SESSION["rid"]))
						header("location:userlist.php");
					    if(isset($_SESSION["sid"]))
					    header("location:loggedin.php");
						else{                            
						$user_id=session_id();
						$user_time= time();
						$qry="UPDATE `tbl` SET `uniqueid`='$user_id',`timeid`='$user_time' WHERE 
					    `username` = '$username' AND `encpassword` = '$encpassword'";
		                $fetch=mysql_query($qry);
		                $_SESSION["sid"]=$user_id;
		                $_SESSION['LAST_ACTIVITY'] = $user_time;
						header("location:loggedin.php");
					    }  
			            }
						else
						{
							$_SESSION["msg"]="Invalid Username / Password";
							header("location:".$_SERVER['PHP_SELF']);  
							exit();
						}
			}		 
    } 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="style-sheet.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login Panel</title>
</head>
<body>
<h1><a id="padanchor" href="registration.php">REGISTER</a></h1>
<center>
	<div id="login" name="login"> 
		  <form  name="myfrm" action="<?php echo $_SERVER['PHP_SELF'];?>?add=334" method="POST">     
		 
	<h2 id="move">Login</h2>

	<div class="padding">
		<td> 
		     <input type="text"  name="username"  id="username" 
		     placeholder="Type in your username"  >

	    </td> 
	</div>

<div  class="padding">
	
	<td>
		<input type="password" name="password" id="password" 
		placeholder="Type in  your password" >
	</td>

</div>
						
	<div class="padding">
		
	<td>
	<input id="button" type="submit" name="log-in" value="Login" >
	</td>
	<br />
<?php

if(isset($_SESSION["msg"]))
 {
	echo $_SESSION["msg"];
	echo "<br/>";
	echo "try again with valid credentials"; 
	unset($_SESSION["msg"]); 
 }
 else if(!empty($var))
 {
   echo $var;
 }
?>
    
</div>
</form>
</div>
</center>
</body>
</html>