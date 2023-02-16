<?php
global $yhendus;
require_once("konf.php");
if(isSet($_REQUEST["sisestusnupp"])){
    $kask=$yhendus->prepare(
        "INSERT INTO jooksjad(eesnimi, perenimi) VALUES (?, ?)");
    $kask->bind_param("ss", $_REQUEST["eesnimi"], $_REQUEST["perekonnanimi"]);
    $kask->execute();
    $yhendus->close();
    header("Location: $_SERVER[PHP_SELF]?lisatudeesnimi=$_REQUEST[eesnimi]");
    exit();
}
?>
<!doctype html>
<html>
<head>
    <title>Jooksjad lisamine</title>
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
<h1>Jooksjad lisamine</h1>
<?php
if(isSet($_REQUEST["lisatudeesnimi"])){
    echo "Lisati $_REQUEST[lisatudeesnimi]";
}
if(isset($_POST['teoria'])) {
    include 'teooriaeksam.php';
}
if(isset($_REQUEST["lisatudeesnimi"])){
    echo "<meta http-equiv='refresh' content='0;url=protokoll.php'>";
}

?>
<form class="form" action="?">
    <dl>
        <dt>Eesnimi:</dt>
        <dd><input type="text" name="eesnimi" required="required" pattern="[a-zA-Z]{2,10}" /></dd>
        <br>
        <dt>Perekonnanimi:</dt>
        <dd><input type="text" name="perekonnanimi" required="required" pattern="[a-zA-Z]{2,10}" /></dd>
        <br>
        <dt><input type="submit" name="sisestusnupp" value="Sisesta" /></dt>
    </dl>
</form>
</body>
</html>