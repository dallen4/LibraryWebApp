<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <title>Members List</title>
    <style>
        table,th,td
        {
            border:1px solid black;
            padding:5px;
        }
    </style>
</head>
<body>
<?php
include 'db.inc.php';
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
/*Deleting a member*/
if (isset($_GET['delete'])) {
    try {
        $sql_uMID_uSID = 'Delete FROM member WHERE MembershipID= $booklist2['MembershipID']';
        $result = $pdo->prepare($sql_uMID_uSID);
        $result->bindValue(':MembershipID', $MembershipID);
        $result->execute();
    }catch (PDOException $e)
    {
        $error_message = 'Error fetching books: ' . $e->getMessage();
        include 'error.html.php';
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
        <TH>Delete Button</TH>
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
        <td><?php echo $booklist2['MStatusID'];?></td>
        <td>
            <form action=" " method="post">
                <input type="hidden" name = "delete" value ="<?php echo $booklist2['MembershipID'];?>">
                <input type="submit" name="delete" value="Delete">
            </form>
        </td>
    </tr>
<?php endforeach;?>
</table>
</body>
<li><a href="links.php">Go back to the Admins Page</a></li>

</html>
