<?php
global $yhendus;
require_once("konf.php");
if(isset($_REQUEST["time1"])){
    $kask=$yhendus->prepare("UPDATE jooksjad SET esimene_vaheaeg=? WHERE id=?");
    $kask->bind_param("si", $_REQUEST["time1"], $_REQUEST["id"]);
    $kask->execute();
}
if(isset($_REQUEST["time2"])){
    $kask=$yhendus->prepare("UPDATE jooksjad SET teine_vaheaeg=? WHERE id=?");
    $kask->bind_param("si", $_REQUEST["time2"], $_REQUEST["id"]);
    $kask->execute();
}
$kask=$yhendus->prepare("SELECT id, eesnimi, perenimi, esimene_vaheaeg, teine_vaheaeg FROM jooksjad");
$kask->bind_result($id, $eesnimi, $perenimi, $esimene_vaheaeg, $teine_vaheaeg);
$kask->execute();
?>
<!doctype html>
<html>
<head>
    <title>Vaheagade lisamiseks</title>
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
<h1>Vaheagade lisamiseks</h1>
<table>
    <tr>
        <th>Eesnimi</th>
        <th>Perekonnanimi</th>
        <th>Esimene vaheaeg</th>
        <th>Teine vaheaeg</th>
        <th>Muuda esimene vaheaeg</th>
        <th>Muuda teine vaheaeg</th>
    </tr>
    <?php
    while($kask->fetch()){
        echo "
		    <tr>
			  <td>$eesnimi</td>
			  <td>$perenimi</td>
			  <td>$esimene_vaheaeg</td>
			  <td>$teine_vaheaeg</td>
			  <td><form action='?'>
			    <input type='hidden' name='id' value='$id' />
                <input type='text' pattern='[0-2]{1}[0-9]{1}[:]{1}[0-9]{2}[:]{1}[0-9]{2}' name='time1' value='00:00:00'/>
                <input type='submit' value='Sisesta tulemus' />
              </form></td>
			  <td><form action='?'>
			    <input type='hidden' name='id' value='$id' />
                <input type='text' pattern='[0-2]{1}[0-9]{1}[:]{1}[0-9]{2}[:]{1}[0-9]{2}' name='time2' value='00:00:00'/>
                <input type='submit' value='Sisesta tulemus' />
              </form></td>
			</tr>
		  ";
    }
    ?>
</table>
</body>
</html>

