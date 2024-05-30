<?php echo $TitreDeLaPage;

if ($TitreDeLaPage != "Compte-rendu de votre réservation") {
    ?> <br><br><br><a href=" <?php echo site_url('horairesTraversees') ?> ">Retourner à l'écran des réservations</a> <?php
}