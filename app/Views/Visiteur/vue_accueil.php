<!DOCTYPE html>
<html lang="fr">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil</title>
</head>
<body>

<div class="container-fluid"></div>
<div class="row">
<div class="col-sm-4" style="background-color:lavender;"></div>
<div class="col-sm-8" style="background-color:lavenderblush;">

<div id="carousel" class="carousel slide" data-bs-ride="carousel">

<div class="carousel-indicators">
  <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active"></button>
  <button type="button" data-bs-target="#carousel" data-bs-slide-to="1"></button>
</div>
  
<div class="carousel-inner">
  <div class="carousel-item active">
  <?php echo '<img src="'.img_url('goofyboat.jpg').'" alt="image_manquante" class="d-block" style="width:25%">';?>
  </div>
  <div class="carousel-item">
  <?php echo '<img src="'.img_url('liveslug.jpg').'" alt="image_manquante" class="d-block" style="width:25%">';?>
  </div>
  <div class="carousel-item">
  <?php echo '<img src="'.img_url('barry.jpg').'" alt="image_manquante" class="d-block" style="width:25%">';?>
  </div>
  <div class="carousel-item">
  <?php echo '<img src="'.img_url('imageBateau.jpg').'" alt="image_manquante" class="d-block" style="width:25%">';?>
  </div>
</div>
</div>
</div>