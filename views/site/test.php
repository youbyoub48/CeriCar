<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

use app\models\Voyage;
use app\models\Trajet;
use app\models\Reservation;

$this->title = 'Test';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<?php if (!$internaute):?>
<span>Utilisateur inconnue</span>

<?php else:?>
<h3>Utilisateur :</h3>
<span><?= Html::encode($internaute->pseudo) ?></span><br>
<span><?= Html::encode($internaute->pass) ?></span><br>
<span><?= Html::encode($internaute->nom) ?></span><br>
<span><?= Html::encode($internaute->prenom) ?></span><br>
<span><?= Html::encode($internaute->mail) ?></span><br>
<span><?= Html::encode($internaute->photo) ?></span><br>
<span><?= Html::encode($internaute->permis) ?></span><br>

<?php
    if ($internaute->voyages){
        echo Html::tag('h3', "Voyages Proposé :");
        $i = 0;
        foreach ($internaute->voyages as $voyage) {
            echo Html::tag('h4',"Voyage ".Html::encode(++$i)." :");

            echo Html::tag('span', "depart : ".Html::encode($voyage->trajetInfo->depart));
            echo Html::tag('br');

            echo Html::tag('span', "arrivée : ".Html::encode($voyage->trajetInfo->arrivee));
            echo Html::tag('br');

            echo Html::tag('span', "distance : ".Html::encode($voyage->trajetInfo->distance));
            echo Html::tag('br');

            echo Html::tag('span', "type de véhicule : ".Html::encode($voyage->typevInfo->typev));
            echo Html::tag('br');

            echo Html::tag('span', "marque du véhicule : ".Html::encode($voyage->marquevInfo->marquev));
            echo Html::tag('br');

            echo Html::tag('span', "tarif : ".Html::encode($voyage->tarif));
            echo Html::tag('br');

            echo Html::tag('span', "place disponible : ".Html::encode($voyage->nbplacedispo));
            echo Html::tag('br');

            echo Html::tag('span', "nombre de bagage : ".Html::encode($voyage->nbbagage));
            echo Html::tag('br');

            echo Html::tag('span', "heure de départ : ".Html::encode($voyage->heuredepart));
            echo Html::tag('br');

            echo Html::tag('span', "contraintes : ".Html::encode($voyage->contraintes));
            echo Html::tag('br');

            echo Html::tag('span', "nom : ".Html::encode($voyage->conducteurInfo->nom));
            echo Html::tag('br');
        }
    }

    if($internaute->reservations){
        $i = 0;
        foreach ($internaute->reservations as $reservation) {
            echo Html::tag('h4',"Reservation ".Html::encode(++$i)." :");

            echo Html::tag('span', "voyageur : ".Html::encode($reservation->internauteInfo->nom));
            echo Html::tag('br');

            echo Html::tag('span', "nombre de places : ".Html::encode($reservation->nbplaceresa));
            echo Html::tag('br');

            echo Html::tag('span', "depart : ".Html::encode($reservation->voyageInfo->trajetInfo->depart));
            echo Html::tag('br');

            echo Html::tag('span', "arrivée : ".Html::encode($reservation->voyageInfo->trajetInfo->arrivee));
            echo Html::tag('br');

            echo Html::tag('span', "distance : ".Html::encode($reservation->voyageInfo->trajetInfo->distance));
            echo Html::tag('br');

            echo Html::tag('span', "type de véhicule : ".Html::encode($reservation->voyageInfo->typevInfo->typev));
            echo Html::tag('br');

            echo Html::tag('span', "marque du véhicule : ".Html::encode($reservation->voyageInfo->marquevInfo->marquev));
            echo Html::tag('br');

            echo Html::tag('span', "tarif : ".Html::encode($reservation->voyageInfo->tarif));
            echo Html::tag('br');

            echo Html::tag('span', "place disponible : ".Html::encode($reservation->voyageInfo->nbplacedispo));
            echo Html::tag('br');

            echo Html::tag('span', "nombre de bagage : ".Html::encode($reservation->voyageInfo->nbbagage));
            echo Html::tag('br');

            echo Html::tag('span', "heure de départ : ".Html::encode($reservation->voyageInfo->heuredepart));
            echo Html::tag('br');

            echo Html::tag('span', "contraintes : ".Html::encode($reservation->voyageInfo->contraintes));
            echo Html::tag('br');
        }
    }

    echo Html::tag('h2',"Test fonctions :");

    $trajet = Trajet::getTrajet("Paris","Lyon");

    echo Html::tag('span', "depart : ".Html::encode($trajet->depart));
    echo Html::tag('br');

    echo Html::tag('span', "arrivée : ".Html::encode($trajet->arrivee));
    echo Html::tag('br');

    echo Html::tag('span', "distance : ".Html::encode($trajet->distance));
    echo Html::tag('br');

    var_dump(Voyage::getVoyagesByTrajetId($trajet->id));
    echo Html::tag('br');
    echo Html::tag('br');
    var_dump(Reservation::getReservationsByVoyageId(1));
?>
<?php endif;?>