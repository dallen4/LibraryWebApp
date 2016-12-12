<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>List of Book Available</title>
<link rel="stylesheet" type="text/css" href="main.css"/>  
</head>

<body>
<div id="content">
<ul>
<li><a href="index.php">Home</a></li>
<li><div class="line"></div></li>
<li><a href="?checkbooks">Check Books</a></li>
<li><div class="line"></div></li>
<li><a href="?account">My account</a></li>
</ul>

 <div class="formarea">
 <form action="?" method="post">
		<input type="text"  name="Searchtext" id = "Searchtext"/>
<input type="submit" value="search"></div>    


<h2>Borrow a book here:</h2>


<table>
<TR BGCOLOR=yellow>
           <TH>BookID</TH>
		   <TH>ISBN</TH>
           <TH>title</TH>
		   <TH>Author</TH>
		   <TH>PublishedDate</TH>
		   <TH>KeyWords</TH>
           <TH>ShelfNumber</TH>
		   <TH>BookStatus</TH>
			   <TH>Borrow Button</TH>

</TR>
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
			<?php if($booklist['BookStatus']!='In library'):?>
			<input type="submit" value="Borrow"  disabled="disabled" >
			<?php else: ?>
            <input type="submit" value="Borrow"  >
			<?php endif;?>
			</form>
		</td>
		
		</tr>
		<?php endforeach;?>
		</table>


 </div>
 <div id="footer">
            <p class="copyright">
                &copy; <?php echo date("Y"); ?> Ourlibrary.com
            </p>
        </div>
		</body>
	</html>
		 
	    



