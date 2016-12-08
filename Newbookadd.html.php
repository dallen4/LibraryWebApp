<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>adding a book to the library</title>
  <link rel="stylesheet" type="text/css" href="main.css"/>

</head>

<body>
    <div id="content">
    <h1>Add a Book</h1>

	<?php if (!empty($error_message))
	include('error.html.php');
   ?>


    <form action="processAddbook.php" method="post">

        <div id="data">

		<label>ISBN:</label>
		<input type="text" name="ISBN" value = "<?php echo $ISBN; ?>"/> <br />

		<label>Book tilte:</label>
		  <input type="text" name="bookTitle" value = "<?php echo $booktitle; ?>"/><br />
		<label>Author:</label>
		  <input type="text" name="Author" value = "<?php echo $author; ?>"/><br />
		<label>Published Date:</label>
		  <input type="text" name="PublishedDate" value = "<?php echo $publisheddate; ?>"/><br />
      <label>Published Date:</label>
  		  <input type="text" name="Publisher" value = "<?php echo $publisher; ?>"/><br />
		 <label>Keywords:</label>
		  <input type="text" name="keywords" value = "<?php echo $keywords; ?>"/><br />
         <label>Number of Copies:</label>
		  <input type="number" name="copyCount" value = "<?php echo $copyCount; ?>"/><br />

        </div>

        <div id="buttons">

            <input type="submit" value="Add a book!"></div>

        </div>

    </form>
    </div>
</body>
</html>
