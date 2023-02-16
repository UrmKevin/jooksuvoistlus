<?php
global $yhendus;
require_once("konf.php");
if(isset($_REQUEST["time"])){
    $kask=$yhendus->prepare("UPDATE jooksjad SET alustamisaeg=?");
    $kask->bind_param("s", $_REQUEST["time"]);
    $kask->execute();
}
if(isset($_REQUEST['kustjooksja'])){
    global $yhendus;
    $kask=$yhendus->prepare('DELETE FROM jooksjad WHERE id=?');
    $kask->bind_param("s", $_REQUEST['kustjooksja']);
    $kask->execute();
}
$kask=$yhendus->prepare("SELECT id, eesnimi, perenimi, alustamisaeg FROM jooksjad");
$kask->bind_result($id, $eesnimi, $perekonnanimi, $alustamisaeg);
$kask->execute();
?>
<!doctype html>
<html>
<head>
    <title>Stardi protokoll</title>
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
<h1>Stardi protokoll</h1>
<table>
    <tr>
        <th>Eesnimi</th>
        <th>Perekonnanimi</th>
        <th>Alustamisaeg</th>
        <th>Kustamine</th>
    </tr>
    <?php
    while($kask->fetch()){
        echo "
		    <tr>
			  <td>$eesnimi</td>
			  <td>$perekonnanimi</td>
			  <td>$alustamisaeg</td>
			  <td><a href='?kustjooksja=$id'>kustutamine</a></td>
			</tr>
		  ";
    }
    ?>
</table>
<?php echo '
    <form action="?">
        <input type="text" pattern="[0-2]{1}[0-9]{1}[:]{1}[0-9]{2}[:]{1}[0-9]{2}" name="time" placeholder="Sisestage ainult 6 numbrit"/>
        <input type="submit" value="Sisesta tulemus" />
    </form>
    '; ?>
</body>
</html>
