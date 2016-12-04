<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>check books</title>
    <style type="text/css">
  //  textarea {
      display: block;
      width: 100%;
    }
	table,th,td
{
border:1px solid black;
padding:5px;
}
    </style>
  </head>
  <body>
   <p>Here are all the books you borrowed:</p>
 <?php    

       $username = $_COOKIE['mycookie'];
 try
  {
	$sql = 'SELECT borrowes.MembershipID,bookcopy.BookID,bookcopy.ISBN,Title,Author,DateBorrowed,DateReturned,DueDate,Fee 
	        FROM borrowes, book, bookcopy, member
            WHERE book.ISBN = bookcopy.ISBN AND member.MembershipID = borrowes.MembershipID AND borrowes.BookID = bookcopy.BookID AND UserName = :username';
  //  $sql = 'DELETE FROM department WHERE dnumber = :id';
    $result = $pdo->prepare($sql);
    $result->bindValue(':username', $username);
    $result->execute();
  }
  catch (PDOException $e)
  {
    $error_message = 'Error checking book: ' . $e->getMessage();
    include 'error.html.php';
    exit();
  }
?> 

<table>
<?php foreach($result as $borrowedlist):?>
	<tr>
	<td><?php echo $borrowedlist['MembershipID'];?></td>
	<td><?php echo $borrowedlist['BookID'];?></td>
	 <td><?php echo $borrowedlist['ISBN'];?></td>
	  <td style="width:150x"><?php echo $borrowedlist['Title'];?></td>
	   <td><?php echo $borrowedlist['Author'];?></td>
	    
		 <td><?php echo $borrowedlist['DateBorrowed'];?></td>
		  <td><?php echo $borrowedlist['DateReturned'];?></td>
		   <td><?php echo $borrowedlist['DueDate'];?></td>
		   <td><?php echo $borrowedlist['Fee'];?></td>
		   <td>
		   <form action="?return" method="post">
		    <input type="hidden" name = "bookid" value ="<?php echo $booklist['BookID'];?>">
			<input type="submit" value="return">
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

