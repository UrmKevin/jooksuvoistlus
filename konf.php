<?php
$baasiaadress = "d113376.mysql.zonevs.eu";
$baasikasutaja = "d113376_kevin";
$baasiparool = "asdqwe123KUcom";
$baasinimi = "d113376_kevin";
$yhendus = new mysqli($baasiaadress, $baasikasutaja, $baasiparool, $baasinimi);
// <?php
// $baasiaadress = "localhost";
// $baasikasutaja = "urm21";
// $baasiparool = "asdqwe123KU";
// $baasinimi = "urm21";
// $yhendus = new mysqli($baasiaadress, $baasikasutaja, $baasiparool, $baasinimi);
// CREATE TABLE jooksjad(
//     id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
//     eesnimi varchar(50),
//     perenimi varchar(50),
//     alustamisaeg time DEFAULT 0,
//     esimene_vaheaeg time,
//     teine_vaheaeg time,
//     lopetamisaeg time
// );