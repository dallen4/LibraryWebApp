<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <title>Books</title>
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
    $sql =  'SELECT * FROM book';

    $result = $pdo->query($sql);
}
catch (PDOException $e)
{
    $error_message = 'Error fetching books: ' . $e->getMessage();
    include 'error.html.php';
    exit();
}
?>
<p>Here is all of the library's inventory:</p>

<table>
    <TR BGCOLOR=green>
        <TH>ISBN</TH>
        <TH>title</TH>
        <TH>Author</TH>
        <TH>PublishedDate</TH>
        <TH>Publisher</TH>
        <TH>KeyWords</TH>
        <TH>Delete Button</TH>
    </TR>
    <?php foreach($result as $booklist):?>
        <tr>
            <td><?php echo $booklist['ISBN'];?></td>
            <td><?php echo $booklist['Title'];?></td>
            <td><?php echo $booklist['Author'];?></td>
            <td><?php echo $booklist['PublishedDate'];?></td>
            <td><?php echo $booklist['Publisher'];?></td>
            <td><?php echo $booklist['KeyWords'];?></td>

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
<b><li><a href="links.php">Go back to the Admins Page</a></li></b>
</html>
