<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <title>Members List</title>
   <link rel="stylesheet" type="text/css" href="../main.css"/>  
</head>
<body>
<div id="content">
<ul>
<li><a href="../index.php">Home</a></li>
<li><div class="line"></div></li>
<li><a href="links.php">Admin Control panel</a></li>
</ul></br>
<?php
include '../db.inc.php';
$username = $_COOKIE['mycookie'];
echo "Welcome, $username";
try
{
    $sql =  'SELECT * FROM member';

    $result3 = $pdo->query($sql);
}
catch (PDOException $e)
{
    $error_message = 'Error fetching books: ' . $e->getMessage();
    include 'error.html.php';
    exit();
}

echo "9999999";
$mid =$_POST['mid'];
$mstatus = $_POST['mstatus'];
echo "$mid";
echo "$mstatus";

//Edit member status
if (isset($_GET['edit'])) {

	echo "88888888";

    try 
	{   
		$sql = "UPDATE member SET MStatusID = $mstatus WHERE MembershipID = $mid";
       // $result = $pdo->prepare($sql);
      //  $result->bindValue(':MembershipID', $mid);
	//	$result->bindValue(':mstatusid', $mstatus);
       		 $result = $pdo->query($sql);
    }catch (PDOException $e)
    {
        $error_message = 'Error edit member: ' . $e->getMessage();
        include '../messagedispaly/outputMessage.php';
        exit();
    }
}

?>
<table>
    <TR BGCOLOR=#7fffd4>
        <TH>Member Number</TH>
        <TH>Member Name</TH>
        <TH>Member Address</TH>
        <TH>Member City</TH>
        <TH>Member State</TH>
        <TH>Member Zipcode</TH>
        <TH>Member Phone </TH>
        <TH>Member Status</TH>
        
    </TR>
    <?php foreach($result3 as $booklist2):?>
    <tr>
        <td><?php echo $booklist2['MembershipID'];?></td>
        <td><?php echo $booklist2['UserName'];?></td>
        <td><?php echo $booklist2['MemberAddress'];?></td>
        <td><?php echo $booklist2['MemberCity'];?></td>
        <td><?php echo $booklist2['MemberState'];?></td>
        <td><?php echo $booklist2['MemberZipcode'];?></td>
        <td><?php echo $booklist2['PhoneNumber'];?></td>
       
	    <td>
            <form action="?edit" method="post">
			<select id="mstatus" name="mstatus" >
		<option value= "$booklist2['MStatusID']"><?php echo $booklist2['MStatusID'];?></option>
       <option value= "0">0</option>
       <option value= "1">1</option> 
	   <option value= "2">2</option>
    </select> 
			    <input type="hidden" name = "mid" value ="<?php echo $booklist2['MembershipID'];?>">
                <input type="submit" name="edit" value="EDIT">
            </form>
        </td>
    </tr>
<?php endforeach;?>
</table>
</div>
</body>


</html>
