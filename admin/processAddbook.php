<?php
include '../db.inc.php';
//values entered by the user
$ISBN = $_GET['ISBN'];
$bookTitle = $_GET['bookTitle'];
$author = $_GET['Author'];
$publishedDate = $_GET['PublishedDate'];
$Publisher = $_GET['Publisher'];
$keywords = $_GET['keywords'];
$category = $_GET['category'];
$copyCount = $_GET['copyCount'];





try {
  //select ISBNs from the database from book table
  $sql = 'SELECT ISBN FROM book WHERE ISBN = :ISBN';
  $result = $pdo->prepare($sql);
  $result->bindValue(':ISBN', $ISBN);
  $result->execute();

  $row = $result->fetch();

//if condition is satisfied, the ISBN is not in the system, i.e. adding book and bookcopies
if ($ISBN != $row[0]) {
  //add new book to Book table
  try {
    $sqlinstert = 'INSERT INTO book SET ISBN = :ISBN,
    Title = :bookTitle,
    Author = :Author,
    PublishedDate = :publishedDate,
	Publisher = :Publisher,
    KeyWords = :keywords,
	copyCount = :copyCount';

    $book = $pdo->prepare($sqlinstert);
    $book->bindValue(':ISBN', $ISBN);
    $book->bindValue(':bookTitle', $bookTitle);
    $book->bindValue(':Author', $author);
    $book->bindValue(':publishedDate', $publishedDate);
	$book->bindValue(':Publisher',$Publisher);
    $book->bindValue(':keywords', $keywords);
    $book->bindValue(':copyCount', $copyCount);

    $book->execute();


	Switch($category){
		  case 'Computer':
			$ShelfNumber = 1001;
			break;

		  case 'Literature':
			$ShelfNumber = 1002;
		    break;

		  case 'Children':
			$ShelfNumber = 1003;
			break;

		   case 'Education':
			$ShelfNumber = 1004;
		     break;
	  }


  for ($i = 0; $i < $copyCount; $i++) {

   
      $sql1 = 'INSERT INTO bookcopy SET 
      ISBN = :ISBN,
      ShelfNumber = :ShelfNumber,
      BStatusID = 1';
      $add = $pdo->prepare($sql1);
      $add->bindValue(':ISBN', $ISBN);
      $add->bindValue(':ShelfNumber', $ShelfNumber);

      $add->execute();
    
  }
  
  }
   catch (PDOException $e) {
    $error_message = 'insert bookcopy Error1 : ' . $e->getMessage();
    include '../messagedispaly/outputMessage.php';
    exit();
  }

}  //endif 

 else{

try{

  $sql2 = 'SELECT copyCount FROM book WHERE ISBN = :ISBN';
  $result = $pdo->prepare($sql2);
  $result->bindValue(':ISBN', $ISBN);
  $result->execute();

  $row = $result->fetch();
	 $oldcount = $row[0];

	 $newcopyCount = $oldcount + $copyCount;
	

//update the copyCount when adding a book with an exsited ISBN
	$sqlupdate = 'UPDATE book SET copyCount = :newcopyCount WHERE ISBN = :ISBN';
	$s = $pdo->prepare($sqlupdate);
	$s->bindValue(':newcopyCount', $newcopyCount);
	$s->bindValue(':ISBN',$ISBN);
	
	$s ->execute();	

//addBookCopy($ISBN, $category, $copyCount);

Switch($category){
		  case 'Computer':
			$ShelfNumber = 1001;
			break;

		  case 'Literature':
			$ShelfNumber = 1002;
		    break;

		  case 'Children':
			$ShelfNumber = 1003;
			break;

		   case 'Education':
			$ShelfNumber = 1004;
		     break;
	  }


  for ($i = 0; $i < $copyCount; $i++) {

   
      $sql = 'INSERT INTO bookcopy SET 
      ISBN = :ISBN,
      ShelfNumber = :ShelfNumber,
      BStatusID = 1';
      $add = $pdo->prepare($sql);
      $add->bindValue(':ISBN', $ISBN);
      $add->bindValue(':ShelfNumber', $ShelfNumber);

      $add->execute();
    
	
}

}
  catch (PDOException $e) {
    $error_message = 'insert bookcopy Error2 : ' . $e->getMessage();
    include '../messagedispaly/outputMessage.php';
    exit();
  }


}//endelse

$output_message = 'The books are successfully added into the database!';
}//endtry
catch (PDOException $e) {
    $error_message = 'Error : ' . $e->getMessage();
    include 'error.html.php';
    exit();
  }


include '../messagedispaly/outputMessage.php';

?>
