
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>Admin Control Panel</title>
<style>
table,th,td
{
border:1px solid black;
padding:5px;
}
</style>
</head>
<body>

<p>Here is all of the library's inventory:</p>

<table>
<?php foreach($result as $booklist):?>
	<tr>
	<td><?php echo $booklist['BookID'];?></td>
	 <td><?php echo $booklist['ISBN'];?></td>
	  <td style="width:150x"><?php echo $booklist['title'];?></td>
	   <td><?php echo $booklist['Author'];?></td>
	    <td><?php echo $booklist['PublishedDate'];?></td>
		 <td><?php echo $booklist['KeyWords'];?></td>
		  <td><?php echo $booklist['ShelfNumber'];?></td>
		   <td><?php echo $booklist['BookStatus'];?></td>
		   <td>
		   <form action="?Delete" method="post">
		    <input type="hidden" name = "bookid" value ="<?php echo $booklist['BookID'];?>">
			<input type="submit" value="Delete">
			</form>
		</td>
		</tr>
		<?php endforeach;?>
		</table>

<ul>
<li><a href="index.php">Go back to the homepage</a></li>
<li><a href="AddABook.php">Add a New Book to Our Library</a></li>
<li><a href="AddACopy.php">Add a Copy of an Existing Book to Our Library</a></li>


 </ul>

		</body>
	</html>
	
	
