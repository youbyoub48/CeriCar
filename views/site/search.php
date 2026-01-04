<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Résultats de recherche - CeriCar';

?>
<div class="container" style="max-width: 800px; margin-top: 30px;">
    
    <div class="d-flex justify-content-between align-items-center results-header">
        <h3 class="m-0"><?= Html::encode($trajet->depart) ?> <span class="material-symbols-outlined" style="vertical-align: middle;">arrow_forward</span> <?= Html::encode($trajet->arrivee) ?></h3>
        <span class="text-muted"><?= Html::encode($personnes) ?> passagers</span>
    </div>

    <?php foreach ($voyages as $voyage): ?>
        <div class="trip-card">
            
            <div class="trip-info">
                <div class="trip-segment">
                    <span class="trip-time"><?= Html::encode(sprintf('%02d:00', $voyage->heuredepart)) ?></span>
                    <div class="timeline-indicator">
                        <div class="dot"></div>
                        <div class="line"></div>
                    </div>
                    <span class="trip-city"><?= Html::encode($voyage->trajetInfo->depart) ?></span>
                </div>

                <div class="trip-duration">
                    Durée du trajet : <?= Html::encode($voyage->trajetInfo->getTime()) ?>
                </div>

                <div class="trip-segment">
                    <span class="trip-time"><?= Html::encode($voyage->getTimeArrive()) ?></span>
                    <div class="timeline-indicator">
                        <div class="dot" style="background: #333;"></div> </div>
                    <span class="trip-city"><?= Html::encode($voyage->trajetInfo->arrivee) ?></span>
                </div>
            </div>

            <div class="trip-details">
                <div class="d-flex flex-column align-items-end">
                    <div class="trip-price">
                        <?= Html::encode(($voyage->tarif*$voyage->trajetInfo->distance)*$personnes) ?> €
                    </div>

                    <?php if($voyage->getAvailablePlaces() >= $personnes): ?>
                        <button onclick="<?= (Yii::$app->user->isGuest) ? "requete('".Url::to(['site/login'])."')" : "reserver(".Yii::$app->user->identity->id.",$voyage->id,$personnes)" ?>" class="btn btn-primary btn-reserve shadow-sm">Réserver</button>
                    <?php endif; ?>
                </div>

                <div class="seats-badge <?= ($voyage->getAvailablePlaces() <= $personnes) ? 'low-stock' : '' ?>">
                    <span class="material-symbols-outlined">airline_seat_recline_normal</span>
                    <?php if($personnes <= $voyage->getAvailablePlaces()): ?>
                        <?= Html::encode($voyage->getAvailablePlaces()) ?> places
                    <?php else: ?>
                        <span>COMPLET</span>
                    <?php endif; ?>
                </div>

                <div class="constraints-box">
                    <?php if (!empty($voyage->contraintes)): ?>
                        <span class="constraint-tag">
                            <?= Html::encode($voyage->contraintes) ?>
                        </span>
                    <?php endif; ?>
                </div>
                
                <div class="driver-info">
                    <div class="text-end me-2">
                        <div class="driver-name"><?= Html::encode($voyage->conducteurInfo->pseudo) ?></div>
                    </div>
                    <img src="<?= Html::encode($voyage->conducteurInfo->photo) ?>" alt="" class="driver-avatar">
                </div>
            </div>

        </div>
    <?php endforeach; ?>

</div>