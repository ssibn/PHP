<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>WebChess Login</title>
</head>

<body>
<h2>WebChess Login</h2>

<form method="post" action="mainmenu.php">
<p>
	Nick: <input name="txtNick" type="text" size="15" />
	<br />
	Password: <input name="pwdPassword" type="password" size="15" />
</p>

<p>
	<input name="ToDo" value="Login" type="hidden" />
	<input name="login" value="login" type="submit" />
	<input name="newAccount" value="New Account" type="button" onClick="window.open('newuser.php', '_self')"/>
</p>
</form>

<p>Version 0.8.2, last updated September 27th, 2002</p>

</body>
</html>
