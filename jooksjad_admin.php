<?php
global $yhendus;
require_once("konf.php");
if(isset($_REQUEST["muuda_id"])){
    echo "<meta http-equiv='refresh' content='0;url=muuda.php'>";
}
$kask=$yhendus->prepare(
    "SELECT id, eesnimi, perenimi, alustamisaeg, esimene_vaheaeg, teine_vaheaeg, lopetamisaeg FROM jooksjad;");
$kask->bind_result($id, $eesnimi, $perenimi, $alustamisaeg, $esimene_vaheaeg, $teine_vaheaeg, $lopetamisaeg);
$kask->execute();
?>
<!doctype html>
<html>
<head>
    <title>Lõpetamine</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <nav class="navMenu">
        <a class="active" href="jooksjad_lisamine.php">Jooksjad lisamine</a>
        <a href="protokoll.php">Stardi protokoll</a>
        <a href="vaheaeg.php">Vaheagade lisamiseks</a>
        <a href="lõpuprotokoll.php">Lõpuprotokoll</a>
        <a href="auhinnad.php">Auhinnad leht</a>
        <a href="jooksjad_admin.php">Admin leht</a>
        <div class="dot"></div>
    </nav>
</header>
<h1>Jooksjad admin leht</h1>
<table>
    <tr>
        <th>Eesnimi</th>
        <th>Perekonnanimi</th>
        <th>Alustamisaeg</th>
        <th>Esimene vaheaeg</th>
        <th>Teine vaheaeg</th>
        <th>Lõpetamisaeg</th>
        <th>Muudamine</th>
    </tr>
    <?php
    while($kask->fetch()){
        echo "
		     <tr>
			   <td>$eesnimi</td>
			   <td>$perenimi</td>
			   <td>$alustamisaeg</td>
			   <td>$esimene_vaheaeg</td>
			   <td>$teine_vaheaeg</td>
			   <td>$lopetamisaeg</td>
			   <td><a href='?muuda_id=$id'>Muuda</a></td>
			 </tr>
		   ";
    }
    ?>
</table>
</body>
</html>
