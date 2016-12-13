  <?php
      include 'db.inc.php';
try {


    // sql to delete a record
    $sql = "DELETE
    FROM book,bookcopy
    join using (ISBN)
    WHERE BStatusId=2 or BStatusId=3;"

    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Record deleted successfully";
  }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>
