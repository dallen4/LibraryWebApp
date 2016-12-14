<?php
include 'db.inc.php';
$username = $_COOKIE['mycookie'];
echo "Welcome, $username";



try
{
	$sql =  'SELECT BookID,bookcopy.ISBN,title,Author,PublishedDate,KeyWords,ShelfNumber,bookstatus.BookStatus 
	         FROM bookcopy,book,bookstatus 
			 WHERE book.ISBN=bookcopy.ISBN AND bookcopy.BStatusID=bookstatus.BStatusID ';
 
  $result = $pdo->query($sql);
}
catch (PDOException $e)
{
  $error_message = 'Error fetching books: ' . $e->getMessage();
  include 'error.html.php';
  exit();
}
include 'ListOfallBooks.php';
