<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

use app\models\Internaute;
use app\models\MarqueVehicule;
use app\models\Reservation;
use app\models\Voyage;
use app\models\Trajet;
use app\models\TypeVehicule;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if(Yii::$app->request->isAjax) return $this->renderPartial("index");
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if(Yii::$app->request->isGet) return $this->renderPartial("login");
        
        if(Internaute::validateLogin(Yii::$app->request->post())){
            $internaute = Internaute::getUserByEmail(Yii::$app->request->post()["mail"]);

            if(isset($internaute) && $internaute->validatePassword(Yii::$app->request->post()["pass"])){
                Yii::$app->user->login($internaute);
                return $this->asJson([
                    'html' => $this->renderPartial("index"),
                    'token' => Yii::$app->request->getCsrfToken(),
                ]);
            }

            else{
                Yii::$app->response->statusCode = 404;
                return "Informations invalide";
            }
        }
 
        else{
            Yii::$app->response->statusCode = 406;
            return "Informations manquantes";
        }
    }
        


    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->renderPartial("index");
    }

    public function actionSignup(){
        if(Yii::$app->request->isGet) return $this->renderPartial("signup");

        $internaute = new Internaute();
        if($internaute->load(Yii::$app->request->post(),'') && $internaute->validate()){
            $internaute->pass = sha1($internaute->pass);
            $internaute->save();
            return $this->renderPartial("login");
        }
 
        else{
            Yii::$app->response->statusCode = 406;
            return "Informations manquantes";
        }

    }

    public function actionSearch($depart,$arrivee,$personnes)
    {
        $trajet = Trajet::getTrajet($depart,$arrivee);
        if($trajet == null) {
            Yii::$app->response->statusCode = 406;
            return "Trajet Invalide";
        }

        $voyages = Voyage::getVoyagesByTrajetId($trajet->id);
        if($voyages == null) {
            Yii::$app->response->statusCode = 404;
            return "Aucun Voyages Trouvé";
        }
        return $this->renderPartial('search',[
            'voyages' => $voyages,
            'trajet' => $trajet,
            'personnes' => $personnes
        ]);
    }

    public function actionTest(){
        $internaute = Internaute::getUserByIdentifiant("Fourmi");

        return $this->renderPartial('test.php', [
            'internaute' => $internaute
        ]);
    }

    public function actionReservation(){
        if(Yii::$app->user->isGuest) return $this->renderPartial("login");

        return $this->renderPartial("reservation");
    }

    public function actionVoyage(){
        if(Yii::$app->user->isGuest) return $this->renderPartial("login");

        return $this->renderPartial("voyage");
    }

    public function actionNavbar(){
        return $this->renderPartial("navbar");
    }

    public function actionProposer(){
        if(Yii::$app->user->isGuest) return $this->renderPartial("login");

        if(Yii::$app->request->isGet) return $this->renderPartial("proposer", [
            "types" => TypeVehicule::findBySql("SELECT * FROM ".TypeVehicule::tableName())->all(),
            "marques" => MarqueVehicule::findBySql("SELECT * FROM ".MarqueVehicule::tableName())->all(),
        ]);

        $voyage = new Voyage();
        
        if($voyage->load(Yii::$app->request->post(),'')){
            $voyage->conducteur = Yii::$app->user->identity->id;
            $voyage->trajet = Trajet::getTrajet(Yii::$app->request->post()['depart'],Yii::$app->request->post()['arrivee']);

            if($voyage->trajet != null) $voyage->trajet = $voyage->trajet->id;
            
            if($voyage->validate()){
                $voyage->save();
                return $this->renderPartial("voyage");
            }

            else{
                Yii::$app->response->statusCode = 406;
                return "Informations manquantes ou incorects";
            }
        }

        else{
            Yii::$app->response->statusCode = 404;
            return "Problème";
        }
    }

    public function actionReserver(){
        if(!Yii::$app->request->isPost){
            Yii::$app->response->statusCode = 405;
            return "405 Method Not Allowed";
        }

        $reservation = new Reservation();
        $reservation->voyage = Voyage::findOne(Yii::$app->request->post()['voyage'])->id;
        $reservation->voyageur = Internaute::findOne(Yii::$app->request->post()['user'])->id;
        $reservation->nbplaceresa = Yii::$app->request->post()['personnes'];

        if($reservation->validate()){
            $reservation->save();
            return Yii::$app->request->getCsrfToken();
        }

        else{
            Yii::$app->response->statusCode = 406;
            return "Information Incorect";
        }
    }
}
