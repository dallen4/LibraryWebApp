<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <title>Books Copies</title>
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
    

<h3>Here are all of the book copies that we have and thier statues:</h3>
<table>
    <TR BGCOLOR=#a52a2a>
        <TH>Book ID</TH>
        <TH>ISBN Number</TH>
        <TH>Shelf Number</TH>
        <TH>Book Status </TH>
        <TH>Delete Button</TH>
    </TR>
    <?php foreach($result2 as $booklist1):?>
        <tr>
            <td><?php echo $booklist1['BookID'];?></td>
            <td><?php echo $booklist1['ISBN'];?></td>
            <td><?php echo $booklist1['ShelfNumber'];?></td>
            <td><?php echo $booklist1['BStatusID'];?></td>

            <td>
                <form action="DeleteBookprocess.php" method="post">
                    <input type="hidden" name = "bookid" value ="<?php echo $booklist1['BookID'];?>"> 
					<?php if($booklist1['BStatusID'] =='0'):?>
			        <input type="submit" value="Delete"  disabled="disabled" >
			         <?php else: ?>
                    <input type="submit" value="Delete">
					<?php endif;?>
                </form>
            </td>
			
        </tr>
    <?php endforeach;?>

</table>
</div>
</body>
</html>
