<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <title>Books</title>
 <link rel="stylesheet" type="text/css" href="../main.css"/>     
</head>
<body>
<div id="content">
<ul>
<li><a href="../index.php">Home</a></li>
<li><div class="line"></div></li>
<li><a href="links.php">Admin Control panel</a></li>
<li><div class="line"></div></li>
<li><a href="bookstatistics.php">Statistics</a></li>
</ul></br>
<?php
include '../db.inc.php';
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
        <TH>copyCount</TH>
    </TR>
    <?php foreach($result as $booklist):?>
        <tr>
            <td><?php echo $booklist['ISBN'];?></td>
            <td><?php echo $booklist['Title'];?></td>
            <td><?php echo $booklist['Author'];?></td>
            <td><?php echo $booklist['PublishedDate'];?></td>
            <td><?php echo $booklist['Publisher'];?></td>
            <td><?php echo $booklist['KeyWords'];?></td>
			<td><?php echo $booklist['copyCount'];?></td>
        </tr>
    <?php endforeach;?>
</table>
</div>

<div id="footer">
            <p class="copyright">
                &copy; <?php echo date("Y"); ?> Ourlibrary.com
            </p>
        </div>
		</body>
</html>
