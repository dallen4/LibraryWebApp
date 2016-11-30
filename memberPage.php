<?php
include 'db.inc.php';

$username = $_COOKIE['mycookie'];

echo "Welcome, $username";

if (isset($_GET['checkbooks']))
{
  include 'checklist.html.php';
  exit();
}



if (isset($_GET['borrow']))
{
  try
  {
	$sql = 'UPDATE bookcopy SET BStatusID=0 WHERE BookID = :bookid';
  //  $sql = 'DELETE FROM department WHERE dnumber = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':bookid', $_POST['bookid']);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Error reserving book: ' . $e->getMessage();
    include 'error.html.php';
    exit();
  }

 try
  {
  $sql1 = 'SELECT MembershipID FROM member WHERE UserName = :username';
  $result = $pdo->prepare($sql1);
  $result->bindValue(':username',$username);
  $result ->execute();

 while ($row = $result->fetch())
{
  $membershipID[] = $row['MembershipID'];
}

$memid = $membershipID[0];     //get the membershipID of the user logins

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
		
  }
  catch (PDOException $e)
  {
    $error = 'Error inserting book: ' . $e->getMessage();
    include 'error.html.php';
    exit();
  }

  header('Location: memberPage.php');
  exit();
}


try
{

	$sql =  'SELECT BookID,bookcopy.ISBN,title,Author,PublishedDate,KeyWords,ShelfNumber,bookstatus.BookStatus 
	         FROM bookcopy,book,bookstatus 
			 WHERE book.ISBN=bookcopy.ISBN AND bookcopy.BStatusID=bookstatus.BStatusID AND bookcopy.BStatusID =1';
  //$sql = 'SELECT * FROM department';
  $result = $pdo->query($sql);
}
catch (PDOException $e)
{
  $error = 'Error fetching departments: ' . $e->getMessage();
  include 'error.html.php';
  exit();
}

include 'listOfBooksAvailablie.php';





