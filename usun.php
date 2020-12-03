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
	<button style="width:30%;" onclick="window.location.href = 'dodaj.php'">DODAJ PYTANIE</button>
	<button style="width:30%; background-color: purple; color: white;">USUN PYTANIE</button>
</div>
<div style="text-align:center;">
	<h2>Usun pytanie</h2>
<form method="post" enctype='multipart/form-data'>  
<?php
require_once "db_config.php";
	$polaczenie = @mysqli_connect($db_host,$db_user,$db_pass,$db_name);

if (mysqli_connect_errno()){
	echo "Coś się rypło!!! <br />";
	echo "Error".mysqli_connect_errno().""."Opis:".mysqli_connect_errno();
}
else{
	$kwerenda="SELECT * FROM pytania";
	$wynik=$polaczenie->query($kwerenda);
	
	echo "<table border=1><tr><th>id pyt.</th><th>tresc pyt.</th><th>usun pyt.</th>";
	foreach ($wynik as $w){
		echo "<tr>";
		echo "<td style='text-align:center;'>".$w["id"]."</td><td>".$w["tresc"].
		"</td><td><input type='submit' name='zazn' value='usun:".$w['id']."' style='width:100%;'></td>";
		echo "</tr>";
	}
	echo "</table>";
	
	if(isset($_POST["zazn"])){
		$rozdziel = explode(":", $_POST["zazn"]);
		$kwerenda="DELETE FROM `pytania` WHERE id='$rozdziel[1]'";
		$wynik=$polaczenie->query($kwerenda);
		header('Location: usun.php');
	}
}
	
?>
</form>
</div>
</body>
</html>