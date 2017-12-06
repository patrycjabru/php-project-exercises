<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta http-equiv="Content-Type" content="text/html"; charset="utf-8"/>
	<title>PHP Projekt</title>
</head>
<body>

	<h1>Nowy komentarz</h1>
	<form method="GET" action="koment.php">
		<input type="hidden" name="blog" value="<?php echo htmlspecialchars($_GET['blog']); ?>" />
		<input type="hidden" name="wpis" value="<?php echo htmlspecialchars($_GET['wpis']); ?>" />
<!--		<input type="hidden" name="blog">-->
	<!--<input type="text" name="title" /> </br>-->
	
	Wybierz rodzaj komentarza:
		<br/>
		<input type="radio" name="typeOfComment" value="Pozytywny" > Pozytywny<br>
		<input type="radio" name="typeOfComment" value="Neutralny" checked> Neutralny<br>
		<input type="radio" name="typeOfComment" value="Negatywny"> Negatywny
	<!--<input list="typeOfComment" name="typeOfComment"/>-->
	<!--<datalist id="typeOfComment" name="typeOfComment">-->
		<!--<option value="Pozytywny">-->
		<!--<option value="Neutralny">-->
		<!--<option value="Negatywny">-->
	<!--</datalist>-->
	<br/> <br/>
	Wpis: 
	<br/>
	<textarea input="text" rows="10" cols="100" name="comment" /></textarea>
	<br/>
	Imie: <br/>
	<input type="text" name="name" />
	<br/>
	Nazwisko: <br/>
	<input type="text" name="surname" />
	<br/>
	Pseudonim: <br/>
	<input type="text" name="nickname" />
	<br/>
		<input type="submit" value="Zapisz" />
		<input type="reset" value="Wyczyść"/>
		<br/><a href="menu.php">Wróc do menu głównego</a>
	</form>
</body>
</html>