<?php
global $yhendus;
require_once("konf.php");
if(isset($_REQUEST["muuda_id"])){
    echo "<meta http-equiv='refresh' content='0;url=jooksjad_admin.php'>";
}
if(isset($_REQUEST["nimi"])){
    $kask=$yhendus->prepare('UPDATE jooksjad SET eesnimi=? WHERE id=?');
    $kask->bind_param("si", $_REQUEST["nimi"], $_REQUEST["id1"]);
    $kask->execute();
}
if(isset($_REQUEST["perenimi"])){
    $kask=$yhendus->prepare('UPDATE jooksjad SET perenimi=? WHERE id=?');
    $kask->bind_param("si", $_REQUEST["perenimi"], $_REQUEST["id2"]);
    $kask->execute();
}
if(isset($_REQUEST["time1"])){
    $kask=$yhendus->prepare('UPDATE jooksjad SET alustamisaeg=? WHERE id=?');
    $kask->bind_param("si", $_REQUEST["time1"], $_REQUEST["id3"]);
    $kask->execute();
}
if(isset($_REQUEST["time2"])){
    $kask=$yhendus->prepare('UPDATE jooksjad SET esimene_vaheaeg=? WHERE id=?');
    $kask->bind_param("si", $_REQUEST["time2"], $_REQUEST["id4"]);
    $kask->execute();
}
if(isset($_REQUEST["time3"])){
    $kask=$yhendus->prepare('UPDATE jooksjad SET teine_vaheaeg=? WHERE id=?');
    $kask->bind_param("si", $_REQUEST["time3"], $_REQUEST["id5"]);
    $kask->execute();
}
if(isset($_REQUEST["time4"])){
    $kask=$yhendus->prepare('UPDATE jooksjad SET lopetamisaeg=? WHERE id=?');
    $kask->bind_param("si", $_REQUEST["time4"], $_REQUEST["id6"]);
    $kask->execute();
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
        <th>Lõpetama</th>
    </tr>
    <?php
    while($kask->fetch()){
        echo "
		     <tr>
			   <td>
                   <form action='?'>
                        <input type='hidden' name='id1' value='$id' />
                        <input type='text' name='nimi' required='required' pattern='[a-zA-Z]{2,10}' value='$eesnimi' />
                        <input type='submit' value='muuda' />
                   </form>
               </td>
			   <td>
                   <form action='?'>
                        <input type='hidden' name='id2' value='$id' />
                        <input type='text' name='perenimi' required='required' pattern='[a-zA-Z]{2,10}' value='$perenimi' />
                        <input type='submit' value='muuda' />
                   </form>
			   </td>
			   <td>
                   <form action='?'>
                        <input type='hidden' name='id3' value='$id' />
                        <input type='text' name='time1' required='required' pattern='[0-2]{1}[0-9]{1}[:]{1}[0-9]{2}[:]{1}[0-9]{2}' value='$alustamisaeg'/>
                        <input type='submit' value='muuda' />
                   </form>
               </td>
			   <td>
                   <form action='?'>
                        <input type='hidden' name='id4' value='$id' />
                        <input type='text' pattern='[0-2]{1}[0-9]{1}[:]{1}[0-9]{2}[:]{1}[0-9]{2}'' required='required' name='time2' value='$esimene_vaheaeg'/>
                        <input type='submit' value='muuda' />
                   </form>
               </td>
			   <td>
                   <form action='?'>
                        <input type='hidden' name='id5' value='$id' />
                        <input type='text' pattern='[0-2]{1}[0-9]{1}[:]{1}[0-9]{2}[:]{1}[0-9]{2}' required='required' name='time3' value='$teine_vaheaeg'/>
                        <input type='submit' value='muuda' />
                   </form>
               </td>
			   <td>
                   <form action='?'>
                        <input type='hidden' name='id6' value='$id' />
                        <input type='text' pattern='[0-2]{1}[0-9]{1}[:]{1}[0-9]{2}[:]{1}[0-9]{2}' required='required' name='time4' value='$lopetamisaeg'/>+
                        <input type='submit' value='muuda' />
                   </form>
               </td>
			   <td><a href='?muuda_id=$id'>Lõpetama</a></td>
			 </tr>
		   ";
    }
    ?>
</table>
</body>
</html>
