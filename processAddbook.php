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
$BStatusID = 0;
try
{
//select ISBN from the database from Book table 
 $sql = 'SELECT ISBN FROM book WHERE ISBN = :isbn';
    $result = $pdo->prepare($sql);
    $result->bindValue(':username', $username);
    $result->execute();
}
catch (PDOException $e)
{
  $error_message = 'Error :' . $e->getMessage();
  include 'error.html.php';
  exit();
}
while($row = $result->fetch()){
         $uname[] = $row['UserName'];
}
if(empty($username)){
	   $error_message = 'Please enter the ISBN !';
	   
	}
elseif($username == $uname[0]){
        $error_message = 'Sorry, this username has been taken, please try another one';
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
        UserName = :uname,
        UserPassword = :pwdhash,
        MemberAddress = :maddress,
        MemberCity = :mcity,
		MemberState = :mstate,
		MemberZipcode = :mzipcode,
		PhoneNumber = :pnum,
		MStatusID  = :mstatus';
    $s = $pdo->prepare($sql);
    $s->bindValue(':uname', $username);
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


<label>ISBN:</label>
		<input type="text" name="username" value = "<?php echo $ISBN; ?>"/> <br />  
        
		<label>Book tilte:</label>
		  <input type="text" name="book title" value = "<?php echo $booktitle; ?>"/><br />   
		<label>Author:</label>
		  <input type="text" name="Author" value = "<?php echo $author; ?>"/><br />  
		<label>Published Date:</label>
		  <input type="text" name="Published Date" value = "<?php echo $publisheddate; ?>"/><br /> 
		 <label>Keywords:</label>
		  <input type="text" name="keywords" value = "<?php echo $keywords; ?>"/><br /> 
         <label>BookID:</label>
		  <input type="text" name="BookID" value = "<?php echo $bookid; ?>"/><br /> 
		  <label>Shelf Number:</label>
		  <input type="text" name="Shelf Number" value = "<?php echo $shelfnumber; ?>"/><br />  
        	
        </div>

        <div id="buttons">
		
            <input type="submit" value="Add a book!"></div>
