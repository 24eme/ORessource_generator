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
      <div class="card mt-4">
        <h5 class="card-header">Rappel de vos informations de connection</h5>
        <form action="/generate" method="post">
          <div class="card-body">
            <p class="alert alert-success text-center">Votre instance oressource.org est installée !!</p>
            <p>
                L'instance est mise à disposition à prix libre par la coopérative 24ème.
                Sans utilisation pendant une période d'un mois, l'équipe du 24ème pourrait être amenée à la supprimer.
                L'icone ❤️ dans votre instance vous permettra de contacter le 24ème si vous avez des questions sur la pérénité de votre instance ou les manières de contribuer à la maintenance de oressource.org et du logiciel ORessource.
            </p>
            <p>
            <?php if (array_key_exists('from_backup', $SESSION)):?>
            Pour vous connecter à votre instance, vous pouvez utiliser vos anciens identifiants aussi bien que le nouveau que vous venez de créer.
            <?php endif;?>
            Vous pouvez dès maintenant utiliser votre instance oressource.org.
            Voici les informations qui vous permettront de vous connecter à votre instannce et de l'utiliser :
            </p>
            <div class="mx-5 px-5 my-5">
            <table class="table">
                <tr>
                    <th><i class="bi bi-shield-check"></i>&nbsp;Adresse URL de votre instance</th>
                    <td>
                        <span id="url_data"><?php echo 'https://'.$_SERVER['HTTP_HOST'].'/'.$SESSION['db_name'].'/';?></span>
                        <button class="btn text-muted" type="button" onclick="navigator.clipboard.writeText(document.getElementById('url_data').innerText); this.innerText = 'copié !';"><i class="bi bi-clipboard"></i></button>
                    </td>
                </tr>
                <tr>
                    <th><i class="bi bi-person-fill"></i>&nbsp;Identifiant</th>
                    <td>
                        <span id="email_data"><?php echo $SESSION['emailRessourcerie'];?></span>
                        <button class="btn text-muted" type="button" onclick="navigator.clipboard.writeText(document.getElementById('email_data').innerText); this.innerText = 'copié !';"><i class="bi bi-clipboard"></i></button>
                    </td>
                </tr>
                <tr>
                    <th><i class="bi bi-key"></i>&nbsp;Mot de passe</th>
                    <td>
                        <span id="mdp_data"><?php echo $SESSION['motDePasse'];?></span>
                        <button class="btn text-muted" type="button" onclick="navigator.clipboard.writeText(document.getElementById('mdp_data').innerText); this.innerText = 'copié !';"><i class="bi bi-clipboard"></i></button>
                    </td>
                </tr>
            </table>
            <p class="text-center">
                 <a class="btn btn-primary mt-3" href="/<?php echo $SESSION['db_name']; ?>/" target="_blank"><i class="bi bi-box-arrow-up-right"></i> &nbsp; Accéder au site</a>
            </p>
            </div>
          </div>
        </form>
      </div>
