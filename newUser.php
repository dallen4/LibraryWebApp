
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>New user sign up</title>
  <link rel="stylesheet" type="text/css" href="main.css"/>  
   
</head>

<body>
    <div id="content">
    <h1>New user sign up</h1>  

	<?php if (!empty($error_message)) 
	include('error.html.php');
   ?>

    
    <form action="processNewUser.php" method="post">

        <div id="data">
	
		<label>UserName:</label>
		<input type="text" name="username" value = "<?php echo $username; ?>"/> <br />  
        
		<label>Password:</label>
		  <input type="password" name="password" value = "<?php echo $password; ?>"/><br />   
		<label>Address:</label>
		  <input type="text" name="address" value = "<?php echo $address; ?>"/><br />  
		<label>City:</label>
		  <input type="text" name="city" value = "<?php echo $city; ?>"/><br /> 
		 <label>State:</label>
		  <input type="text" name="state" value = "<?php echo $state; ?>"/><br /> 
         <label>Zipcode:</label>
		  <input type="text" name="zipcode" value = "<?php echo $zipcode; ?>"/><br /> 
		  <label>Phonenumber:</label>
		  <input type="text" name="phonenumber" value = "<?php echo $phonenumber; ?>"/><br />         
		
        </div>

        <div id="buttons">
		
            <input type="submit" value="Sign Up!"></div>
            
        </div>

    </form>
    </div>
</body>
</html>


