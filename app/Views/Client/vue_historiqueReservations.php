<html>
<? echo $TitreDeLaPage; ?>
<body>
<table border=1>
    <tr>
        <th>n° de réservation</th>
        <th>Date réservation</th>
        <th>Départ</th>
        <th>Arrivée</th>
        <th>Date départ</th>
        <th>Total</th>
        <th>Payé</th>
    </tr>

<?php

foreach ($historique as $resultat) 
{
    echo "<tr>";
    echo "<td>";
    echo $resultat->noRes;
    echo "</td>";
    echo "<td>";
    echo $resultat->dateRes;
    echo "</td>";
    echo "<td>";
    echo $resultat->portDepart;
    echo "</td>";
    echo "<td>";
    echo $resultat->portArrivee;
    echo "</td>";
    echo "<td>";
    echo $resultat->dateDepart;
    echo "</td>";
    echo "<td>";
    echo $resultat->total;
    echo "</td>";
    echo "<td>";
    if ($resultat->paye == "1") { echo 'Oui'; }
    else { echo 'Non'; }
    echo "</td>";
    echo "</tr>";
}
echo $pager->links();