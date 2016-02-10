<?php 

   $conn=mysql_connect("localhost","root","password1");
   mysql_select_db("tbl_user",$conn);
if(!empty($_POST))
{ 

    $name=$_POST["name"]; $email=$_POST["email"];$temp = split("@",$email);$username=$temp[0];
    $gender=$_POST["gender"]; $mobile=$_POST["mobile"];$password=$_POST["password"];
    $encpassword=md5($password);$cpassword=$_POST["confirmpass"];  $chars = '/^[a-zA-Z. ]+$/';
    $mno='/^[0-9]+$/';$pwc = '/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/';
    $rmail ='/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/';$ml= strlen($mobile);$nl= strlen($name);
   	$cnl=0;$mnl=0;$cpl=0; 

 if(isset($_POST["submit"]))
   {	
	    if (!preg_match($chars,$name) )
	    {
	    header('Refresh:8; url=registration.php');
	     $en="name may contain alphabets and spaces only";
	     $err="ERRORS"; 
	    }
	    if (($nl<5) || ($nl>12) )
	    {
	    header('Refresh:8; url=registration.php');
	    $enl="name cannot be less than 5 and greater than 12";
	    $cnl=1;
	    $err="ERRORS";
	    }
	    if (!preg_match($rmail,$email))
	    {
	    header('Refresh:8; url=registration.php');
	    $em="email should be valid";
	    $err="ERRORS";
	    }
	    if($gender == null)
	    {
	    header('Refresh:8; url=registration.php');
	    $eg="gender cannot be empty";
	    $err="ERRORS";
	    }
	    if (($ml<10) || ($ml>10) )                             
	    { 
	    header('Refresh:8; url=registration.php');
	    $eml="mobile no cannot be less than 10 digits or greater";
	    $mnl=1;
        $err="ERRORS";
	    }
	    if(!preg_match($pwc,$password))
	    {
	    header('Refresh:8; url=registration.php');
	    $ep="enter password in the correct format";
	     $err="ERRORS";
	    } 
	    if ($cpassword != $password)
	    {
	    header('Refresh:8; url=registration.php');
	    $epc="enter the same password as above";
	    $cpl=1;
	    $err="ERRORS";
	    }
	   if( ($cpassword = $password) && preg_match($chars,$name) && preg_match($rmail,$email)
	   	&& preg_match($pwc,$password) && ($cnl == 0) && ($mnl == 0) && ($cpl== 0) )
       $value =true;  
    
    }
      
    //  isset($_POST["submit"])
	if($value == true)
	{
			
	 function insertdata($name,$username,$email,$gender,$mobile,$encpassword)
			{	
		        $qry="INSERT INTO `tbl` (`id`, `name`, `email`, `username`,`gender`, `mobile`, `encpassword`,`uniqueid`,`role_id`)
		         VALUES (NULL,'$name','$email','$username','$gender', '$mobile', '$encpassword','','0')";
				mysql_query($qry);
				return true;
			}

			
           $all="SELECT * FROM  `tbl` WHERE  `email`='$email'";
		   $attain=mysql_query($all);
		   $check=mysql_fetch_assoc($attain); 


	   if($check["email"] == $email)
	   {
	   header('Refresh:5; url=registration.php');
	   $var = "email already in use please register again with another email-id";
	   }

		else 
		{
             // $count=mysql_num_rows($raw);
			$foruser = split("@",$email);
			$repeatinguser=$foruser[0];
			$us="SELECT *  FROM `tbl` WHERE `username` = '$username'";
            $convus=mysql_query($us);
            $detailcheck=mysql_fetch_assoc($convus);
            
            // $count="0";

	            if($repeatinguser == $detailcheck["username"])
	            {  
	            	
	               $count = "SELECT MAX(id) FROM `tbl`";
                   $maximum = mysql_query($count);
                   $v = mysql_fetch_row($maximum);
				   $id_value = $v[0];
				   $id_value++;
				   $repeatinguser="{$id_value}{$repeatinguser}";
				   $ups="INSERT INTO `tbl` (`id`, `name`, `email`, `username`,`gender`, `mobile`, `encpassword`,`uniqueid`,`role_id`)
		         VALUES (NULL,'$name','$email','$repeatinguser','$gender', '$mobile', '$encpassword','','0')";
				   $convus=mysql_query($ups);
				   header('Refresh:10; url=login.php');
	               $var = "Successfully registered";
	               $output="an email has been sent to your registered email-id"."<br>"."Plz log in with the same credentials".
	               "<br>"."the page is being transferred plz wait"."<br>"."thankyou for registration";
	               
	            }
                else
				{  
				   $resource = insertdata($name,$username,$email,$gender,$mobile,$encpassword); 
					   
					
				    if($resource)
				    {
				    header('Refresh:10; url=login.php');
					$var = "Successfully registered";
					$output="an email has been sent to your registered email-id"."<br>"."Plz log in with the same credentials".
	                 "<br>"."the page is being transferred plz wait"."<br>"."thankyou for registration";
				    }
					else
				    {
				    header('Refresh:2; url=registration.php');
					$var = "Could not process";
			       
				    }
                }
		
	            if($var === "Successfully registered" )
	            {
	               $to=$email;
				   $subject="successfully registered to innotraining";
				   $msg="your username for login is:$repeatinguser<br/>";
				   $from="From :innotrainning@drupal.com ";
				   mail($to,$subject,$msg,$from);
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
            <h1><div ><a  id="padanchor" href="login.php">LOGIN</a></div>	</h1>
<body>
<center>
            <form  name="myfrm" action="registration.php" method="POST">
             
             <div id="registration" name="registration">
            <h2> Register Here</h2>

				<div class="padding">
					<td> 
					     <input type="text"  name="name" size="12" id="name" 
					     placeholder="Enter your name" oninput="n()" onblur="on()">

				    </td> 
				</div>


			  <div class="padding">
				    <td> 
						<input type="text" name="email" id="email" placeholder="Enter your email"
						 oninput="e()" onblur="oe()">
    
					</td>
			  </div>
				

			<div class="padding">

					<div class="gender-text" >
						
							<td class="gender">Gender :
							
							<input class="none"type="radio" name="gender" value="male" id="male" 
							placeholder="Male" > 
							<label for="male">Male</label>
							
							<input class="none" type="radio" name="gender" value="female" id="female" 
							placeholder="Female" > 
							<label for="female">Female</label> 
							</td>
						
					</div>

			</div>


			<div class="padding">
				
				<td> 
				<input type="number" name="mobile" id="mobnum" 
				placeholder="Enter the 10 digit no only"  oninput="nu()" onblur="onu()">
				</td>

			</div>
				


			<div  class="padding">
				
				<td>
					<input type="password" name="password" id="password" 
					placeholder="Enter your password" oninput="p()" onblur="op()">
				</td>

			</div>
				

			<div class="padding">

				<td>
					<input type="password" name="confirmpass" id="confirmpass" 
					placeholder="Enter the same password"  oninput="cp()" onblur="ocp()">
				</td>

			</div>

	<div class="padding">
	<td>
	<input id="button" type="submit" name="submit" value="complete sign up" onclick=" return validation()" >
	  <!--onclick="validate(form)"  -->
	</td>
	</div>
	<?php if(!empty($err)||!empty($var))
				{echo $err; echo "<br/>";echo $var;echo "<br/>";echo $output;echo "<br/>";echo $en; echo "<br/>"; 
				echo $enl; echo "<br/>"; echo $em; echo "<br/>"; echo $eg; echo "<br/>"; echo $eml;
				 echo "<br/>"; echo $ep; echo "<br/>"; echo $epc; }
			 ?> <br/>

	<label id="e1" > </label> 
	<label id="p1" > </label>
	<label id="m1" > </label> 
	<label id="n1" > </label> 
	<label id="c1" > </label>
  </div>
    </form>
</center>	
</body>
</html>

