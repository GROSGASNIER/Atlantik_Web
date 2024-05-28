<html>
    
<? echo $TitreDeLaPage; ?>
<body>
<div class="container-fluid"></div>
<div class="row">
<div class="col-sm-2" style="background-color:lavender;"></div>
<div class="col-sm-8" style="background-color:lavender;">

<table class="table" border=1>
    <tr>
        <th>lettre</th>
        <th>libelleCategorie</th>
        <th>lettre + numeroType</th>
        <th>libelleType</th>
        <th>dateDebut</th>
        <th>dateFin</th>
        <th>tarifs</th>
    </tr>

<?php

foreach ($listeTarifs as $tarif) 
{
    echo "<tr>";
    echo "<td>";
    echo $tarif->lettre;
    echo "</td>";
    echo "<td>";
    echo $tarif->libelleCategorie;
    echo "</td>";
    echo "<td>";
    echo $tarif->lettre.$tarif->numeroType;
    echo "</td>";
    echo "<td>";
    echo $tarif->libelleType;
    echo "</td>";
    echo "<td>";
    echo $tarif->dateDebut;
    echo "</td>";
    echo "<td>";
    echo $tarif->dateFin;
    echo "</td>";
    echo "<td>";
    echo $tarif->tarif;
    echo "</td>";
    echo "</tr>";
}