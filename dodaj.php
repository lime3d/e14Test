<?php
session_start();
if(!isset($_SESSION["id"])){
	echo "<script> location.href='logowanie.php'; </script>";
}
?>
<html>

<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<div style="margin:auto; width:80%; text-align:center;">
	<button style="width:30%;" onclick="window.location.href = 'index.php'">EGZAMIN</button>
	<button style="width:30%; background-color: purple; color: white;" onclick="">DODAJ PYTANIE</button>
	<button style="width:30%;" onclick="window.location.href = 'usun.php'">USUN PYTANIE</button>
</div>
<div style="text-align:center;">
	<h2>Dodaj pytanie</h2>
	<form method="post" enctype='multipart/form-data'>  
	  <input type="text" name="pytanie" placeholder="Tresc pytania">
	  <br>
	  <input type="text" name="odpa" placeholder="Odpowiedz A">
	  <br>
	  <input type="text" name="odpb" placeholder="Odpowiedz B">
	  <br>
	  <input type="text" name="odpc" placeholder="Odpowiedz C">
	  <br>
	  <input type="text" name="odpd" placeholder="Odpowiedz D">
	  <br>
	  <input type="text" name="poprawna" placeholder="Poprawna odpowiedz">
	  <br>
	  <br>
	  <input type='file' name='obrazek' id='obrazek'>
	  <br>
	  <input type="submit" name="submit" value="Dodaj">  
	</form>
	</form>
</div>
<?php
require_once "db_config.php";
	$polaczenie = @mysqli_connect($db_host,$db_user,$db_pass,$db_name);

if (mysqli_connect_errno()){
	echo "Coś się rypło!!! <br />";
	echo "Error".mysqli_connect_errno().""."Opis:".mysqli_connect_errno();
}
else{
	if (empty($_POST)){	
	}
	else{
		$tresc=$_POST['pytanie'];
		$odpa=$_POST['odpa'];
		$odpb=$_POST['odpb'];
		$odpc=$_POST['odpc'];
		$odpd=$_POST['odpd'];
		$poprawna=$_POST['poprawna'];
		
		if(isset($_FILES["obrazek"]["name"])){
			$target_dir = "uploads/";
			$target_file = $target_dir . basename($_FILES["obrazek"]["name"]);
			move_uploaded_file($_FILES["obrazek"]["tmp_name"], $target_file);
			echo $target_file." ";
			$sql = "INSERT INTO `pytania`(`tresc`, `a`, `b`, `c`, `d`, `poprawna`, zdjecie) 
			VALUES ('$tresc','$odpa','$odpb','$odpc','$odpd','$poprawna','$target_file');";
			$result = $polaczenie->query($sql);
			header('Location: dodaj.php');
		}
		else{
			$sql = "INSERT INTO `pytania`(`tresc`, `a`, `b`, `c`, `d`, `poprawna`) 
			VALUES ('$tresc','$odpa','$odpb','$odpc','$odpd','$poprawna');";
			$result = $polaczenie->query($sql);
			header('Location: dodaj.php');
		}
	}
}
	
?>
</body>
</html>