<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>Sign Up Result</title>
<link rel="stylesheet" type="text/css" href="../main.css"/>  
</head>
<body>
  
<?php
include '../db.inc.php'; 
//The values which are entered by the user// 
$username = $_POST['username'];
$password = $_POST['password'];
$passwordhash = password_hash("$password",PASSWORD_DEFAULT);
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$zipcode = $_POST['zipcode'];
$phonenumber = $_POST['phonenumber'];
$MStatusID = 0;



try
{
//select usernames from the database from member table 
 $sql = 'SELECT UserName FROM member WHERE UserName = :username';
    $result = $pdo->prepare($sql);
    $result->bindValue(':username', $username);
    $result->execute();
}
catch (PDOException $e)
{
  $error_message = 'Error :' . $e->getMessage();
  include '../messagedispaly/outputMessage.php';
  exit();
}


while($row = $result->fetch()){
         $uname[] = $row['UserName'];
}

if(empty($username)){
	   $onpageerror_message = 'Please enter your username!';
	   
	}

elseif($username == $uname[0]){
        $onpageerror_message = 'Sorry, this username has been taken, please try another one';

}
else
		$onpageerror_message = '';

if ($onpageerror_message != '') {
        include('./newuser.php');
        exit();
    }

/* Signing up a new user with new user inforamtions*/ 
try
{
  	$sql = 'INSERT INTO member SET
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

  $output_message = "Sign Up successfully!! $username!";
    
  
	include '../messagedispaly/outputMessage.php';

}

catch (PDOException $e)
{
  $error_message = 'Error : ' . '<br/>'.$e->getMessage();
  include('../messagedispaly/outputMessage.php');
  exit();

}


?>

 <div id="footer">
            <p class="copyright">
                &copy; <?php echo date("Y"); ?> Ourlibrary.com
            </p>
        </div>
  </body>
</html>
