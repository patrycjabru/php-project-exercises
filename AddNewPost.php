 <!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" >
	<title>PHP Projekt</title>
</head>
<body>
	<h1>Formularz do tworzenia wpisu</h1>
	<form method='post' action="wpis.php" enctype="multipart/form-data">
	Podaj nazwę użytkownika:
	<br/>
	<input type="text" name="username" />
	<br/>
	Podaj hasło:
	<br/>
	<input type="password" name="password" />
	<br/>
	Wpis:
	<br/>
	<textarea type="text" rows="10" cols="100" name="content"> </textarea>
	<br/>
	<input type="date" name="date" value="2017-12-05"/>
	<input type="time" name="time" value="16:24"/>
	<br/><br/>
	Załączniki:
	<br/>
	<input type="file" name="file1" /><br/>
	<input type="file" name="file2" /><br/>
	<input type="file" name="file3" /><br/>
		<input type="submit" value="Dodaj" />
		<input type="reset" value="Wyczyść"/>
		<br/><a href="menu.php">Wróc do menu głównego</a>
	</form>
</body>
</html>