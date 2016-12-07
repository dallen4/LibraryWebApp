<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>adding a book to the library</title>
  <link rel="stylesheet" type="text/css" href="main.css"/>  
   
</head>

<body>
    <div id="content">
    <h1>Add a book</h1>  

	<?php if (!empty($error_message)) 
	include('error.html.php');
   ?>

    
    <form action="processAddbook.php" method="post">

        <div id="data">
	
		<label>ISBN:</label>
		<input type="text" name="username" value = "<?php echo $ISBN; ?>"/> <br />  
        
		<label>Book tilte:</label>
		  <input type="text" name="book title" value = "<?php echo $booktitle; ?>"/><br />   
		<label>Author:</label>
		  <input type="text" name="Author" value = "<?php echo $author; ?>"/><br />  
		<label>Published Date:</label>
		  <input type="text" name="Published Date" value = "<?php echo $publisheddate; ?>"/><br /> 
		 <label>Keywords:</label>
		  <input type="text" name="keywords" value = "<?php echo $keywords; ?>"/><br /> 
         <label>BookID:</label>
		  <input type="text" name="BookID" value = "<?php echo $bookid; ?>"/><br /> 
		  <label>Shelf Number:</label>
		  <input type="text" name="Shelf Number" value = "<?php echo $shelfnumber; ?>"/><br />  
        	
        </div>

        <div id="buttons">
		
            <input type="submit" value="Add a book!"></div>
            
        </div>

    </form>
    </div>
</body>
</html>


