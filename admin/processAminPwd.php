<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>Reset Pssword Result</title>
<link rel="stylesheet" type="text/css" href="../main.css"/>  
</head>
<body>
  
<?php
include '../db.inc.php'; 

$username = $_POST['username'];
$password = $_POST['password'];
$passwordhash = password_hash("$password",PASSWORD_DEFAULT);

try
{
  	$sql = 'UPDATE adminstrator SET
        
        AdminPassword = :pwdhash WHERE EmployeeID = :uname';
        

    $s = $pdo->prepare($sql);
    $s->bindValue(':uname', $username);
    $s->bindValue(':pwdhash', $passwordhash);
   
    
    $s->execute();

  
 $output_message = "Password reset successfully!! $username! ";   
  
	include '../messagedispaly/outputMessage.php';

}
catch (PDOException $e)
{
  $error_message = 'Error : ' . '<br/>'.$e->getMessage();
  include('../messagedispaly/outputMessage.php');
  exit();

}


include 'listOfBooksAvailablie.php';
