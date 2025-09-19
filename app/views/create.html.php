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
          <a href="#utiliser" class="btn btn-primary disabled">Démarrer avec ORessource</a>
        </div>
      </header>
    </div>
  </div>
  <div class="bg-light">
    <div class="container" style="max-width: 1050px;">
      <a name="accueil"></a>
      <div class="row">
        <div class="col"></div>
        <div class="col-8 justify-content-center mt-5">
          <?php foreach(\Flash::instance()->getMessages() as $message): ?>
            <div class="alert alert-<?php echo $message['status']?> alert-dismissable">
              <?php echo $message['text']; ?>
            </div>
          <?php endforeach;?>
          <form class="needs-validation" action="/generate" method="post" enctype="multipart/form-data">
            <div class="row g-3">
              <div class="col-8">
                <label for="nomRessourcerie" class="form-label">Le nom de votre ressourcerie</label>
                <input type="text" class="form-control" id="nomRessourcerie" name="nomRessourcerie" placeholder="Le Recyclodrome" value="" required>
                <div class="invalid-feedback">
                  Nom de la ressourcerie nécessaire
                </div>
              </div>

              <div class="col-8">
                <label for="adresseRessourcerie" class="form-label">Adresse de votre ressourcerie</label>
                <input type="text" class="form-control" id="adresseRessourcerie" name="adresseRessourcerie" placeholder="47 Rue d'Aubagne" required>
                <div class="invalid-feedback">
                  Adresse nécessaire
                </div>
              </div>
              <div class="col-4"></div>

              <div class="col-2">
                <label for="codePostal" class="form-label">Code postal</label>
                <input type="text" class="form-control" id="codePostal" name="codePostal" placeholder="13001" required>
                <div class="invalid-feedback">
                  Code postal nécessaire
                </div>
              </div>

              <div class="col-6">
                <label for="ville" class="form-label">Ville</label>
                <input type="text" class="form-control" id="ville" name="ville" placeholder="Marseille" required>
                <div class="invalid-feedback">
                  Ville nécessaire
                </div>
              </div>

              <div class="col-4"></div>

              <div class="col-12">
                <label for="email" class="form-label">Adresse email</small></label>
                <input type="email" class="form-control" id="email" name="email" placeholder="vous@maressourcerie.fr" required>
                <p class="text-muted">Cette adresse email vous servira d'identifiant administrateur.ice</p>
                <div class="invalid-feedback">
                  Merci d'entrer une adresse mail valide, qui sera votre moyen de connexion au logiciel
                </div>
              </div>

              <div class="col-12 mb-4">
                <label for="motDePasse" class="form-label">Mot de passe administrateur.ice</label>
                <div class="input-group has-validation">
                  <input type="password" class="form-control" id="motDePasse" name="motDePasse" placeholder="" required>
                  <div class="invalid-feedback">
                    Votre mot de passe est nécessaire.
                  </div>
                </div>
              </div>
              <?php if($from_backup):?>
                <div class="mt-4 col-12">
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="sauvegarde" checked disabled>
                    <label class="form-check-label" for="sauvegarde">Démarrer à partir d'une sauvegarde</label>
                  </div>
                </div>

                <div class="col-6">
                  <div class="">
                    <input class="form-control" type="file" id="fileInput" name="backupInput" required>
                  </div>
                </div>
              <?php endif;?>

            </div>
            <hr class="">
            <button class="w-100 btn btn-primary btn-lg" type="submit">Activer mon instance</button>
          </form>
        </div>
        <div class="col"></div>
      </div>
    </div>
  </div>
</body>

<script src="/js/jquery-3.7.1.min.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/main.js"></script>

</html>
