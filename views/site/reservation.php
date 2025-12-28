<?php
use yii\helpers\Html;

$this->title = 'Réservations';

?>
<div class="container" style="max-width: 800px; margin-top: 30px;">
    
    <div class="d-flex justify-content-between align-items-center results-header">
        <h3 class="m-0">Mes Réservations</h3>
    </div>

    <?php foreach (Yii::$app->user->identity->reservations as $reservation): ?>
        <div class="trip-card">
            
            <div class="trip-info">
                <div class="trip-segment">
                    <span class="trip-time"><?= Html::encode(sprintf('%02d:00', $reservation->voyageInfo->heuredepart)) ?></span>
                    <div class="timeline-indicator">
                        <div class="dot"></div>
                        <div class="line"></div>
                    </div>
                    <span class="trip-city"><?= Html::encode($reservation->voyageInfo->trajetInfo->depart) ?></span>
                </div>

                <div class="trip-duration">
                    Durée du trajet : <?= Html::encode($reservation->voyageInfo->trajetInfo->getTime()) ?>
                </div>

                <div class="trip-segment">
                    <span class="trip-time"><?= Html::encode($reservation->voyageInfo->getTimeArrive()) ?></span>
                    <div class="timeline-indicator">
                        <div class="dot" style="background: #333;"></div> </div>
                    <span class="trip-city"><?= Html::encode($reservation->voyageInfo->trajetInfo->arrivee) ?></span>
                </div>
            </div>

            <div class="trip-details">
                <div class="trip-price">
                    <?= Html::encode(($reservation->voyageInfo->tarif * $reservation->voyageInfo->trajetInfo->distance) * $reservation->nbplaceresa) ?> €
                </div>

                <div class="seats-badge">
                    <span class="material-symbols-outlined">airline_seat_recline_normal</span>
                    <?= Html::encode($reservation->nbplaceresa) ?> places
                </div>

                <div class="constraints-box">
                    <?php if (!empty($reservation->voyageInfo->contraintes)): ?>
                        <span class="constraint-tag">
                            <?= Html::encode($reservation->voyageInfo->contraintes) ?>
                        </span>
                    <?php endif; ?>
                </div>
                
                <div class="driver-info">
                    <div class="text-end me-2">
                        <div class="driver-name"><?= Html::encode($reservation->voyageInfo->conducteurInfo->pseudo) ?></div>
                    </div>
                    <img src="<?= Html::encode($reservation->voyageInfo->conducteurInfo->photo) ?>" alt="" class="driver-avatar">
                </div>
            </div>

        </div>
    <?php endforeach; ?>

</div>