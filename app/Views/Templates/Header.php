<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bootstrap Navbar</title>
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="accueil">Accueil</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="liaisons">Afficher les liaisons</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="horairesTraversees">Afficher les horaires des traversées - Réservation</a>
      </li>
      <li class="nav-item dropdown">
      <?php
        if(!is_null(session()->get('prenom'))) {
          echo '<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">' .session()->get("prenom"). '</a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="historique">Historique des réservations</a>
                  <a class="dropdown-item" href="modifierCompte">Modifier les informations du compte</a>
                  <a class="dropdown-item" href="deconnection">Se déconnecter</a>
                </div>'; }
        else {
          echo '<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Compte</a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="creerUnCompte">Créer un compte</a>
                  <a class="dropdown-item" href="connection">Se connecter</a>
                </div>'; } ?>        
      </li>
    </ul>
  </div>
</nav>