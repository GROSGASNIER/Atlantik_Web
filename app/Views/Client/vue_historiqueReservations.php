<html>
<?php echo '<h2>'.$TitreDeLaPage.'</h2>'; ?>
<body>
<div class="container-fluid"></div>
<div class="row">
<div class="col-sm-3" style="background-color:lavender;"></div>
<div class="col-sm-6" style="background-color:lavenderblush;">

<table class="table" border=1>
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

foreach ($historique as $ligne) 
{
    echo "<tr>";
    echo "<td>";
    echo $ligne->noRes;
    echo "</td>";
    echo "<td>";
    echo $ligne->dateRes;
    echo "</td>";
    echo "<td>";
    echo $ligne->portDepart;
    echo "</td>";
    echo "<td>";
    echo $ligne->portArrivee;
    echo "</td>";
    echo "<td>";
    echo $ligne->dateDepart;
    echo "</td>";
    echo "<td>";
    echo $ligne->total;
    echo "</td>";
    echo "<td>";
    if ($ligne->paye == "1") { echo 'Oui'; }
    else { echo 'Non'; }
    echo "</td>";
    echo "</tr>";
}
echo $pager->links();