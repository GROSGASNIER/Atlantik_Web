<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<body>
<?php echo $TitreDeLaPage; ?>

<div class="container-fluid"></div>
<div class="row">
<div class="col-sm-2" style="background-color:lavender;">

  <nav class="navbar bg-light">
    <ul class="navbar-nav">
      <?php
      foreach ($secteursRetournes as $secteur)
      {
        echo '<li class="nav-item">
        <a class="nav-link" href="'.site_url('horairesTraversees/'.$secteur->noSecteur).'">'. $secteur->nomSecteur. '</a>
        </li>';
      }
      ?>
    </ul>
  </nav>
</div>
<div class="col-sm-6" style="background-color:lavenderblush;">
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
    echo form_close().'<br>';

    if ($TitreDeLaPage == 'Liste des traversées') {
      ?> <table class="table" border=1>
      <thread>
        <tr>                    
            <th scope="col">N°</th>
            <th scope="col">Heure</th>
            <th scope="col">Bateau</th>        
        </tr>
      </thread>
      <tbody>
      <?php
      foreach ($traverseesRetournees as $ligne) {
        echo "<tr>";
        echo "<td>";
        if(is_null(session()->get('prenom'))) { echo $ligne->noTraversee; }
        else { echo '<p><a href="'.site_url('reserverTraversee/' .$ligne->noTraversee). '">' .$ligne->noTraversee. '</a></p>'; }
        echo "</td>";
        echo "<td>";
        echo $ligne->heureDepart;
        echo "</td>";
        echo "<td>";
        echo $ligne->bateau;
        echo "</td>";
        echo "</tr>";
      }
      echo '</tbody>';
      if(is_null(session()->get('prenom'))) { echo 'Vous devez être connecté pour pouvoir réserver'; }
      else { echo 'Pour réserver, cliquez sur un numéro de traversée'; }
    }
}