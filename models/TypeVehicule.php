<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class TypeVehicule extends ActiveRecord{
     /**
     * @return string le nom de la table associée à cette classe d'enregistrement actif.
     */
    public static function tableName()
    {
        return 'fredouil.typevehicule';
    }
}