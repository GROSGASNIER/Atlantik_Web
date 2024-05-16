<h2><?php echo $TitreDeLaPage ?></h2>
<?php
  if ($TitreDeLaPage=='Saisie incorrecte')
    echo service('validation')->listErrors();
  /* set_value : en cas de non validation, les données déjà saisies sont réinjectées dans le formulaire*/
  echo form_open('creerUnCompte');
  echo csrf_field(); 

  echo '<br>' .form_label('Nom','txtNom');
  echo form_input('txtNom', set_value('txtNom')); 

  echo '<br>' .form_label('Prénom','txtPrenom');
  echo form_input('txtPrenom', set_value('txtPrenom'));

  echo '<br>' .form_label('Ville','txtVille');
  echo form_input('txtVille', set_value('txtVille')); 

  echo '<br>' .form_label('Code postal','txtCodePostal');
  echo form_input('txtCodePostal', set_value('txtCodePostal'));   

  echo '<br>' .form_label('Adresse','txtAdresse');
  echo form_input('txtAdresse', set_value('txtAdresse')); 

  echo '<br>' .form_label('Numéro de téléphone mobile','txtNumMobile');
  echo form_input('txtNumMobile', set_value('txtNumMobile'));   

  echo '<br>' .form_label('Numéro de téléphone fixe','txtNumFixe');
  echo form_input('txtNumFixe', set_value('txtNumFixe')); 

  echo '<br>' .form_label('Addresse mel','txtMel');
  echo form_input('txtMel', set_value('txtMel')); 

  echo '<br>' .form_label('Mot de passe','txtMDP');
  echo form_input('txtMDP', set_value('txtMDP'));

  echo '<br>' .form_label('Veuillez onfirmer le mot de passe','txtMDPConfirmation');
  echo form_input('txtMDPConfirmation', set_value('txtMDPConfirmation'));

  echo form_submit('submit', 'Créer mon compte');
  echo form_close();