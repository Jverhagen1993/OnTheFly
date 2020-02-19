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
				<a href="#vliegtuigen" class='fas'> Vliegtuigen</a>
				<a href="#vluchten" class='fas'> &#xf279; Vluchten</a>
				<a href="#planning" class='fas'> &#xf129; Planning</a>
			</ul>
			<a href="#contact" id="contact" class="fas rechts"> &#xf0e0; Contact</a>
		</div>
	<form method="POST">
		
		<div class="div1"><pre>     Passagiers:<input type="Text" name="Passagiers"/></pre></div>
		<div class="div2"><pre>     Vliegtuig:<input type="Text" name="Vliegtuig"/></pre></div>
		<div class="div3"><pre>     Bestemming:<input type="Text" name="Bestemming"/></pre></div>
		<div class="div4"><pre>     </pre></div>
		
		<div class="div5"><INPUT TYPE="submit" name="btnVerzend" VALUE="Versturen" /></div></br></br>
		<INPUT class='test3' TYPE="submit" name="btnOphalen" VALUE="Ophalen" /></br>
	</form>
	</body>
<html>

<?php
if(isset($_POST["btnOphalen"])) { 
	                echo "<table id='vliegtuigenTable' class='test2' style='width:75%'>
						<tr>
						<th>Passagiers</th>
						<th>Vliegtuig</th>
						<th>Bestemming</th>
						</tr>";
        $query = "SELECT * FROM vlucht ORDER BY Bestemming ASC";
        $stm = $con->prepare($query);
        if ($stm->execute()) {
            $resultaat = $stm->FetchAll(PDO::FETCH_OBJ);
            foreach ($resultaat as $vlucht){
			
			
                echo "
						<tr>
						<td>$vlucht->Passagiers</td>
						<td>$vlucht->Vliegtuig</td>
						<td>$vlucht->Bestemming</td>
						</tr>
						 ";
						
						
				

            }
			echo "</table>";
        } else echo "Er is iets mis gegaan met het ophalen van de data!";
    } 
if(isset($_POST["btnVerzend"]))
{
	$lijst = array();
	$lijst["Passagiers"] = $_POST["Passagiers"];
	$lijst["Vliegtuig"] = $_POST["Vliegtuig"];
	$lijst["Bestemming"] = $_POST["Bestemming"];
	
	//var_dump($lijst);
	
	foreach($lijst as $key => $value) {
		
		echo $key.": ".$value."<br/>";
	
		}
	$query = "INSERT INTO vlucht (Passagiers, Vliegtuig, Bestemming)";
	$query .= "VALUES ('{$lijst["Passagiers"]}', '{$lijst["Vliegtuig"]}', '{$lijst["Bestemming"]}')";

	
	$stm = $con->prepare($query);
	
	if($stm->execute()){
		echo "Succesvol!";
	} else {
		echo "Mislukt!";
	}
}
?>