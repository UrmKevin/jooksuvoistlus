<?php
global $yhendus;
require_once("konf.php");
//if(!empty($_REQUEST["muuda_id"])){
//    $kask=$yhendus->prepare('UPDATE jooksjad SET eesnimi="Daniil" WHERE id=?');
//    $kask->bind_param("s", $_REQUEST["muuda_id"]);
//    $kask->execute();
//}
if(isset($_REQUEST["lopptime"])){
    $kask=$yhendus->prepare("UPDATE jooksjad SET lopetamisaeg=? WHERE id=?");
    $kask->bind_param("si", $_REQUEST["lopptime"], $_REQUEST["id"]);
    $kask->execute();
}
$kask=$yhendus->prepare(
    "SELECT id, eesnimi, perenimi, alustamisaeg, esimene_vaheaeg, teine_vaheaeg, lopetamisaeg FROM jooksjad WHERE esimene_vaheaeg>0 AND teine_vaheaeg>0;");
$kask->bind_result($id, $eesnimi, $perenimi, $alustamisaeg,$esimene_vaheaeg, $teine_vaheaeg, $lopetamisaeg);
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
        <th>Muuda lõpetamisaeg</th>
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
			   <td>
			    <form action='?'>
			        <input type='hidden' name='id' value='$id' />
                    <input type='text' pattern='[0-2]{1}[0-9]{1}[:]{1}[0-9]{2}[:]{1}[0-9]{2}' name='lopptime' value='00:00:00'/>
                    <input type='submit' value='Sisesta tulemus' />
                </form></td>
			 </tr>
		   ";
    }
    ?>
</table>
</body>
</html>
