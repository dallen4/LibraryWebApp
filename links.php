<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <title>Admin's Control Panel</title>
<link rel="stylesheet" type="text/css" href="main.css"/>  
</head>
<div id="content">
<body>
<p>Welcom Admin</p>
<h1>Admin Menu:</h1>
<script>
    var txt = "Check the Books";
    document.write("<p>" + txt.link("Books.php") + "</p>");
</script>
<script>
    var txt = "Check  Books Copies";
    document.write("<p>" + txt.link("BookCopy.php") + "</p>");
</script>
<script>
    var txt = "Check the Members";
    document.write("<p>" + txt.link("memberlist.html.php") + "</p>");
</script>
    <script>
    var txt = "Add a new Book";
    document.write("<p>" + txt.link("AddABook.php") + "</p>");
</script>
       <script>
    var txt = "Add a  Book Copy";
    document.write("<p>" + txt.link("AddACopy.php") + "</p>");
</script>
<script>

    var utc = new Date().toJSON().slice(0,10);
    document.write(utc);
</script>


</body>
</div>
<div id="footer">
            <p class="copyright">
                &copy; <?php echo date("Y"); ?> Ourlibrary.com
            </p>
        </div>
</html>
