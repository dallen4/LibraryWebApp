<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Admin reset password</title>
  <link rel="stylesheet" type="text/css" href="main.css"/>  
   
</head>

<body>
    <div id="content">
    <h1>Admin reset password</h1>  

	<?php if (!empty($error_message)) 
	include('error.html.php');

	$username = $_COOKIE['mycookie'];
    
   ?>

    
    <form action="processAminPwd.php" method="post">

        <div id="data">
		
		<label>UserName:</label>
		<input type="text" name="username" value = "<?php echo $username; ?>" readonly="true"/> <br />
        
		<label>Password:</label>
		  <input type="password" name="password" value = "<?php echo $password; ?>"/><br />   
		   
		
        </div>

        <div id="buttons">
		
            <input type="submit" value="Reset"></div>
            
        </div>

    </form>
    </div>
</body>
</html>
