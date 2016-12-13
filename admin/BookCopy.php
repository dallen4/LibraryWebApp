<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <title>Books Copies</title>
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
    $sql =  'SELECT * FROM bookcopy';

    $result2 = $pdo->query($sql);
}
catch (PDOException $e)
{
    $error_message = 'Error fetching books: ' . $e->getMessage();
    include 'error.html.php';
    exit();
}

?>
<p>Here are all of the book copies that we have and thier statues:</p>
<table>
    <TR BGCOLOR=#a52a2a>
        <TH>Book ID</TH>
        <TH>ISBN Number</TH>
        <TH>Shelf Number</TH>
        <TH>Book Status </TH>>
        <TH>Delete Button</TH>
    </TR>
    <?php foreach($result2 as $booklist1):?>
        <tr>
            <td><?php echo $booklist1['BookID'];?></td>
            <td><?php echo $booklist1['ISBN'];?></td>
            <td><?php echo $booklist1['ShelfNumber'];?></td>
            <td><?php echo $booklist1['BStatusID'];?></td>

            <td>
                <form action="DeleteABook.php" method="post">
                    <input type="hidden" name = "bookid" value ="<?php echo $booklist['BookID'];?>">
                    <input type="submit" value="Delete">
                </form>
            </td>
        </tr>
    <?php endforeach;?>

</table>
</body>
<li><a href="links.php">Go back to the Admins Page</a></li>

</html>
