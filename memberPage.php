<?php
include 'db.inc.php';

$username = $_COOKIE['mycookie'];

echo "Welcome, $username";

if (isset($_GET['checkbooks']))
{
  include 'checklist.html.php';
  exit();
}

//when a member borrows a book, the system first modifies booksatus into 'borrowed' and then inserts a record into borrows table, here we need to use transaction

if (isset($_GET['borrow']))
{
  $pdo->beginTransaction(); 

 try
  {
  $sql_uMID_uSID = 'SELECT MembershipID, MStatusID FROM member WHERE UserName = :username';
  $result = $pdo->prepare($sql_uMID_uSID);
  $result->bindValue(':username',$username);
  $result ->execute();

  while ($row = $result->fetch())
{
  $membershipID[] = $row['MembershipID'];
  $memberStarusID[] = $row['MStatusID'];
}

$memid = $membershipID[0];     //get the membershipID of the user logins
$memStatusID = $memberStarusID[0];     ////get the memberStarusID of the user logins

  $sql_bSID = 'SELECT BStatusID FROM bookcopy WHERE BookID = :bookid';
  $result1 = $pdo->prepare($sql_bSID);
  $result1->bindValue(':bookid', $_POST['bookid']);
  $result1 ->execute();
 

 while ($row = $result1->fetch())
{
  $bStatusID[] = $row['BStatusID'];
}

$bookStatusID = $bStatusID[0];

//check if the member is in a normal starus
if($memStatusID == '0')
    $error_message = "Sorry, your membership is waiting for approval by the administrator, you couldn't borrow books right now.";

//check if the member has fee unpaid
elseif($memStatusID == '2')
	$error_message = "Sorry, you have fee unpaid, you couldn't borrow books right now.";

//check if the book is available
elseif($bookStatusID == '0')
	$error_message = "Sorry, this book is borrowed by other member, please try another one";

else
	$error_message = '';

if (!empty($error_message)) 
	{
	include('error.html.php');
	return;
	}

	
	$sql = 'UPDATE bookcopy SET BStatusID=0 WHERE BookID = :bookid' ;
    $s = $pdo->prepare($sql);
    $s->bindValue(':bookid', $_POST['bookid']);
    $s->execute(); 


   $sql = 'INSERT INTO borrowes SET
	         BookID = :bookid,
			 MembershipID = :memid,
			 DateBorrowed = CURRENT_DATE,
			 DateReturned = :dateRt,
			 DueDate = DATE_ADD(CURRENT_DATE, INTERVAL 60 DAY),
			 Fee = :fee';

	$s = $pdo->prepare($sql);
    $s->bindValue(':bookid', $_POST['bookid']);
	$s->bindValue(':memid', $memid);
	$s->bindValue(':dateRt', 'NULL');	
	$s->bindValue(':fee', 0);
	$s->execute(); 
    
	$pdo->commit();
    
  }
  catch (PDOException $e)
  {
    $error_message = 'Error: ' . $e->getMessage();
    include 'error.html.php';
	$pdo->rollback();
    exit();
  }


  header('Location: memberPage.php');
  exit();
}


/*Returning a book
  Here we use a trigger:When a member returns a book, update the bookstatus from "borrowed" into "in library"
  This action triggers an updating of 'returndate' in borrowes table and calculate fee if returneddate is late than duedate
*/ 

if (isset($_GET['return']))
{
  try
  {
    $sql = 'UPDATE bookcopy SET BStatusID=1 WHERE BookID = :bookid';
    $s = $pdo->prepare($sql);
    $s->bindValue(':bookid', $_POST['bookid']);
    $s->execute();

}
  catch (PDOException $e)
  {
    $error_message = 'Error reserving book: ' . $e->getMessage();
    include 'error.html.php';
    exit();
  }
}

try
{

	$sql =  'SELECT BookID,bookcopy.ISBN,title,Author,PublishedDate,KeyWords,ShelfNumber,bookstatus.BookStatus 
	         FROM bookcopy,book,bookstatus 
			 WHERE book.ISBN=bookcopy.ISBN AND bookcopy.BStatusID=bookstatus.BStatusID AND bookcopy.BStatusID =1';
 
  $result = $pdo->query($sql);
}
catch (PDOException $e)
{
  $error_message = 'Error fetching books: ' . $e->getMessage();
  include 'error.html.php';
  exit();
}

include 'listOfBooksAvailablie.php';





