
    <div class="container" style="max-width: 1050px;">
      <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="mt-2">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Accueil</a></li>
          <li class="breadcrumb-item"><a href="/demarrer">Hébergement</a></li>
          <li class="breadcrumb-item"><a href="/webhost">Base de donnée</a></li>
          <li class="breadcrumb-item"><a href="/create<?php if (array_key_exists('from_backup', $SESSION)){echo '?from_backup=true';}?>">Informations</a></li>
          <li class="breadcrumb-item">Récapitulatif</li>
          <li class="breadcrumb-item active" aria-current="page">Activation</li>
        </ol>
      </nav>
      <?php foreach(\Flash::instance()->getMessages() as $message): ?>
        <div class="alert alert-<?php echo $message['status']?> alert-dismissable">
          <?php echo $message['text']; ?>
        </div>
      <?php endforeach;?>
      <div class="card">
        <h5 class="card-header">Rappel de vos informations de connection</h5>
        <form action="/generate" method="post">
          <div class="card-body text-center">
            <?php if (array_key_exists('from_backup', $SESSION)):?>
              <p>Pour vous connecter à votre instance, vous pouvez utiliser vos anciens identifiants aussi bien que le nouveau que vous venez de créer :</p>
            <?php else: ?>
              <p>Pour vous connecter à votre instance, utilisez l'utilisateur que vous venez de créer :</p>
            <?php endif;?>
            <h5 class="card-title"><i class="bi bi-envelope-at"></i>&nbsp;Email (identifiant) : <?php echo $SESSION['emailRessourcerie'];?></h5>
            <h5 class="card-title"><i class="bi bi-key"></i>&nbsp;Mot de passe : <?php echo $SESSION['motDePasse'];?></h5>
              <a class="btn btn-primary" href="/<?php echo $SESSION['db_name']; ?>/ifaces/">lien vers votre site</a>
          </div>
        </form>
      </div>
    </div>
