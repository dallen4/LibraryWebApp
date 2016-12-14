  <?php
      include '../db.inc.php';
try { 

	

	$pdo->query('SET FOREIGN_KEY_CHECKS = 0');
 //sql to delete a record
    $sql = "DELETE from bookcopy where `BookID`= :bookid";

	$s = $pdo->prepare($sql);
    $s->bindValue(':bookid', $_POST['bookid']);
	$s->execute(); 

	$pdo->query('SET FOREIGN_KEY_CHECKS = 1');

    $output_message = "Record deleted successfully";
	include '../messagedispaly/outputMessage.php';
  }
catch(PDOException $e)
    {
    $error_message = 'delete bookcopy Error : ' . $e->getMessage();
    include '../messagedispaly/outputMessage.php';
    exit();
    }

?>
