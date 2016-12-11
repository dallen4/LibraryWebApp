
<?php
try
{
 /*change the last two values to your username and password*/
  $pdo = new PDO('mysql:host=localhost;dbname=libraryWebApp', 'DBuser', 'DBkaimen');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->exec('SET NAMES "utf8"');
}
catch (PDOException $e)
{
  $error_message = 'Unable to connect to the database server.';
  include 'error.html.php';
  exit();
}
