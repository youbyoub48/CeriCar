<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class Internaute extends ActiveRecord implements IdentityInterface{
    
    /**
     * @return string le nom de la table associée à cette classe d'enregistrement actif.
     */
    public static function tableName()
    {
        return 'fredouil.internaute';
    }

    public static function getUserByIdentifiant($pseudo){
        return Internaute::findOne([
            'pseudo' => $pseudo
        ]);
    }

    public static function getUserByEmail($email){
        return Internaute::findOne([
            'mail' => $email
        ]);
    }

    public function getVoyages(){
        return $this->hasMany(Voyage::class, ["conducteur" => "id"]);
    }

    public function getReservations(){
        return $this->hasMany(Reservation::class, ["voyageur" => "id"]);
    }

    public function getId()
    {
        return $this->id;
    }

    public static function findIdentity($id){
        return Internaute::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null){
        return null;
    }

    public function getAuthKey(){
        return null;
    }

    public function validateAuthKey($authKey){
        return null;
    }

    public function validatePassword($password){
        return $this->pass === sha1($password);
    }

    public static function validateLogin($post){
        return isset($post["mail"]) && isset($post["pass"]) && 
        $post["mail"] !== "" && $post["pass"] !== "";
    }

    public static function validateSignup($post){
        return isset($post["nom"]) && $post["nom"] !== "" &&
           isset($post["prenom"]) && $post["prenom"] !== "" &&
           isset($post["pseudo"]) && $post["pseudo"] !== "" &&
           isset($post["mail"]) && $post["mail"] !== "" &&
           isset($post["photo"]) && $post["photo"] !== "" &&
           isset($post["pass"]) && $post["pass"] !== "";
    }

    public function rules()
{
    return [
        [['nom', 'prenom', 'pseudo', 'mail', 'photo', 'pass'], 'required'],
        [['permis'], 'string'], 
    ];
}
}