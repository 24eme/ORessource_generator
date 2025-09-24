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
      <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Accueil</a></li>
          <li class="breadcrumb-item"><a href="/demarrer">Hébergement</a></li>
          <li class="breadcrumb-item active" aria-current="page">Base de donnée</li>
        </ol>
      </nav>
      <div id="sauvegarde">
        <h2>Je démarre : </h2>
        <div class="row row-cols-1 row-cols-md-2 g-4">
          <div class="col">
            <div class="card text-center">
              <a href="/create"><img src="/images/eucalyp_new-database.png" height="200px" width="200px" class="" alt="auto hebergement"></a>
              <div class="card-body">
                <h5 class="card-title">A partir d'une base de donnée vierge</h5>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card text-center">
              <a href="/create?from_backup=true"><img src="/images/eucalyp_from-backup.png" height="200px" width="200px" class="" alt="hébergement en ligne"></a>
              <div class="card-body">
                <h5 class="card-title">A partir d'une sauvegarde</h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container" style="max-width: 1050px;">
    <footer class="text-center text-muted pt-2">
      Logiciel libre sous licence AGPL-3.0 : <a href="https://github.com/24eme/ORessource_generator" target="_blank">voir le code source</a>
      <br/>
      <a href="/faq">Consulter la FAQ</a>
    </footer>
  </div>
</body>

<script src="/js/jquery-3.7.1.min.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/main.js"></script>

</html>
