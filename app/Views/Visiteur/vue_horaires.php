<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<?php echo $TitreDeLaPage; ?>

<nav class="navbar bg-light">
  <ul class="navbar-nav">
    <?php
    foreach ($secteursRetournes as $secteur)
    {
      echo '<li class="nav-item">
      <a class="nav-link" href="horaires/'.$secteur->noSecteur.'">'. $secteur->nomSecteur. '</a>
      </li>';
    }
    ?>
  </ul>
</nav>

<?php if ($TitreDeLaPage == 'Veuillez séléctionner une liaison et une date')
{
  $options = [];

  foreach ($liaisonsRetournees as $liaison)
  {
    $options[$liaison->noLiaison] = $liaison->portDepart. '-' .$liaison->portArrivee;
  }
  

  echo form_open('horairesTraversees');
  echo csrf_field(); 

  echo form_dropdown('txtnoLiaison', $options);

  echo form_dropdown('txtdate');    

  echo form_submit('submit', 'Afficher les traversées');
  echo form_close();
}