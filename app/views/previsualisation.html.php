      <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="mt-2">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Accueil</a></li>
          <li class="breadcrumb-item"><a href="/demarrer">Hébergement</a></li>
          <li class="breadcrumb-item"><a href="/webhost">Base de donnée</a></li>
          <li class="breadcrumb-item"><a href="/create<?php if (array_key_exists('from_backup', $SESSION)){echo '?from_backup=true';}?>">Informations</a></li>
          <li class="breadcrumb-item active" aria-current="page">Récapitulatif</li>
        </ol>
      </nav>
      <?php foreach(\Flash::instance()->getMessages() as $message): ?>
        <div class="alert alert-<?php echo $message['status']?> alert-dismissable">
          <?php echo $message['text']; ?>
        </div>
      <?php endforeach;?>
      <div class="card mt-4">
        <div class="card-header">
            <h5>Récapitulatif de votre installation</h5>
        </div>
        <div class="card-body">
        <p>
            Vous êtes sur le point de créer votre instance sur oressource.org avec les informations que vous venez de saisir.
            Vérifiez bien chaque élément. Pour des raisons de sécurité, le mot de passe choisi sera stocké chiffré et ne sera donc connu que de vous.
            Assurez vous donc de vous en rappeler.
            <?php if (array_key_exists('from_backup', $SESSION) && $SESSION['from_backup']): ?>
            L'utilisateur et le mot de passe que vous avez saisi sera ajouté aux utilisateurs déjà existants dans votre sauvegarde.
            Tous les comptes actifs de votre sauvegarde seront accessible depuis l'instance oressource.org.
            <?php endif; ?>
        </p>
        <form action="/generate" method="post">
          <div class="mx-5 px-5 my-5">
          <table class="table">
            <tr><th class="align-top"><i class="bi bi-tag"></i>&nbsp;Nom de votre structure</th><td><strong><?php echo $SESSION['nomRessourcerie'];?></strong></td></tr>
            <tr><th class="align-top"><i class="bi bi-house"></i>&nbsp;Adresse de votre structure</th><td><?php echo $SESSION['adresseRessourcerie'].'<br/>'.$SESSION['codePostal'].' '.$SESSION['ville'];?></td></tr>
            <tr><th class="align-top"><i class="bi bi-envelope-at"></i>&nbsp;Email</th><td><?php echo $SESSION['emailRessourcerie'];?><br/><span class="text-muted">sera utilisé comme identifiant</span></td></tr>
            <tr><th class="align-top"><i class="bi bi-key"></i>&nbsp;Mot de passe</th><td><?php echo $SESSION['motDePasse'];?><br/><span class="text-muted">à changer une fois l'installation terminée</span></td></tr>
            <?php if (array_key_exists('from_backup', $SESSION) && $SESSION['from_backup']): ?>
              <tr><th class="align-top"><i class="bi bi-floppy"></i>&nbsp;Votre fichier de sauvegarde</th><td><?php echo $SESSION['from_backup'];?></td></tr>
            <?php endif;?>
          </table>
          </div>
          <a href="/create<?php if (array_key_exists('from_backup', $SESSION)){echo '?from_backup=true';}?>" class="btn btn-light">Modifier</a>
          <button type="submit" class="btn btn-primary float-end">Activer mon instance</button>
        </form>
    </div>
      </div>
