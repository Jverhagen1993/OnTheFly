<?php
include ("config.php");

$query = "SELECT * FROM smaken"
$stm = $conn->prepare($query);
if($stm->execute())
	{
		$res = $stm->fetchAll(PDO::FETCH_OBJ);
		foreach($res as $smaak)
		{
			echo "<a href='newpage.php?smid=".$smaak->smid."'>".$smaak->smaak;"</a>
		}
	}

?>
<form>
	<input type="Text" name="test"/>
	<input type="submit" name="button"/>
</form>