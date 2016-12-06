
	  <?php
      include 'db.inc.php'; 
	  $userlogin = $_POST['userlogin'];	 
      $userpwd = $_POST['userpwd'];
	  $usertype = $_POST['usertype'];

	  setcookie('mycookie',$userlogin);

if(empty($userlogin)){
	   $error_message = 'Please enter your username!';
	  }
      else
		$error_message = '';

if ($error_message != '') {
        include('index.php');
        exit();
    }

if($usertype == "member")

	$sql = 'SELECT UserPassword FROM member WHERE UserName = :userlogin';

elseif($usertype == "administrator")
    $sql = 'SELECT AdminPassword FROM adminstrator WHERE EmployeeID = :userlogin';

try
{

    $result = $pdo->prepare($sql);
    $result->bindValue(':userlogin', $userlogin);
    $result->execute();
}
catch (PDOException $e)
{
  $error_message = 'Error : ' . $e->getMessage();
  include 'error.html.php';
  exit();
}

while ($row = $result->fetch())
{
	if($usertype == "member")
  $UserPassword[] = $row['UserPassword'];
elseif($usertype == "administrator")
$UserPassword[] = $row['AdminPassword'];
  
}



    if ($userpwd == $UserPassword[0]){
		  echo "Your password is unprotected, please change your password!";	
	
         include 'adminResetPwd.php';
	  }

	
	 else if (password_verify($userpwd,$UserPassword[0])){
		  echo "Successful login!".$userlogin;	
	
		 if($usertype == "member")
           header('Location: memberPage.php');
		 
          elseif($usertype == "administrator")
          
		  header('Location: adminPage.php');


	  }
	  else {
		  echo "Sorry, login failed! Wrong Username or password ";

		 include('login.html');
	}
  
 ?>
