<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>My account</title>
<link rel="stylesheet" type="text/css" href="main.css"/>  
</head>

<body>
<div id="content">
<ul>
<li><a href="index.php">Home</a></li>
<li><div class="line"></div></li>
<li><a href="?">Borrow Book</a></li>
<li><div class="line"></div></li>
<li><a href="?account">My account</a></li>
</ul>

 <h2>My account info:</h2>


<table>
<TR BGCOLOR=yellow>
           <TH>MembershipID</TH>
		   <TH>UserName</TH>
           <TH>MemberStatus</TH>

</TR>
<?php foreach($result as $accountinfo):?>
	<tr>
	<td><?php echo $accountinfo['MembershipID'];?></td>
	 <td><?php echo $accountinfo['UserName'];?></td>
	    <td><?php echo $accountinfo['MemberStatus'];?></td>
		  
		   	
		</tr>
		<?php endforeach;?>
		</table>


 </div>
 <div id="footer">
            <p class="copyright">
                &copy; <?php echo date("Y"); ?> Ourlibrary.com
            </p>
        </div>
		</body>
	</html>
		 