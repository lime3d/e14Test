<html>

<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<div style="margin:auto; width:80%; text-align:center;">
	<button style="width:30%; background-color: purple; color: white;" onclick="">EGZAMIN</button>
	<button style="width:30%;" onclick="window.location.href = 'logowanie.php'">DODAJ PYTANIE</button>
	<button style="width:30%;" onclick="window.open('/e14/uploads/plik.pdf');">USUN PYTANIE</button>
</div>
<h1><center>EGZAMIN ZAWODOWY E14</center></h1>
<h2><center>Sprawdz swoja wiedze ;)</center></h2>
<?php
require_once "db_config.php";
$polaczenie = @mysqli_connect($db_host,$db_user,$db_pass,$db_name);

if (mysqli_connect_errno()){
	echo "Coś się rypło!!! <br />";
	echo "Error".mysqli_connect_errno().""."Opis:".mysqli_connect_errno();	
}
else{
$kwerenda="SELECT * FROM  pytania";
$wynik=$polaczenie->query($kwerenda);
if($wynik=$polaczenie->query($kwerenda)){
	$tablica=array();	
	while ($wiersz= mysqli_fetch_assoc($wynik)){
		$tablica[] = $wiersz;
	}
	for($i=0;$i<mysqli_num_rows($wynik);$i++){
		$tablica2[$i] = $i;
	}
	$losowanie=array();
	for($i=0;$i<7;$i++){
		$los = array_rand($tablica2);
		$losowanie[$i] = $tablica2[$los];
		unset($tablica2[$los]);
	}
	for($i=0;$i<7;$i++){
		echo "<div class='zadanie'>";
		if($tablica[$losowanie[$i]]['zdjecie']!= "uploads/"){
			$zdj = "".$tablica[$losowanie[$i]]['zdjecie'];
			echo "<img src='$zdj' width='10%'> <br>";
		}
		echo "Polecenie ".($i+1).":".$tablica[$losowanie[$i]]['tresc']."<br />";
		echo "<input type='radio' name='$i' value='a'>A:".$tablica[$losowanie[$i]]['a']."</input><br />";
		echo "<input type='radio' name='$i' value='b'>B:".$tablica[$losowanie[$i]]['b']."</input><br />";
		echo "<input type='radio' name='$i' value='c'>C:".$tablica[$losowanie[$i]]['c']."</input><br />";
		echo "<input type='radio' name='$i' value='d'>D:".$tablica[$losowanie[$i]]['d']."</input><br />";
		echo "</div><br />";
	}
}
}
?>
<div style="margin:auto; width:80%;">
	<button onclick="sprawdz()">Sprawdz !</button>
</div>
<script>
function sprawdz(){
	var odp1 = "<?php echo $tablica[$losowanie[0]]['poprawna']?>";
	var odp2 = "<?php echo $tablica[$losowanie[1]]['poprawna']?>";
	var odp3 = "<?php echo $tablica[$losowanie[2]]['poprawna']?>";
	var odp4 = "<?php echo $tablica[$losowanie[3]]['poprawna']?>";
	var odp5 = "<?php echo $tablica[$losowanie[4]]['poprawna']?>";
	var odp6 = "<?php echo $tablica[$losowanie[5]]['poprawna']?>";
	var odp7 = "<?php echo $tablica[$losowanie[6]]['poprawna']?>";
	var tablica = [odp1, odp2, odp3, odp4, odp5, odp6, odp7];
	var punktacja = 0;
	for(i=0;i<9;i++){
		var test = document.getElementsByName(String(i));
		var sizes = test.length;
		var wartosc;
		for (y=0; y < sizes; y++) {
            if (test[y].checked==true) {
            wartosc = test[y].value;
			}
		}	
		if(wartosc==tablica[i]){
			punktacja ++;
		}
	}
alert("Twoj wynik to " + punktacja + "/7");
}
</script>
</body>
</html>