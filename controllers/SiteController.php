<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Internaute;
use app\models\Voyage;
use app\models\Trajet;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
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
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if(Yii::$app->request->isGet) return $this->render("login");
        
        if(Internaute::validateLogin(Yii::$app->request->post())){
            $internaute = Internaute::getUserByEmail(Yii::$app->request->post()["mail"]);

            if(isset($internaute) && $internaute->validatePassword(Yii::$app->request->post()["pass"])){
                Yii::$app->user->login($internaute);
                return $this->renderPartial("index");
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

        return $this->goHome();
    }

    public function actionSignup(){
        if(Yii::$app->request->isGet) return $this->render("signup");

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


    public function actionAbout($depart,$arrivee,$personnes)
    {
        $trajet = Trajet::getTrajet($depart,$arrivee);
        $voyages = Voyage::getVoyagesByTrajetId($trajet->id);
        return $this->render('search',[
            'voyages' => $voyages,
            'trajet' => $trajet,
            'personnes' => $personnes
        ]);
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
        $internaute = Internaute::getUserByIdentifiant("Azerty");

        return $this->render('test.php', [
            'internaute' => $internaute
        ]);
    }

    public function actionReservation(){
        if(Yii::$app->user->isGuest) return $this->render("login");
    }
}
