<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>Sign Up Result</title>
<link rel="stylesheet" type="text/css" href="main.css"/>  
</head>
<body>
  
<?php
include 'db.inc.php'; 
//The values which are entered by the administrator to add a book// 
$isbn = $_POST['ISBN'];
$booktitle = $_POST['book title'];
$author = $_POST['author'];
$publisheddate = $_POST['publisheddate'];
$keywords = $_POST['keywords'];
$bookid = $_POST['bookid'];
$shelfnumber = $_POST['shelfnumber'];
$BStatusID = 1;
try
{
//select ISBN from the database from Book table 
 $sql = 'SELECT ISBN FROM book WHERE ISBN = :isbn';
    $result = $pdo->prepare($sql);
    $result->bindValue(':isbn', $isbn);
    $result->execute();
}
catch (PDOException $e)
{
  $error_message = 'Error :' . $e->getMessage();
  include 'error.html.php';
  exit();
}
while($row = $result->fetch()){
         $bisbn[] = $row['ISBN'];
}
if(empty($isbn)){
	   $error_message = 'Please enter the ISBN !';
	   
	}
elseif($isbn == $bisbn[0]){
        $error_message = 'Sorry, this ISBN has been taken, please try another one';
}
else
		$error_message = '';
if ($error_message != '') {
        include('newuser.php');
        exit();
    }
/* Signing up a new user with new user inforamtions*/ 
try
{
  	$sql = 'INSERT INTO book, bookcopy SET
       ISBN = :bisbn,
        Title = :title,
        Author = :author,
        PublishedDate = :publisheddate,
		Publisher = :publisher,
		Keywords = :keywords,
		BookID = :bookid,
		ShelfNumber  = :shelfnumber
		BStatusID = :bstatusid, ;
    $s = $pdo->prepare($sql);
    $s->bindValue(':isbn', $isbn);
    $s->bindValue(':pwdhash', $passwordhash);
    $s->bindValue(':maddress', $address);
    $s->bindValue(':mcity', $city);
	$s->bindValue(':mstate', $state);
    $s->bindValue(':mzipcode', $zipcode);
    $s->bindValue(':pnum', $phonenumber);
	$s->bindValue(':mstatus', $MStatusID);  
    
    $s->execute();
  echo "Book added!";
  echo '<br/>';
}
catch (PDOException $e)
{
  $error_message = 'Error : ' . '<br/>'.$e->getMessage();
  include('error.html.php');
  exit();
}
?>
<ul>
<li><a href="index.php">Go back to the homepage</a></li>
 </ul>
  </body>
</html>

