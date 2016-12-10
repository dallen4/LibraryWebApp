
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head background="Library-Postcard-004_2.jpg">
  <title>User Login</title>
  <link rel="stylesheet" type="text/css" href="main.css"/>  
</head>

<body >

<div id="content"> 

<ul>
<li><a href="newUser.php">Not a member? Sign up!</a></li>
</ul>
    <h1>Welcome to our library!</h1>  
     <hr/>
	
<h2>Enter your username and password to login or register as a new member</h2>  
<div class="formarea">
<?php if (!empty($error_message)) 
	include('error.html.php');
   ?>
  <form action="checkPwd.php" method="post">   
  
	
	<label>User Type: </label>
	<div id="data">
	 <select name="usertype" >	   
       <option value= "member">I'm a member</option>
       <option value= "administrator">I'm an administrator</option>   
   </select></br></br>
     
		<label>UserName:</label>
		<input type="text" name="userlogin" id = "userlogin"/> <br />  
        
		<label>Password:</label>
		  <input type="password" name="userpwd" id = "userpwd"/><br />   
		
        </div>
   
        <div id="buttons">		
            <input type="submit" value="Login"></div>            
        </div>
    </form>
   </div> 
  

   
  </div>
 <div id="footer">
            <p class="copyright">
                &copy; <?php echo date("Y"); ?> Ourlibrary.com
            </p>
        </div>
   
    </body>
</html>

