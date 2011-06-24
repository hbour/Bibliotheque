<?php include_once("dbconnex.php");
$idcom = connexobject("bibliotheque", "dbparam");

$q = strtolower($_REQUEST["q"]);
if (!$q) return;
$requeteDVD = "SELECT OUV_ID, OUV_Titre, OUV_Auteur FROM T_Ouvrages".
" WHERE OUV_Titre LIKE '%".$q."%' ".
" UNION ".
"SELECT OUV_ID, OUV_Titre, OUV_Auteur FROM T_Ouvrages".
" WHERE OUV_Auteur LIKE '%".$q."%' ";
$result = $idcom->query($requeteDVD);
if(!$result) {
	echo "<p>Erreur requête</p>";
} else {
	/*$row = $result->fetch_assoc();
	foreach ($row as $key=>$value) {
	if (strpos(strtolower($key), $q) !== false) {
		echo "$key\n";
	}*/
	while($row = $result->fetch_assoc()) {
		echo "<p><a href='indexArticle.php?id=".$row['OUV_ID']."'>".
		utf8_encode($row['OUV_Titre'])."</a>, <i>".utf8_encode($row['OUV_Auteur'])."</i></p>";
		
	}
}
$result->close();
?>