<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Reservation extends ActiveRecord{
     /**
     * @return string le nom de la table associée à cette classe d'enregistrement actif.
     */
    public static function tableName()
    {
        return 'fredouil.reservation';
    }

    public static function getReservationsByVoyageId($id){
        return Reservation::findAll([
            'voyage' => $id
        ]);
    }

    public function getInternauteInfo(){
        return $this->hasOne(Internaute::class, ["id" => "voyageur"]);
    }

    public function getVoyageInfo(){
        return $this->hasOne(Voyage::class, ["id" => "voyage"]);
    }

    public function rules()
    {
        return [
            [['voyage', 'voyageur', 'nbplaceresa'], 'required'],
            [['voyage','voyageur','nbplaceresa'], 'integer'], 
        ];
    }
}