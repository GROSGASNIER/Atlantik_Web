<!DOCTYPE html>
<html lang="en">
<body>
<?php echo $TitreDeLaPage; ?>

<nav class="navbar bg-light">
  <ul class="navbar-nav">
    <?php
    foreach ($secteursRetournes as $secteur)
    {
      echo '<li class="nav-item">
      <a class="nav-link" href="horairesTraversees/'.$secteur->noSecteur.'">'. $secteur->nomSecteur. '</a>
      </li>';
    }
    ?>
  </ul>
</nav>

<?php if ($TitreDeLaPage != 'Veuillez séléctionner un secteur pour en choisir une liaison') {
  
  $options = [];

  foreach ($liaisonsRetournees as $liaison) {
    $options[$liaison->noLiaison] = $liaison->portDepart. '-' .$liaison->portArrivee;
  }  

  echo form_open('horairesTraversees');
  echo csrf_field(); 

  echo form_dropdown('txtnoLiaison', $options);

  echo '<input type="date" id="txtdate" name="birthday">';

  echo form_submit('submit', 'Afficher les traversées');
  echo form_close();

  if ($TitreDeLaPage == 'Liste des traversées') {
    ?> <table border=1>
    <tr>
        <th>N°</th>
        <th>Heure</th>
        <th>Bateau</th>        
    </tr>
    <?php
    foreach ($traverseesRetournees as $ligne) {
      echo "<tr>";
      echo "<td>";
      if(is_null(session()->get('prenom'))) { echo $ligne->noTraversee; }
      else { echo '<p><a href="reserverTraversee/' .$ligne->noTraversee. '">' .$ligne->noTraversee. '</a></p>'; }
      echo "</td>";
      echo "<td>";
      echo $ligne->heureDepart;
      echo "</td>";
      echo "<td>";
      echo $ligne->bateau;
      echo "</td>";
      echo "</tr>";
    }
    if(is_null(session()->get('prenom'))) { echo 'Vous devez être connecté pour pouvoir réserver'; }
    else { echo 'Pour réserver, cliquez sur un numéro de traversée'; }
  }
}