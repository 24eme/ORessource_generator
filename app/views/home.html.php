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
            <img src="/images/logo_oressource.svg" height="80" />
          </a>
        </div>

        <ul class="nav col-md-8 col-md-auto mb-2 justify-content-center mb-md-0">
          <li><a href="#accueil" class="nav-link px-2 link-secondary">Accueil</a></li>
          <li><a href="#projet" class="nav-link px-2">Le projet</a></li>
          <li><a href="#fonctionnalites" class="nav-link px-2">Fonctionnalités</a></li>
          <li><a href="#quiSommesNous" class="nav-link px-2">Qui sommes nous ?</a></li>
        </ul>

        <div class="col-md-3 text-end">
          <a href="/demarrer" class="btn btn-primary">Démarrer avec ORessource</a>
        </div>
      </header>
    </div>
  </div>
  <div class="bg-light">
    <div class="container" style="max-width: 1050px;">
      <a name="accueil"></a>
      <div class="row">
        <div class="col"></div>
        <div class="col-10 justify-content-center text-center mt-5">
          <h2>Hébergement du logiciel libre ORessource</h2>
          <p class="lead mb-4 mt-3">Logiciel de caisse et de bilan écologique pour la gestion en ligne d'une ressourcerie</p>
        </div>
        <div class="col"></div>
      </div>
      <div class="text-center mt-2">
        <img src="/images/capture_browser.png" class="img-fluid">
      </div>
    </div>
  </div>
  <div class="bg-white shadow-lg" style="border-bottom: 1px solid #ddd; border-top: 1px solid #ddd">
    <div class="container pt-4 pb-5" style="max-width: 1050px;">
      <a name="projet"></a>
      <h2 class="mt-4 mb-4">Le projet Oressource</h2>
      <p>
        ORessource est un logiciel libre (https://fr.wikipedia.org/wiki/Logiciel_libre) qui a été codé par @mart1ver et @darnuria (https://github.com/mart1ver/oressource) en 2014 sur une inspiration de @olive de ubuntu-fr .<br /><br />
        Il permet de gérer une ressourcerie, actuellement il est utilisé par environ 11% des ressourceries en France (données de 2022).
      </p>
      <div class="row">
        <div class="col-sm-6 mt-4">
          <div class="card shadow-sm">
            <div class="card-header">
              <i class="bi bi-window-split"></i> Ergonomie
            </div>
            <div class="card-body">
              <h5 class="card-title">Aide à la saisie</h5>
              <p class="card-text">Saisie en un écran, détection des allergènes et addifits lors de la saisie des ingrédients, calcul simplifié des valeurs nutrionnelles. Tout au long de la saisie le résultat est visible en temps réél.<br /></p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 mt-4">
          <div class="card shadow-sm">
            <div class="card-header">
              <i class="bi bi-patch-check"></i> Conforme à la législation
            </div>
            <div class="card-body">
              <h5 class="card-title">Respect du réglement européens</h5>
              <p class="card-text">Le logiciel est adapté et conçu pour respecter la mise en oeuvre prévu par la commission européenes dans le règlement (UE) <a href="https://eur-lex.europa.eu/legal-content/FR/TXT/PDF/?uri=OJ:C_202301190">n° 2023/1190</a>.<br /></p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 mt-4">
          <div class="card shadow-sm">
            <div class="card-header">
              <i class="bi bi-opencollective"></i> Open source et communautaire
            </div>
            <div class="card-body">
              <h5 class="card-title">L'open source au service de la durabilité</h5>
              <p class="card-text">Le projet peut être utilisé sur nutri.vin directement, sur une plateforme mis à disposition par une interprofession ou une ODG, ou librement installé sur son propre serveur et nom de domaine, pour avoir la maitrîse du QR Code dans le temps.</p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 mt-4">
          <div class="card shadow-sm">
            <div class="card-header">
              <i class="bi bi-clock-history"></i> Pérénité
            </div>
            <div class="card-body">
              <h5 class="card-title">Pérénité</h5>
              <p class="card-text">Le projet ne dépend pas d'une seule entreprise privée et de sa viabilité économique. Il est financé par une interprofession et une entreprise coopérative. Les QRCodes déjà créés peuvent être facilement migrés sur une autre instance.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="bg-light" style="border-bottom: 1px solid #ddd">
    <div class="container pt-4 pb-5" style="max-width: 1050px;">
      <a name="fonctionnalites"></a>
      <h2 class="mt-4 mb-3">Plateforme d'hébergement</h2>
      <p>Nous avons mise en place cette plateforme pour vous proposer d'utiliser ce logiciel en ligne sans avoir à l'installer.</p>
      <table class="table table-striped table-sm table-bordered">
  <thead>
    <tr>
      <th class="col-6"></th>
      <th class="text-center col-3">Auto hébergement</th>
      <th class="text-center col-3">Hébérgé sur cette plateforme</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Backup</td>
      <td class="text-center">A faire soi même</td>
      <td class="text-success text-center"><i class="bi bi-check-circle-fill"></i> Réalisé par la plateforme </td>
    </tr>
  </tbody>
</table>
    <div class="text-center mt-5">
      <a href="/demarrer" class="btn btn-primary" >
        Démarrer avec ORessource
      </a>
    </div>
  </div>
</div>

  <div class="bg-white" style="border-bottom: 1px solid #ddd">
    <div class="container pt-4 pb-5" style="max-width: 1050px;" >
      <h2 class="mt-4" id="quiSommesNous">Qui sommes nous ?</h2>
      <div class="row align-items-center">
        <div class="col-sm-2 text-center">
          <img style="max-height: 160px" class="img-fluid" src="https://www.24eme.fr/img/24eme.svg" />
        </div>
        <div class="col-sm-10">
          <p class="mt-4">Ce plateforme est financée et gérée par le 24ème, une société coopérative spécialisée depuis 2010 dans le développement de logiciels libres pour des communautés de métiers et principalement dans le domaine viticole.</p>
          <a href="https://www.24eme.fr/" class="btn btn-link float-end">En savoir plus sur le 24ème</a>
        </div>
      </div>
    </div>
  </div>

  <div class="bg-light">
  <div class="container" style="max-width: 1050px;">
    <footer class="text-center text-muted pt-2 pb-2">
      Logiciel libre sous licence AGPL-3.0 : <a href="https://github.com/24eme/ORessource_generator" target="_blank">voir le code source</a>
    </footer>
  </div>
</div>
</body>

<script src="/js/jquery-3.7.1.min.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/main.js"></script>
</html>
