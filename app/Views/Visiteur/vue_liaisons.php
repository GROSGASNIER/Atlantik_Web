<html>

<? echo $TitreDeLaPage; ?>
<body>
<div class="container-fluid"></div>
<div class="row">
<div class="col-sm-3" style="background-color:lavender;"></div>
<div class="col-sm-6" style="background-color:lavenderblush;">

<table class="table" border=1>
    <tr>
        <th>Secteur</th>
        <th>Code liaison</th>
        <th>Distance en milles marin</th>
        <th>Port de départ</th>
        <th>Port d’arrivée</th>
    </tr>
<?php
    $secteurPrecedent = null;
    foreach ($listeLiaisons as $liaison) 
    {
        echo "<tr>";
        echo "<td>";
        if ($secteurPrecedent != $liaison->secteur) { echo $liaison->secteur; }
        else { echo ''; }
        $secteurPrecedent = $liaison->secteur;
        echo "</td>";
        echo "<td>";
        echo '<p><a href="'.site_url('tarifs/' .$liaison->code). '">' .$liaison->code. '</a></p>';
        echo "</td>";
        echo "<td>";
        echo $liaison->distance;
        echo "</td>";
        echo "<td>";
        echo $liaison->portDepart;
        echo "</td>";
        echo "<td>";
        echo $liaison->portArrivee;
        echo "</td>";
        echo "</tr>";
    }
?>
</div>