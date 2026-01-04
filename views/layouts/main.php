<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use yii\bootstrap5\Html;
use  yii\helpers\Url;
use yii\web\JqueryAsset;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);

$this->registerJsFile(
    '@web/js/script.js',
    ['depends' => [JqueryAsset::class]]
);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=add_circle,airline_seat_recline_normal,arrow_forward,badge,directions_car,euro,group,group_add,image,info,location_on,lock,login,logout,luggage,mail,person,person_add,pin_drop,schedule,stars,trip_origin" />
    <link rel="stylesheet" href="css/site2.css">
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
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
  </nav>

  <div id="alert" class="text-light d-flex align-items-center justify-content-center">
    <span id="alert-text"></span>
  </div>
</header>

<div id="content" >
<?= $content ?>
</div>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; CeriCar <?= date('Y') ?></div>
            <div class="col-md-6 text-center text-md-end"><?= Yii::powered() ?></div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
