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
          <li><a href="#accueil" class="nav-link px-2 link-secondary">Accueil</a></li>
          <li><a href="#fonctionnalites" class="nav-link px-2">Fonctionnalités</a></li>
          <li><a href="#projet" class="nav-link px-2">Le projet</a></li>
          <li><a href="#utiliser" class="nav-link px-2">Utiliser ORessource</a></li>
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
        <div class="col-8 justify-content-center text-center mt-5">
          <h1>ORessource</h1>
          <p class="lead mb-4">Une plateforme open source et communautaire de génération d'instances pour le logiciel ORessource.</p>
        </div>
        <div class="col"></div>
      </div>
      <div class="text-center mt-2">
        <img src="/images/capture_browser.png" class="img-fluid">
      </div>
    </div>
  </div>
  <div class="bg-light" style="border-bottom: 1px solid #ddd">
    <div class="container pt-4 pb-5" style="max-width: 1050px;">
      <a name="fonctionnalites"></a>
      <h2 class="mt-4">Les fonctionnalités</h2>
      <p>Découvrir des pages du logiciel :</p>
      <div class="row">
        <div id="carouselPhoto" class="carousel slide col-md">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="/images/carrousel1.png" class="d-block w-100" alt="vue de la page bilan">
            </div>
            <div class="carousel-item">
              <img src="/images/carrousel2.png" class="d-block w-100" alt="">
            </div>
            <div class="carousel-item">
              <img src="/images/carrousel3.png" class="d-block w-100" alt="">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselPhoto" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselPhoto" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
        <div class="col-md">
          <table class="table table-striped table-sm table-bordered">
            <thead>
              <tr>
                <th>Fonctionnalités</th>
                <th class="text-center col-1">ORessource</th>
              </tr>
            </thead>
            <tbody>
              <tr class="text-center">
                <td colspan="2">Gestion quotidienne</td>
              </tr>
              <tr>
                <td>Grille des prix</td>
                <td class="text-success text-center"><i class="bi bi-check-circle-fill"></i></td>
              </tr>
              <tr>
                <td>Bacs et chariots</td>
                <td class="text-success text-center"><i class="bi bi-check-circle-fill"></i></td>
              </tr>
              <tr>
                <td>Types de poubelles</td>
                <td class="text-success text-center"><i class="bi bi-check-circle-fill"></i></td>
              </tr>
              <tr class="text-center">
                <td colspan="2">Gestion et vérification</td>
              </tr>
              <tr>
                <td>Vérifier les collectes</td>
                <td class="text-success text-center"><i class="bi bi-check-circle-fill"></i></td>
              </tr>
              <tr>
                <td>Vérifier les sorties hors-boutique</td>
                <td class="text-success text-center"><i class="bi bi-check-circle-fill"></i></td>
              </tr>
              <tr>
                <td>Vérifier les ventes</td>
                <td class="text-success text-center"><i class="bi bi-check-circle-fill"></i></td>
              </tr>
              <tr class="text-center">
                <td colspan="2">Gestion des utilisateurs</td>
              </tr>
              <tr>
                <td>Utilisateurs</td>
                <td class="text-success text-center"><i class="bi bi-check-circle-fill"></i></td>
              </tr>
              <tr class="text-center">
                <td colspan="2">Recycleur et convention de sortie</td>
              </tr>
              <tr>
                <td>Entreprises de recyclage</td>
                <td class="text-success text-center"><i class="bi bi-check-circle-fill"></i></td>
              </tr>
              <tr>
                <td>Conventions avec les partenaires</td>
                <td class="text-success text-center"><i class="bi bi-check-circle-fill"></i></td>
              </tr>
              <tr class="text-center">
                <td colspan="2">Personnalisation</td>
              </tr>
              <tr>
                <td>Types de sorties hors-boutique</td>
                <td class="text-success text-center"><i class="bi bi-check-circle-fill"></i></td>
              </tr>
              <tr>
                <td>Types de collectes</td>
                <td class="text-success text-center"><i class="bi bi-check-circle-fill"></i></td>
              </tr>
              <tr>
                <td>Types d'objets collectés</td>
                <td class="text-success text-center"><i class="bi bi-check-circle-fill"></i></td>
              </tr>
              <tr>
                <td>Types de déchets evacués</td>
                <td class="text-success text-center"><i class="bi bi-check-circle-fill"></i></td>
              </tr>
              <tr>
                <td>Points de collecte</td>
                <td class="text-success text-center"><i class="bi bi-check-circle-fill"></i></td>
              </tr>
              <tr>
                <td>Points de sortie hors-boutique</td>
                <td class="text-success text-center"><i class="bi bi-check-circle-fill"></i></td>
              </tr>
              <tr>
                <td>Points de vente</td>
                <td class="text-success text-center"><i class="bi bi-check-circle-fill"></i></td>
              </tr>
              <tr>
                <td>Moyens de paiment</td>
                <td class="text-success text-center"><i class="bi bi-check-circle-fill"></i></td>
              </tr>
              <tr>
                <td>Localités</td>
                <td class="text-success text-center"><i class="bi bi-check-circle-fill"></i></td>
              </tr>
              <tr>
                <td>Configuration de Oressource</td>
                <td class="text-success text-center"><i class="bi bi-check-circle-fill"></i></td>
              </tr>
              <tr class="text-center">
                <td colspan="2">Bonus</td>
              </tr>
              <tr>
                <td>ORessource ne dépend pas d'une seule entreprise privée</td>
                <td class="text-success text-center"><i class="bi bi-check-circle-fill"></i></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="bg-white shadow-lg" style="border-bottom: 1px solid #ddd">
    <div class="container pt-4 pb-5" style="max-width: 1050px;">
      <a name="projet"></a>
      <h2 class="mt-4">Le projet</h2>
      <div class="row">
        Historique projet
        <br>
        <a href="https://github.com/mart1ver/oressource">ORessource</a>
        <br>
        Contact avec le recyclodrome
        <br>
        Le logiciel libre

      </div>
    </div>
  </div>
  <div style="border-bottom: 1px solid #ddd">
    <div class="container pt-4 pb-5" style="max-width: 992px;">
      <a name="utiliser"></a>
      <h2 class="mb-4 text-center mt-4">Démarrer avec ORessource</h2>
      <div class="text-center">
        <a href="/demarrer" type="button" class="btn btn-primary" >
          Créer
        </a>
      </div>
    </div>
  </div>

  <div class="bg-light" style="border-bottom: 1px solid #ddd">
    <div class="container pt-4 pb-5" style="max-width: 1050px;" >
      <h2 class="mt-4" id="quiSommesNous">Qui sommes nous ?</h2>
      <div class="row align-items-center">
        <div class="col-sm-2 text-center">
          <img style="max-height: 160px" class="img-fluid" src="https://www.24eme.fr/img/24eme.svg" />
        </div>
        <div class="col-sm-10">
          <p class="mt-4">Ce logiciel a été créé par le 24ème, une société coopérative spécialisée depuis 2010 dans le développement de logiciels libres pour des communautés de métiers et principalement dans le domaine viticole.</p>
          <a href="https://www.24eme.fr/" class="btn btn-link float-end">En savoir plus sur le 24ème</a>
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
