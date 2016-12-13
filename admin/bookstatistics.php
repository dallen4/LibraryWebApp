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
<li><a href="BookCopy.php">Books</a></li>
</ul></br>
<?php
include '../db.inc.php';
$username = $_COOKIE['mycookie'];
echo "Welcome, $username";
try
{
    $sql =  'SELECT `BookStatus`, count(`BStatusID`) as Number
			FROM bookcopy JOIN bookstatus
			USING (`BStatusID`)
			GROUP BY `BStatusID`';

    $result = $pdo->query($sql);
}
catch (PDOException $e)
{
    $error_message = 'Error fetching books: ' . $e->getMessage();
    include '../messagedispaly/outputMessage.php';
    exit();
}

try
{
  $sql2 =  'SELECT `ISBN`,`Title`,`Author` FROM book WHERE `ISBN` NOT IN (SELECT ISBN FROM borrowes)';

    $result2 = $pdo->query($sql2);
}

catch (PDOException $e)
{
    $error_message = 'Error fetching books: ' . $e->getMessage();
    include '../messagedispaly/outputMessage.php';
    exit();
}


?>
    

<h3>Here are the numbers of books borrowed and in library:</h3>
<table>
    <TR BGCOLOR=#a52a20>    
       
        <TH>Book Status </TH>
        <TH>Number</TH>
    </TR>
    <?php foreach($result as $booklist1):?>
        <tr>
            <td><?php echo $booklist1['BookStatus'];?></td>
            <td><?php echo $booklist1['Number'];?></td>

            			
        </tr>
    <?php endforeach;?>

</table>

<h3>Here are the less popular books which are never borrowed by members:</h3>
<table>
    <TR BGCOLOR=#a52a20>    
       
        <TH>ISBN</TH>
		<TH>TITLE</TH>
		<TH>AUTHOR</TH>
        
    </TR>
    <?php foreach($result2 as $booklist2):?>
        <tr>
            <td><?php echo $booklist2['ISBN'];?></td>
			<td><?php echo $booklist2['Title'];?></td>
			<td><?php echo $booklist2['Author'];?></td>

            			
        </tr>
    <?php endforeach;?>

</table>
</div>
</body>
</html>
