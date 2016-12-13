<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Add Book</title>
  <link rel="stylesheet" type="text/css" href="../main.css"/>  
   
</head>

<body>
    <div id="content">
<ul>
<li><a href="../index.php">Home</a></li>
<li><div class="line"></div></li>
<li><a href="links.php">Admin Control panel</a></li>
</ul>
    <h2>Add Book</h2>  

	<?php if (!empty($error_message)) 
	include('error.html.php');
   ?>

   <div  class="formarea">
   <form action="processAddbook.php" method="GET">

        <div id="data">
		<label>ISBN:</label>
		<input type="text" name="ISBN" value = "<?php echo $ISBN; ?>"/>  <br /> 

		<label>Book tilte:</label>
		  <input type="text" name="bookTitle" value = "<?php echo $booktitle; ?>"/> <br /> 
		
	  <label>Author:</label>
		  <input type="text" name="Author" value = "<?php echo $author; ?>"/> <br /> 
		
	  <label>Published Date:</label>
		  <input type="text" name="PublishedDate" value = "<?php echo $publisheddate; ?>"/> <br /> 
     
	  <label>Publisher:</label>
  		  <input type="text" name="Publisher" value = "<?php echo $publisher; ?>"/> <br /> 
	  
	  <label>Keywords:</label>
		  <input type="text" name="keywords" value = "<?php echo $keywords; ?>"/> <br /> 

	  <label>Copy Count:</label>
		  <input type="number" name="copyCount" value = "<?php echo $copyCount; ?>"/> 
	  
	   <label>Category: </label>	
		<select name="category" >	   
       <option value= "Computer">Computer</option>
       <option value= "Literature">Literature</option> 
	   <option value= "Children">Children</option>
       <option value= "Education">Education</option>   
   </select><br /> 

        </div>

        <div id="buttons">

            <input type="submit" value="Add"></div>

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


