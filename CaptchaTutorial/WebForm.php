<?php 
	echo '
	<form action="Submit.php" method="post">
		Comment: <textarea name="coment"></textarea>
		Enter Code <img src="Captcha.php"><input type="text" name="vercode" />
		<input type="submit" name="Submit" value="Submit" />
	</form>
		 ';
?>