<?php

$username = $_COOKIE['mycookie'];

/* update the status of a member from pending to approved*/ 
/* i think we need to add a new coloumn in member table where this coloumn shows date where the member signed with us and approve the member after one day of joining*/ 

$sql = 'UPDATE member SET MStatusID=1 WHERE BookID = :bookid';

/* adding new books to the library*/
<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDBPDO";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO MyGuests (firstname, lastname, email)
    VALUES ('John', 'Doe', 'john@example.com')";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "New record created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>




echo "WElcome to adminPage!$username"
?>
