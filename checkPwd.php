
	  <?php
      include 'db.inc.php'; 
	  require_once('util/main.php');
      require_once('util/tags.php');
	  $userlogin = $_POST['userlogin'];	 
      $userpwd = $_POST['userpwd'];
	  $usertype = $_POST['usertype'];

	  setcookie('mycookie',$userlogin);

if(empty($userlogin)){
	   $onpageerror_message = 'Please enter your username!';
	  }
      else
		$onpageerror_message = '';

if ($onpageerror_message != '') {
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
  include './messagedisplay/outputMessage.php';
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
	
         include './admin/adminResetPwd.php';
		 //include './messagedisplay/outputMessage.php';
	  }

	
	 else if (password_verify($userpwd,$UserPassword[0])){
		  echo "Successful login!".$userlogin;	
	
		 if($usertype == "member")
           header('Location: ./member/memberPage.php');
		
		 
          elseif($usertype == "administrator")
          
		  header('Location: ./admin/links.php');


	  }
	  else {
		  echo "Sorry, login failed! Wrong Username or password ";

		 include('index.php');
	}
  
 ?>
