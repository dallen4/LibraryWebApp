
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>User Login</title>
  <link rel="stylesheet" type="text/css" href="main.css"/>  
</head>

<body>

    

	<ul>
		//include new user signin as a link//
		
<li><a href="newUser.php">Not a member? Click here to sign up!</a></li>
 </ul>
    
    <form action="checkPwd.php" method="post">

	<div id="content">
    <h1>Welcome to our library!</h1>  

	<?php if (!empty($error_message)) 
	include('error.html.php');
   ?>

	<div><label>User Type: </label>
	 <select name="usertype">
	   
       <option value= "member">I'm a member</option>
       <option value= "administrator">I'm an administrator</option>   
   </select> <br /><br />
  </div> 

        <div id="data">
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
</body>
</html>

