<!DOCTYPE html>
<?php
//database connectie
$host = "localhost"; // De server waar de database staat
$dbname = "fly"; // De naam van de database
$user = "root"; // De gebruikersnaam voor de database (root is default bij XAMPP)
$password = ""; // Het wachtwoord voor de gebruiker (leeg is default bij XAMPP)
try{
    // Proberen verbinding te maken met de database en de verbinding opslaan in de variable con
    $con = new PDO("mysql:host=$host;dbname=$dbname",$user,$password);
} catch(PDOException $ex){
    // Als de verbinding maken mislukt
    $ex;
	}
	
if(isset($_POST["btnVerzend"]))
{
	$lijst = array();
	$lijst["Type"] = $_POST["Type"];
	$lijst["Maatschappij"] = $_POST["Maatschappij"];
	$lijst["Zitplaatsen"] = $_POST["Zitplaatsen"];
	
	//var_dump($lijst);
	
	foreach($lijst as $key => $value) {
		
		echo $key.": ".$value."<br/>";
	
		}
	$query = "INSERT INTO vliegtuig (Type, Maatschappij, Zitplaatsen)";
	$query .= "VALUES ('{$lijst["Type"]}', '{$lijst["Maatschappij"]}', '{$lijst["Zitplaatsen"]}')";

	
	$stm = $con->prepare($query);
	
	if($stm->execute()){
		echo "Succesvol!";
	} else {
		echo "Mislukt!";
	}
	
	
}
?>

<html>
	<head>
		<link rel="stylesheet" href="OntheflyStyles.css">
		<script src='https://kit.fontawesome.com/a076d05399.js'></script>
	</head>
	<body>
	<div id="nav">
			<a href="home.php" id="home" class="fas links"> &#xf015; Home</a>
			<ul>
				<a href="#dier" class='fas'> &#xf1b0; Toevoegen Vliegtuigen</a>
				<a href="#locatie" class='fas'> &#xf279; Toevoegen Vlucht</a>
				<a href="#info" class='fas'> &#xf129; Planning</a>
			</ul>
			<a href="#contact" id="contact" class="fas rechts"> &#xf0e0; Contact</a>
		</div>
	<form class="div1" method="POST">
		
		<pre>     Type:            	<input type="Text" name="Type"/></pre></br></br>
		<pre>     Maatschappij:    	<input type="Text" name="Maatschappij"/></pre></br></br>
		<pre>     Zitplaatsen:      <input type="Text" name="Zitplaatsen"/></pre></br></br>
		
		<INPUT TYPE="submit" name="btnVerzend" VALUE="Versturen" />
	</form>
	</body>
<html>