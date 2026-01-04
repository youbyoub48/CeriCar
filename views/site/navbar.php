<?php
use  yii\helpers\Url;
?>

    <div class="container-fluid">
        <a class="navbar-brand" href="<?= \yii\helpers\Url::to(['/site/index']) ?>">
          <img src="img/logo.png" alt="Logo" width="60" height="30" class="d-inline-block align-text-top">
          <span class="text-primary-custom">Ceri<em class="text-success-custom">Car</em></span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <button class="nav-link active" aria-current="page" onclick="requete('<?= \yii\helpers\Url::to(['/site/index']) ?>')">Voyager</button>
            </li>

            <?php if (!Yii::$app->user->isGuest): ?>
              <li class="nav-item">
                <button class="nav-link" onclick="requete('<?= \yii\helpers\Url::to(['/site/reservation']) ?>')">Mes Réservations</button>
              </li>

              <?php if (Yii::$app->user->identity->permis !== "" && Yii::$app->user->identity->permis !== null): ?>
                <li class="nav-item">
                  <button class="nav-link" onclick="requete('<?= \yii\helpers\Url::to(['/site/voyage']) ?>')">Mes Voyages</button>
                </li>
              <?php endif; ?>

            <?php endif; ?>
          </ul>

          <ul class="navbar-nav ms-auto" id="navaccount">
            <?php if (Yii::$app->user->isGuest): ?>
                <li class="nav-item">
                    <button class="nav-link d-flex align-items-center gap-1" onclick="requete('<?= Url::to(['/site/signup']) ?>')">
                        <span class="material-symbols-outlined">person_add</span> Inscription
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link d-flex align-items-center gap-1" onclick="requete('<?= Url::to(['/site/login']) ?>')">
                        <span class="material-symbols-outlined">login</span> Connexion
                    </button>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <button class="nav-link d-flex align-items-center gap-1" onclick="requete('<?= Url::to(['/site/logout']) ?>',true)">
                        <span class="material-symbols-outlined">logout</span> Déconnexion 
                    </button>
                </li>
            <?php endif; ?>
          </ul>

        </div>
    </div>