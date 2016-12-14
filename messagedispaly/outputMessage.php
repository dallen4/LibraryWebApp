<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Script Error</title>
	<link rel="stylesheet" type="text/css" href="../main.css"/>
  </head>
  <body>
  <div id="content">
  <?php $usertype = $_COOKIE['usertype'];?>

<ul>
<li><a href="../index.php">Home</a></li>
</ul> </br>

      <div>
    <p class = "success"><?php echo $output_message; ?></p>
	 <p class = "error"><?php echo $error_message; ?></p>
      </div>
</div>


   </body>
   <div id="footer">
            <p class="copyright">
                &copy; <?php echo date("Y"); ?> Ourlibrary.com
            </p>
        </div>
</html>