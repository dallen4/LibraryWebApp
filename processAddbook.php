<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>Sign Up Result</title>
<link rel="stylesheet" type="text/css" href="main.css"/>  
</head>
<body>
  
<?php
include 'db.inc.php'; 
$ISBN = $_POST['ISBN'];  
$booktitle = $_POST['booktitle'];
$author = $_POST['author'];
$publisheddate = $_POST['publisheddate'];
$keywords = $_POST['keywords'];
$bookid = $_POST['bookid'];
$shelfnumber = $_POST['shelfnumber'];
$BstatusID = 1;
try
{
 $sql = 'SELECT ISBN FROM book WHERE ISBN = :ISBN';
    $result = $pdo->prepare($sql);
    $result->bindValue(':ISBN', $ISBN);
    $result->execute();
}
catch (PDOException $e)
{
  $error_message = 'Error :' . $e->getMessage();
  include 'error.html.php';
  exit();
}
while($row = $result->fetch()){
         $ISBN[] = $row['ISBN'];
}
if(empty($username)){
	   $error_message = 'Please enter your ISBN!';
	   
	}
elseif($ISBN == $ISBN[0]){
        $error_message = 'Sorry, this ISBN has been taken, please try another one';
}
else
		$error_message = '';
if ($error_message != '') {
        include('Add a book.php');
        exit();
    }
try
{
$query1 ="INSERT INTO book SET (user, date) values(.....)"; 
$query2 ="INSERT INTO bookcopy SET (price) values(......)";
  	$sql = 'INSERT INTO book SET
        UserName = :uname,
        MemberAddress = :maddress,
        MemberCity = :mcity,
		MemberState = :mstate,
		MemberZipcode = :mzipcode,
		PhoneNumber = :pnum,
		MStatusID  = :mstatus';
    $s = $pdo->prepare($sql);
    $s->bindValue(':uname', $username);
    $s->bindValue(':maddress', $address);
    $s->bindValue(':mcity', $city);
	$s->bindValue(':mstate', $state);
    $s->bindValue(':mzipcode', $zipcode);
    $s->bindValue(':pnum', $phonenumber);
	$s->bindValue(':mstatus', $MStatusID);  
    
    $s->execute();
  echo "Sign Up successfully!! $username! ";
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
