
// window.confirm("all fields  mandatory");

function validation()
{   
     
    if (document.getElementById('name').value == "")

    {   alert("The name cannot be empty");
        document.getElementById('name').focus();
        document.getElementById('name').style.background = 'Yellow';
        return false;
    } 
    
    if ((document.getElementById('name').value.length < 5) || (document.getElementById('name').value.length > 12))
     {  alert("The name is of wrong length"); 
         document.getElementById('name').focus();
         document.getElementById('name').style.background = 'Yellow';
         return false;
     } 
    
    var user = document.getElementById('name').value;
    var chars = /^[a-zA-Z. ]+$/; 
    if (!user.match(chars)) 
    {   alert("The name may contain only alphabets and spaces");
        document.getElementById('name').focus();
        document.getElementById('name').style.background = 'Yellow';
        return false;
    } 


    var y = document.getElementById('email').value;
    if (!y.match(/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/))
    {
        alert("pls insert valid email-id only");
        document.getElementById('email').focus();
        document.getElementById('email').style.background = 'Yellow';
        return false;
    } 


    var x=document.getElementById('email').value;  
    var atposition=x.indexOf("@");  
    var dotposition=x.lastIndexOf(".");
    if (atposition<= 6 || dotposition<atposition+2 || dotposition+2>=x.length)
    {  

        
        alert("Please enter a valid e-mail address \n atpostion:"+atposition+"\n dotposition:"+dotposition);  
        document.getElementById('email').focus();
        document.getElementById('email').style.background = 'Yellow';
        return false;
    }   
        
    var genderM=document.getElementById('male')
    var genderF=document.getElementById('female')

    if(genderM.checked==false && genderF.checked==false )
    {   
        
        alert("You must select male or female");
        document.getElementById('female').focus();
         return false;
    }       
    
    if (document.getElementById('mobnum').value == "" || document.getElementById('mobnum').value == null) 
    {
            alert("Please enter your Mobile No.");
            document.getElementById('mobnum').focus();
            document.getElementById('mobnum').style.background = 'Yellow';
            return false;
    }
    if (document.getElementById('mobnum').value.length < 10 || document.getElementById('mobnum').value.length > 10) 
    {
            alert("Mobile No. is not valid, Please Enter 10 Digit Mobile No.");
            document.getElementById('mobnum').focus();
            document.getElementById('mobnum').style.background = 'Yellow';
            return false;
    }
    var m= document.getElementById('mobnum').value;
    var regex=/^[0-9]+$/;
    if ( !m.match(regex))
    {
        alert("pls insert numbers only");
        document.getElementById('mobnum').focus();
        document.getElementById('mobnum').style.background = 'Yellow';
        return false;
    }
    
    var pw = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;

    if( !document.getElementById('password').value.match(pw))  
      {  
          alert("enter password");  
          document.getElementById('password').focus();
          document.getElementById('password').style.background = 'Yellow';
          return false;  
      }

    var pass1 = document.getElementById('confirmpass').value;
    var pass2 = document.getElementById('password').value;
    if (pass1 != pass2)
     {
        alert("Passwords Do not match");
        document.getElementById('confirmpass').focus();
        document.getElementById('confirmpass').style.background = 'Yellow';
        return false; 
     }
     

    else
    {
       var success= alert("form being processed !!!");
       success=1;
    }
}


function n()
{   
    document.getElementById("n1").innerHTML = "name should contain alphabets and spaces only";        
}
function on()
{   
    document.getElementById("n1").innerHTML = "";
}
function e()
{ 
    document.getElementById("e1").innerHTML = "enter a valid email id with '@'' and '.' with minimum 7 characters";
}
function oe()
{   
    document.getElementById("e1").innerHTML = "";
}
function nu()
{ 
    document.getElementById("m1").innerHTML = "ten digit mobile number only";
   
}
function onu()
{   
    document.getElementById("m1").innerHTML = "";
}

function p()
{ 
document.getElementById("p1").innerHTML = "password should contain 1 upper case,1 lower case,1 fullstop,and minimum 6 characters";
}
function op()
{   
    document.getElementById("p1").innerHTML = "";
}

function cp()
{ 
    document.getElementById("c1").innerHTML = "enter the same password as above";
    
}
function ocp()
{   
    document.getElementById("c1").innerHTML = "";
}  
       
  