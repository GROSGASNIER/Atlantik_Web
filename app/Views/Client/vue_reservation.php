<html>
<?php echo '<h2>'.$TitreDeLaPage.'</h2>'; ?>
<div class="container-fluid">
<div class="row">
<div class="col-sm-2" style="background-color:lavender;"></div>
<div class="col-sm-3" style="background-color:lavender;">

<?php
echo '<br><br>Liaison : '.$traverseeEtLiaison[0]->portDepart. '-' .$traverseeEtLiaison[0]->portArrivee;
echo '<br>Traversée n°' .$traverseeEtLiaison[0]->numeroTraversee. ' le ' .$traverseeEtLiaison[0]->dateDepart;      //ne pas oublier de séparer heure et date

echo '<br><br>Nom : '.$client->NOM;
echo '<br>Adresse : '.$client->ADRESSE;
echo '<br>Code postal : '.$client->CODEPOSTAL;
echo '   Ville : '.$client->VILLE. '<br>';
echo '</div>';

echo '<div class="col-sm-4" style="background-color:lavender;">';

echo form_open('reserverTraversee');
echo csrf_field();
?>

<table class="table" border=1>
    <tr>
        <th></th>
        <th>Tarif en €</th>
        <th>Quantité</th>
    </tr>

    <?php $compteur = 0;
    foreach ($tarif as $ligne) {

        echo "<tr>";
        echo "<td>";
        echo $libelle[$ligne->lettreCategorie.$ligne->noType];
        echo "</td>";
        echo "<td>";
        echo '<input type="hidden" name="txtquantite['.$compteur.'][Reference]" value="'.$ligne->lettreCategorie.$ligne->noType.'" />'.$ligne->tarif;
        echo "</td>";
        echo "<td>";
        echo '<input type="number" name="txtquantite['.$compteur.'][Quantite]" min="0" value="0" />';
        echo "</td>";
        echo "</tr>";
        $compteur += 1;
    }
    echo '<br></div>
    <div class="col-sm-4" style="background-color:lavender;">';        //bon ici c'est relou le submit apparait en HAUT du tableau -_-
    echo form_submit('submit', 'Valider-Acheter');
    echo form_close();