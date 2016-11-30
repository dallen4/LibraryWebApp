<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>List of Book Available</title>
<style>
table,th,td
{
border:1px solid black;
padding:5px;
}
</style>
</head>
<body>
<p><a href="?checkbooks">Check your books</a></p>
<p>Here are all the books can be borrowed right now:</p>

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
		   <form action="?borrow" method="post">
		    <input type="hidden" name = "bookid" value ="<?php echo $booklist['BookID'];?>">
			<input type="submit" value="Borrow">
			</form>
		</td>
		</tr>
		<?php endforeach;?>
		</table>

<ul>
<li><a href="index.php">Go back to the homepage</a></li>
 </ul>

		</body>
	</html>
		 
	    



