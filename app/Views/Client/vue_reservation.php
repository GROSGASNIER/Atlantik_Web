<?php echo $TitreDeLaPage;
echo form_open('reserverTraversee');
echo csrf_field(); ?>

<table border=1>
    <tr>
        <th></th>
        <th>Tarif en €</th>
        <th>Quantité</th>
    </tr>

    <?php foreach ($ as $ligne) {
        echo "<tr>";
        echo "<td>";
        echo $ligne->;
        echo "</td>";
        echo "<td>";
        echo $ligne->;
        echo "</td>";
        echo "<td>";
        echo ;
        echo "</td>";
        echo "</tr>";
    }
    echo form_submit('submit', 'Valider-Acheter');
    echo form_close();