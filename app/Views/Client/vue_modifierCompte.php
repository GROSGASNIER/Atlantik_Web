<h2><?php echo $TitreDeLaPage ?></h2>
<?php
  if ($TitreDeLaPage=='Saisie incorrecte, veuillez réessayer')
    echo service('validation')->listErrors();
  
  echo form_open('modifierCompte');
  echo csrf_field(); 

  echo '<br>' .form_label('Nom','txtNom');
  echo form_input('txtNom', $txtNom, set_value('txtNom'));

  echo '<br>' .form_label('Prénom','txtPrenom');
  echo form_input('txtPrenom', $txtPrenom, set_value('txtPrenom'));

  echo '<br>' .form_label('Ville','txtVille');
  echo form_input('txtVille', $txtVille, set_value('txtVille')); 

  echo '<br>' .form_label('Code postal','txtCodePostal');
  echo form_input('txtCodePostal', $txtCodePostal, set_value('txtCodePostal'));   

  echo '<br>' .form_label('Adresse','txtAdresse');
  echo form_input('txtAdresse', $txtAdresse, set_value('txtAdresse')); 

  echo '<br>' .form_label('Numéro de téléphone mobile','txtNumMobile');
  echo form_input('txtNumMobile', $txtNumMobile, set_value('txtNumMobile'));   

  echo '<br>' .form_label('Numéro de téléphone fixe','txtNumFixe');
  echo form_input('txtNumFixe', $txtNumFixe, set_value('txtNumFixe')); 

  echo '<br>' .form_label('Addresse mel','txtMel');
  echo form_input('txtMel', $txtMel, set_value('txtMel')); 

  echo '<br>' .form_label('Mot de passe','txtMDP');
  echo form_password('txtMDP', $txtMDP, set_value('txtMDP'));

  echo '<br>' .form_label('Veuillez onfirmer le mot de passe','txtMDPConfirmation');
  echo form_password('txtMDPConfirmation', $txtMDP, set_value('txtMDP'));

  echo form_submit('submit', 'Modifier mon compte');
  echo form_close();