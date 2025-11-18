
    <div class="container" style="max-width: 1050px;">
      <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="mt-2">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Accueil</a></li>
          <li class="breadcrumb-item"><a href="/demarrer">Hébergement</a></li>
          <li class="breadcrumb-item"><a href="/webhost">Base de donnée</a></li>
          <li class="breadcrumb-item active" aria-current="page">Informations</li>
        </ol>
      </nav>
      <a name="accueil"></a>
      <div class="row">
        <div class="col-2"></div>
        <div id="mainInfo" class="col-8 justify-content-center">
            <h2 class="mb-4">Informations de la ressourcerie</h2>
          <?php foreach(\Flash::instance()->getMessages() as $message): ?>
            <div class="alert alert-<?php echo $message['status']?> alert-dismissable">
              <?php echo $message['text']; ?>
            </div>
          <?php endforeach;?>
          <form id="formInfo" class="needs-validation" action="/dataCheck" method="post" enctype="multipart/form-data">
            <div class="row g-3">
              <div class="col-8">
                <label for="nomRessourcerie" class="form-label">Le nom de votre ressourcerie</label>
                <input type="text" class="form-control" id="nomRessourcerie" name="nomRessourcerie" placeholder="La Brigaille" value="<?php if (array_key_exists('nomRessourcerie', $SESSION)){echo $SESSION['nomRessourcerie'];} ?>" required>
                <div class="invalid-feedback">
                  Nom de la ressourcerie nécessaire
                </div>
              </div>

              <div class="col-8">
                <label for="adresseRessourcerie" class="form-label">Adresse de votre ressourcerie</label>
                <input type="text" class="form-control" id="adresseRessourcerie" name="adresseRessourcerie" placeholder="47 Rue d'Aubagne" value="<?php if (array_key_exists('adresseRessourcerie', $SESSION)){echo $SESSION['adresseRessourcerie'];} ?>" required>
                <div class="invalid-feedback">
                  Adresse nécessaire
                </div>
              </div>
              <div class="col-4"></div>

              <div class="col-2">
                <label for="codePostal" class="form-label">Code postal</label>
                <input type="text" class="form-control" id="codePostal" name="codePostal" placeholder="13001" value="<?php if (array_key_exists('codePostal', $SESSION)){echo $SESSION['codePostal'];} ?>" required>
                <div class="invalid-feedback">
                  Code postal nécessaire
                </div>
              </div>

              <div class="col-6">
                <label for="ville" class="form-label">Ville</label>
                <input type="text" class="form-control" id="ville" name="ville" placeholder="Marseille" value="<?php if (array_key_exists('ville', $SESSION)){echo $SESSION['ville'];} ?>" required>
                <div class="invalid-feedback">
                  Ville nécessaire
                </div>
              </div>

              <div class="col-4"></div>

              <div class="col-12">
                <label for="email" class="form-label">Adresse email</small></label>
                <input type="email" class="form-control" id="email" name="email" placeholder="vous@maressourcerie.fr" value="<?php if (array_key_exists('emailRessourcerie', $SESSION)){echo $SESSION['emailRessourcerie'];} ?>" required>
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

               <div class="mt-4 col-12">
                    <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="sauvegarde" <?php if (array_key_exists('from_backup', $_GET) && $_GET['from_backup'] == true) {echo "checked";} ?>>
                    <label class="form-check-label" for="sauvegarde">Démarrer à partir d'une sauvegarde</label>
                    </div>
               </div>

            <div id="divFileInput" class="col-6" <?php if (! (array_key_exists('from_backup', $_GET) && $_GET['from_backup'] == true)) {echo "hidden";} ?>>
                  <div class="">
                    <input class="form-control" type="file" id="fileInput" name="backupInput">
                  </div>
                <input id="fromBackup" type="hidden" name="from_backup" value="">
            </div>
            <div class="col-12 mb-4">
                <hr />
                <button class="btn btn-primary btn-lg float-end" type="submit">Valider mes informations</button>
            </div>
            </div>
        </form>
        <div class="col"></div>
      </div>
    </div>

    <script>
      document.getElementById("sauvegarde").addEventListener("click", function (e) {
        var divFileInput = document.getElementById("divFileInput");
        if (e.currentTarget.checked == true) {
          divFileInput.hidden = false;
          document.getElementById("fileInput").required = true;
        } else {
          divFileInput.hidden = true;
          document.getElementById("fileInput").required = false;
        }
      });

      document.getElementById("formInfo").addEventListener("submit", function (e) {

        if (document.getElementById("sauvegarde").checked == true) {
          document.getElementById("fromBackup").value = true;
        } else {
          console.log("beip");
          document.getElementById("fromBackup").value = false;
        }
      });

    </script>
