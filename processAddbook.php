<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>Sign Up Result</title>
<link rel="stylesheet" type="text/css" href="main.css"/>
</head>
<body>

<?php
include 'db.inc.php';
//values entered by the user
$ISBN = $_POST['ISBN'];
$bookTitle = $_POST['bookTitle'];
$author = $_POST['Author'];
$publishedDate = $_POST['PublishedDate'];
$keywords = $_POST['keywords'];
$copyCount = $_POST['copyCount'];

//DETERMINED BY COPY????
// $bookID = $_POST['BookID'];
// $shelfNumber = $_POST['ShelfNumber'];

try {
  //select ISBNs from the database from book table
  $sql = 'SELECT ISBN FROM book WHERE ISBN = :ISBN';
  $result = $pdo->prepare($sql);
  $result->bindValue(':ISBN', $ISBN);
  $result->execute();
}
catch (PDOException $e) {
  $error_message = "Error :" . $e->getMessage();
  include 'error.html.php';
  exit();
}

$row = $result->fetch();

//if condition is satisfied, the ISBN is not in the system, i.e. adding book and bookcopies
if ($ISBN != $row[0]) {
  //add new book to Book table
  try {
    $sql = 'INSERT INTO book SET ISBN = :ISBN,
    Title = :bookTitle,
    Author = :Author,
    PublishedDate = :publishedDate,
    KeyWords = :keywords';

    $book = $pdo->prepare($sql);
    $book->bindValue(':ISBN', $ISBN);
    $book->bindValue(':bookTitle', $bookTitle);
    $book->bindValue(':Author', $author);
    $book->bindValue(':publishedDate', $publishedDate);
    $book->bindValue(':keywords', $keywords);
    // $book->bindValue(':copyCount', $copyCount);

    $book->execute();

  }
  catch (PDOException $e) {
    $error_message = 'Error : ' . $e->getMessage();
    include 'error.html.php';
    exit();
  }

  //CALCULATE BookID AND ShelfNumber
  $BookID = 15001;
  $ShelfNumber = 1003;

  for ($i = 1; $i <= $copyCount; $i++) {

    try {
      $sql = 'INSERT INTO bookcopy SET BookID = :BookID,
      ISBN = :ISBN,
      ShelfNumber = :ShelfNumber,
      BStatusID = 1';
      $add = $pdo->prepare($sql);
      $add->bindValue(':BookID', $BookID);
      $add->bindValue(':ISBN', $ISBN);
      $add->bindValue(':ShelfNumber', $ShelfNumber);

      $add->execute();
    }
    catch (PDOException $e) {
      $error_message = 'Error : ' . $e->getMessage();
      include 'error.html.php';
      exit();
    }

    $BookID++;
  }
}
?>

<a href="index.php">Go back to the homepage</a>
</body>
</html>
