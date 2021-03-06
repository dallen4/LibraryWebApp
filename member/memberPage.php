<?php
include '../db.inc.php';

$username = $_COOKIE['mycookie'];

echo "Welcome, $username!";


//include('welcomeMessage.php');

if (isset($_GET['checkbooks']))
{
  include 'checklist.html.php';
  exit();
}

//search function
$keywords = $_POST['Searchtext'];

if(!empty($keywords)){

try
  {
   $sql =  "SELECT DISTINCT BookID,bookcopy.ISBN,title,Author,PublishedDate,KeyWords,ShelfNumber,bookstatus.BookStatus 
	         FROM bookcopy,book,bookstatus 
			 WHERE book.ISBN=bookcopy.ISBN AND bookcopy.BStatusID=bookstatus.BStatusID
			 AND (title like '%$keywords%' OR Author like '%$keywords%' OR KeyWords like '%$keywords%')";

    $result = $pdo->query($sql);
	include 'listOfBooksAvailablie.php';
    return;
   	
}

  catch (PDOException $e)
  {
    $error_message = 'Error search book: ' . $e->getMessage();
    include '../messagedispaly/outputMessage.php';
    exit();
  }
}


if(isset($_GET['account']))
{
  try
  {
    $sql = 'SELECT `MembershipID`,`UserName`,`MemberStatus` FROM `member` JOIN memberstatus USING (`MStatusID`) WHERE `UserName`=:username';  //JOIN query
    $result = $pdo->prepare($sql);
    $result->bindValue(':username',$username);
    $result->execute();
    include 'accountInfo.php';
	return;
	
}
  catch (PDOException $e)
  {
    $error_message = 'Error checking account: ' . $e->getMessage();
    include '../messagedispaly/outputMessage.php';
    exit();
  }
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
	include('../messagedispaly/outputMessage.php');
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
    include '../messagedispaly/outputMessage.php';
	$pdo->rollback();
    exit();
  }


  header('Location: memberPage.php');
  exit();
}


/*Returning a book
  Here we use a trigger:When a member returns a book, update 'returndate' and calculate fee if returneddate is late than duedate in borrowes table
  This action triggers an updating of the bookstatus from "borrowed" into "in library"
*/ 

if (isset($_GET['return']))
{
  try
  {
    $sql = "SELECT datediff(CURRENT_DATE, DueDate) as diff FROM borrowes WHERE BookID = :bookid AND DateReturned = :dateRt";
    $s = $pdo->prepare($sql);
    $s->bindValue(':bookid', $_POST['bookid']);
    $s->bindValue(':dateRt', '0000-00-00');	
    $s->execute();
	
	while($row = $s->fetch())
	 {
	 $diff[] = $row['diff'];
	}
  //if returneddate is late than duedate,uptate the fee as well
	if($diff[0] > 0)
	$sqlupdate = "UPDATE borrowes SET 
	`Fee`= $diff[0],
	`DateReturned`= CURRENT_DATE	
	WHERE `BookID`= :bookid AND DateReturned = :dateRt";
	
	else
    $sqlupdate = "UPDATE borrowes SET 
	`DateReturned`= CURRENT_DATE 
     WHERE `BookID`=:bookid AND DateReturned = :dateRt";

    $s = $pdo->prepare($sqlupdate);
    $s->bindValue(':bookid', $_POST['bookid']);
	$s->bindValue(':dateRt', '0000-00-00');	
    $s->execute();

}
  catch (PDOException $e)
  {
    $error_message = 'Error reserving book: ' . $e->getMessage();
    include '../messagedispaly/outputMessage.php';
    exit();
  }
}

try
{

	$sql =  'SELECT BookID,bookcopy.ISBN,title,Author,PublishedDate,KeyWords,ShelfNumber,bookstatus.BookStatus 
	         FROM bookcopy,book,bookstatus 
			 WHERE book.ISBN=bookcopy.ISBN AND bookcopy.BStatusID=bookstatus.BStatusID';
 
  $result = $pdo->query($sql);
}
catch (PDOException $e)
{
  $error_message = 'Error fetching books: ' . $e->getMessage();
  include '../messagedispaly/outputMessage.php';
  exit();
}

include 'listOfBooksAvailablie.php';






