<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Trajet extends ActiveRecord{
     /**
     * @return string le nom de la table associée à cette classe d'enregistrement actif.
     */
    public static function tableName()
    {
        return 'fredouil.trajet';
    }

    public static function getTrajet($depart,$arrivee){
        return Trajet::findOne([
            'depart' => $depart,
            'arrivee' => $arrivee
        ]);
    }

    public function getTime(){
        return str_replace(":","h", gmdate('H:i', $this->distance*60));
    }
}