<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ORessource - Plateforme open source de génération d'instance du logiciel ORessource pour les ressourceries</title>
  <meta name="description" content="Plateforme open source de génération d'instance du logiciel ORessource pour les ressourceries" />
  <link rel="icon" type="image/png" sizes="16x16" rel="noopener" target="_blank" href="/images/favicons/favicon_16x16.png">
  <link rel="icon" type="image/png" sizes="32x32" rel="noopener" target="_blank" href="/images/favicons/favicon_32x32.png">
  <link rel="apple-touch-icon" sizes="180x180" rel="noopener" target="_blank" href="/images/favicons/apple_touch_icon_180x180.png">
  <link rel="manifest" href="/images/favicons/site.webmanifest">
  <link href="/css/bootstrap.min.css" rel="stylesheet" />
  <link href="/css/bootstrap-icons.min.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="/css/common.css" rel="stylesheet" />
</head>
<body>
  <div class="bg-white" style="border-bottom: 1px solid #ddd">
    <div class="container" style="max-width: 1050px;">
      <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3">
        <div class="col-md-1 mb-2 mb-md-0">
          <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
            <img src="/images/logo_oressource.png" height="80" />
          </a>
        </div>

        <ul class="nav col-md-8 col-md-auto mb-2 justify-content-center mb-md-0">
          <li><a href="/#accueil" class="nav-link px-2 link-secondary">Accueil</a></li>
          <li><a href="/#fonctionnalites" class="nav-link px-2">Fonctionnalités</a></li>
          <li><a href="/#projet" class="nav-link px-2">Le projet</a></li>
          <li><a href="/#utiliser" class="nav-link px-2">Utiliser ORessource</a></li>
          <li><a href="/#quiSommesNous" class="nav-link px-2">Qui sommes nous ?</a></li>
        </ul>
        <div class="col-md-3 text-end">
          <a href="#utiliser" class="btn btn-primary">Démarrer avec ORessource</a>
        </div>
      </header>
    </div>
  </div>
  <div class="bg-light">
    <div class="container" style="max-width: 1050px;">
      <div class="card">
        <h5 class="card-header">Récapitulatif de votre instance</h5>
        <div class="card-body">
          <h5 class="card-title">Nom : <?php echo $SESSION['nomRessourcerie'];?></h5>
          <h5 class="card-title">Adresse : <?php echo $SESSION['adresseRessourcerie'];?>, <?php echo $SESSION['codePostal'].' '.$SESSION['ville'];?></h5>
          <h5 class="card-title">Email: <?php echo $SESSION['email'];?></h5>
          <h5 class="card-title">Mot de passe: <?php echo $SESSION['motDePasse'];?></h5>
          <a href="/redirect" class="btn btn-primary">Accéder à votre instance</a>
        </div>
      </div>
    </div>
  </div>
</body>

<script src="/js/jquery-3.7.1.min.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/main.js"></script>

</html>
