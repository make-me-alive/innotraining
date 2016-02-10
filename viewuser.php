<?php
session_start();
 // include("userlist.php");
 
    if ($_GET['user'] != "" && !isset($_SESSION["sid"])) 

    {
      //  if(!isset($_SESSION["aid"]))
      // {  
       $_GET['user']= "";
       // unset($uid[$count]);
       session_destroy(); 
       $_SESSION["msg"]="You need to login first";  
       header("location:login.php");
      // }
    } 

    

$conn=mysql_connect("localhost","root","password1");
mysql_select_db("tbl_user",$conn);

    if(isset($_SESSION["sid"]))
    {   


       $sid=$_SESSION["sid"];
       $rid=$_SESSION["rid"];
       $query="SELECT uniqueid FROM  `tbl` WHERE  `role_id` ='$rid'";
       $fetch1=mysql_query($query);
       $result=mysql_fetch_assoc($fetch1);
       $uid=$result["uniqueid"];
       if( $uid != $sid )
       {
         header('location:login.php');
       }
       
    }
$vid=$_REQUEST['user'];
// $_SESSION["sid"]=$sid;     
// print_r($sid);
// $_SESSION["sid"]['']  
// print_r($sid);
// $_GET[$uid];

$qry="SELECT *  FROM `tbl` WHERE `id` = $vid";
$raw=mysql_query($qry);
$res=mysql_fetch_assoc($raw);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style-sheet.css">
<title>view user</title>
</head>
<h1>
<div ><a id="padanchor"  href="logout.php">LOGOUT</a></div> 
</h1>
<body>
<center>
<div id="adminuser" name="adminuser" class="fetch"> 
      <br/>
        <div>
            <h2><?php echo $res["name"];?></h2>
                <div id="loggedinbox">
                      <div > <td > Email:&nbsp<?php echo $res["email"];?> </td> </div><br/>
                      <div  > <td > Gender:&nbsp<?php echo $res["gender"];?> </td> </div><br/>
                      <div  > <td > PhoneNo:&nbsp<?php echo $res["mobile"];?> </td> </div>
                </div>
        </div>
</div>
</center>

<!-- id="left"
id="leftagain" -->
<?php
print_r ($_SESSION);

?>
</body>
</html>
