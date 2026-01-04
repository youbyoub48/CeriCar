<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Voyage extends ActiveRecord{
     /**
     * @return string le nom de la table associée à cette classe d'enregistrement actif.
     */
    public static function tableName()
    {
        return 'fredouil.voyage';
    }

    public function getTrajetInfo(){
        return $this->hasOne(Trajet::class, ["id" => "trajet"]);
    }

    public function getTypevInfo(){
        return $this->hasOne(TypeVehicule::class, ["id" => "idtypev"]);
    }

    public function getMarquevInfo(){
        return $this->hasOne(MarqueVehicule::class, ["id" => "idmarquev"]);
    }

    public function getConducteurInfo(){
        return $this->hasOne(Internaute::class, ["id" => "conducteur"]);
    }

    public static function getVoyagesByTrajetId($id){
        return Voyage::findAll([
            'trajet' => $id
        ]);
    }

    public function getTimeArrive(){
        return gmdate("H:i", floor($this->trajetInfo->distance*60 + $this->heuredepart*3600));
    }

    public function getAvailablePlaces(){
        $somme = 0;
        foreach(Reservation::getReservationsByVoyageId($this->id) as $reservation){
            $somme += $reservation->nbplaceresa;
        }
        return $this->nbplacedispo - $somme;
    }

    public function rules(){
        return [
            [['conducteur', 'trajet', 'idtypev', 'idmarquev', 'tarif', 'nbplacedispo','nbbagage','heuredepart'], 'required'],
            [['conducteur','trajet','idtypev','idmarquev','nbplacedispo','nbbagage','heuredepart'], 'integer'], 
            [['tarif'], 'double'],
            [['contraintes'], 'string']
        ];
    }
}