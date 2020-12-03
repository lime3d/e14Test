<?php
session_start();
if(isset($_SESSION["id"])){
	echo "<script> location.href='dodaj.php'; </script>";
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
	<h2>Zaloguj sie na konto administratora</h2>
	<form method="post">
		<input type="text" name="Login" placeholder="Login"><br>
		<input type="password" name="Haslo" placeholder="Haslo"><br>
		<input type="submit" value="Zaloguj">
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
		$login=$_POST['Login'];
		$haslo=$_POST['Haslo'];
		
		$kwerenda="SELECT * FROM uzytkownicy where nazwa='$login' AND haslo='$haslo'";
		$wynik=$polaczenie->query($kwerenda);
		$row = $wynik->fetch_array();
		if($row["id"]>=1){
			$_SESSION["id"]=$row["id"];
			header('Location: dodaj.php');
		}
		else{
			echo "<center><h3>Bledne dane</h3></center>";
		}
	}
}
	
?>
</body>
</html>