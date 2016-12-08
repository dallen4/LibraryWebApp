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
   $q = 'SELECT borrowes.MembershipID,bookcopy.BookID,bookcopy.ISBN,Title,Author,DateBorrowed,DateReturned,DueDate,Fee 
	        FROM borrowes, book, bookcopy, member
            WHERE book.ISBN = bookcopy.ISBN AND member.MembershipID = borrowes.MembershipID AND borrowes.BookID = bookcopy.BookID 
			AND UserName = :username AND';
	
	$sql =$q.' DateReturned = :dateRt';
    $result = $pdo->prepare($sql);
	$result ->bindValue(':dateRt','0000-00-00');
    $result->bindValue(':username', $username);
    $result->execute();

	$sql1 = $q.' DateReturned != :dateRt';
    $result1 = $pdo->prepare($sql1);
	$result1 ->bindValue(':dateRt','0000-00-00');
    $result1->bindValue(':username', $username);
    $result1->execute();
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
		    <input type="hidden" name = "bookid" value ="<?php echo $borrowedlist['BookID'];?>">
			<input type="submit" value="return">
			</form>
		</td>
		</tr>


		<?php endforeach;?>
		</table>


<p>Here are your return records:</p>
<table>
<?php foreach($result1 as $borrowedlist1):?>
	<tr>
	<td><?php echo $borrowedlist1['MembershipID'];?></td>
	
	<td><?php echo $borrowedlist1['BookID'];?></td>
	 <td><?php echo $borrowedlist1['ISBN'];?></td>
	  <td style="width:150x"><?php echo $borrowedlist1['Title'];?></td>
	   <td><?php echo $borrowedlist1['Author'];?></td>	    
		 <td><?php echo $borrowedlist1['DateBorrowed'];?></td>
		  <td><?php echo $borrowedlist1['DateReturned'];?></td>
		   <td><?php echo $borrowedlist1['DueDate'];?></td>
		   <td><?php echo $borrowedlist1['Fee'];?></td>
		 </tr>
		<?php endforeach;?>

		</table>
<form action="?" method="post">
		   
			<input type="submit" value="Back">
			</form>
 
 <ul>
<li><a href="index.php">Go back to the homepage</a></li>
 </ul> 
  
  </body>
</html>




