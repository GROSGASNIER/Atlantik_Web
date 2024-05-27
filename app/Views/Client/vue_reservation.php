<?php echo '<h2>'.$TitreDeLaPage.'</h2>';
echo form_open('reserverTraversee');
echo csrf_field();
//echo '<br><br>Liaison : '.$traverseeEtLiaison->portDepart. '-' .$traverseeEtLiaison->portArrivee;
//echo '<br>Traversée n°' .$traverseeEtLiaison->numeroTraversee. ' le ' .$traverseeEtLiaison->dateDepart;      //ne pas oublier de séparer heure et date

echo '<br><br>Nom : '.$client->NOM;
echo '<br>Adresse : '.$client->ADRESSE;
echo '<br>Code postal : '.$client->CODEPOSTAL;
echo '   Ville : '.$client->VILLE. '<br>';?>

<table border=1>
    <tr>
        <th></th>
        <th>Tarif en €</th>
        <th>Quantité</th>
    </tr>

    <?php foreach ($tarif as $ligne) {
        echo "<tr>";
        echo "<td>";
        echo $libelle[$ligne->lettreCategorie.$ligne->noType];
        echo "</td>";
        echo "<td>";
        echo $ligne->tarif;
        echo "</td>";
        echo "<td>";
        echo 'a';
        echo "</td>";
        echo "</tr>";
    }
    echo '<br>';        //bon ici c'est relou le submit apparait en HAUT du tableau -_-
    echo form_submit('submit', 'Valider-Acheter');
    echo form_close();