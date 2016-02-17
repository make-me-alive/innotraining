<?php 

require_once 'connection.php'; 
   
if(!empty($_POST))
{ 

    $name=$_POST["name"]; $email=$_POST["email"];$temp = split("@",$email);$username=$temp[0];
    $gender=$_POST["gender"]; $mobile=$_POST["mobile"];$password=$_POST["password"];
    $encpassword=md5($password);$cpassword=$_POST["confirmpass"];  $chars = '/^[a-zA-Z. ]+$/';
    $mno='/^[0-9]+$/';$pwc = '/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/';
    $rmail ='/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/';
    $ml= strlen($mobile);$nl= strlen($name);


 if(isset($_POST["submit"]))
   {	
	    if (!preg_match($chars,$name) ) {
	    header('Refresh:8; url=registration.php');
	    $arr[0]="name may contain alphabets and spaces only";
	    }
	    if (($nl<5) || ($nl>12) ) {
	    header('Refresh:8; url=registration.php');
	   	$arr[1]="name cannot be less than 5 and greater than 12";
	    }
	    if (!preg_match($rmail,$email)) {
	    header('Refresh:8; url=registration.php');
	    $arr[2]="email should be valid";
	    }
	    if($gender == null) {
	    header('Refresh:8; url=registration.php');
	    $arr[3]="gender cannot be empty";
	    }

	    if (!preg_match($mno,$mobile)) {
	    header('Refresh:8; url=registration.php');
	    $arr[4]="insert valid mobile no only";
	    }
	    if (($ml<10) || ($ml>10) ) {
	    header('Refresh:8; url=registration.php');
	    $arr[5]="mobile no cannot be less than 10 digits or greater";
	    }
	    if(!preg_match($pwc,$password)) {
	    header('Refresh:8; url=registration.php');
	    $arr[6]="enter password in the correct format";
	    } 
	    if ($cpassword != $password) {
	    header('Refresh:8; url=registration.php');
	    $arr[7]="enter the same password as above";
	    }
	}
     
	if(empty($arr))
	{
			
		 function insertdata($name,$username,$email,$gender,$mobile,$encpassword) {
	     $qry="INSERT INTO `tbl` (`id`, `name`, `email`, `username`,`gender`, `mobile`, 
	     `encpassword`,`uniqueid`,`timeid`,`role_id`)VALUES (NULL,'$name','$email',
	     '$username','$gender', '$mobile', '$encpassword','','','0')";
		 mysql_query($qry);
		 return true;
		 }

			
		   $all="SELECT * FROM  `tbl` WHERE  `email`='$email'";
		   $attain=mysql_query($all);
		   $check=mysql_fetch_assoc($attain); 


	       if($check["email"] == $email)
		   {
		   header('Refresh:5; url=registration.php');
		   $msg[0] = "email already in use please register again with another email-id";
		   }

		else 
		{
             
			$foruser = split("@",$email);
			$repeatinguser=$foruser[0];
			$us="SELECT *  FROM `tbl` WHERE `username` = '$username'";
            $convus=mysql_query($us);
            $detailcheck=mysql_fetch_assoc($convus);
            
            

	        if($repeatinguser == $detailcheck["username"])
	        {  
	        	
	           $count = "SELECT MAX(id) FROM `tbl`";
	           $maximum = mysql_query($count);
	           $v = mysql_fetch_row($maximum);
			   $id_value = $v[0];
			   $id_value++;
			   $repeatinguser="{$id_value}{$repeatinguser}";
			   $ups=$qry="INSERT INTO `tbl` (`id`, `name`, `email`, `username`,`gender`, `mobile`, 
		       `encpassword`,`uniqueid`,`timeid`,`role_id`)VALUES (NULL,'$name','$email',
		       '$repeatinguser','$gender', '$mobile', '$encpassword','','','0')";
			   $convus=mysql_query($ups);
			   header('Refresh:10; url=login.php');
	           $msg[1] = "Successfully registered";
	           $msg[2]="an email has been sent to your registered email-id"."<br>"."Plz log in with the same credentials".
	           "<br>"."the page is being transferred plz wait"."<br>"."thankyou for registration";
	           
	        }
           
	        else
			{  
			    $resource = insertdata($name,$username,$email,$gender,$mobile,$encpassword);

			    if($resource)
			    {
			    header('Refresh:10; url=login.php');
				$msg[1] = "Successfully registered";
				$msg[2]="an email has been sent to your registered email-id"."<br>"."Plz log in with the same credentials".
	             "<br>"."the page is being transferred plz wait"."<br>"."thankyou for registration";
			    }
				else
			    {
			    header('Refresh:2; url=registration.php');
				$msg[3] = "Could not process";
		       
			    }
	        }
	
	        if(!empty($msg[1]) )
	        {
	           $to=$email;
			   $subject="successfully registered to innotraining";
			   $message="your username for login is:$repeatinguser<br/>";
			   $from="From :innotrainning@drupal.com ";
			   mail($to,$subject,$message,$from);
	        }

        }
	} 
}	

?>


<!DOCTYPE HTML>
<html>
	<head> 
	<title>registration panel</title>  
	<meta charset="UTF-8">  
	<link rel="stylesheet" type="text/css" href="style-sheet.css">
	<script type="text/javascript" src="functionof.js">  </script> 
	</head>
	
<!-- <h1 > -->
<table id="header" width="100%"><tr><td onclick="window.location.href='registration.php'" id="logologin"></td> 
<td><a  id="padanchor" href="login.php">LOGIN</a></td></tr></table>
<!-- </h1> -->
 
<body>
<center>
             
<form  name="myfrm" action="registration.php" method="POST">

 <div id="registration" name="registration">

<h2 id="move" > Register Here</h2>

<div class="padding"> <td> <input type="text"  name="name"  id="name"placeholder="Enter your name"
      oninput="n()" onblur="on()"> </td> </div>


<div class="padding"> <td> <input type="text" name="email" id="email" placeholder="Enter your email"
	 oninput="e()" onblur="oe()"> </td> </div>

<div class="padding"> 
<div class="gender-text" > 
<td class="gender"> <span>Gender :</span>

<label id="padding4gender"> 
<input class="none"type="radio" name="gender" value="male" id="male"
placeholder="Male" > <label for="male">Male</label>

<input class="none" type="radio" name="gender" value="female" id="female"placeholder="Female" >
<label for="female">Female</label> 
</label>
</td>
</div>
</div>


<div class="padding">
	<td> 
	<input type="text" name="mobile" id="mobnum" 
	placeholder="Enter your phone.no."  oninput="nu()" onblur="onu()">
	</td>

</div>

<div  class="padding">
<td>
	<input type="password" name="password" id="password" 
	placeholder="Create a password" oninput="p()" onblur="op()">
</td>
</div>

<div class="padding">
<td>
	<input type="password" name="confirmpass" id="confirmpass" 
	placeholder="Confirm password"  oninput="cp()" onblur="ocp()">
</td>
</div>

<div class="padding">
<td>
<input id="button" type="submit" name="submit" value="Complete Sign-Up" 
onclick=" return validation()" >
</td>
</div>
<?php
foreach ($arr as $value) 
echo $value."<br/>";

foreach ($msg as $value) 
echo $value."<br/>";

?> <br/>
<label id="e1" > </label> <label id="p1" > </label><label id="m1" > </label> 
<label id="n1" > </label> <label id="c1" > </label>
</div>
</form>
</center>	
</body>
</html>

