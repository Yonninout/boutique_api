<?php

namespace api\modules\v1\controllers;

use Yii;
use yii\rest\Controller;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\web\Response;

use common\models\Article;











class ArticleController extends ActiveController {

	public $modelClass = 'common\models\Article';

	public function actions() {
	    $actions = parent::actions();

	    // disable the "delete" and "create" actions
	    unset($actions['view']);

	    // customize the data provider preparation with the "prepareDataProvider()" method
	    // $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

	    return $actions;
	}


	public function actionView($id) {

		// $cost = 11;
		// TODO Implement on password submition 
		// OPTIMAL COST TEST 
	    // $timeTarget = 0.1; // 50 millisecondes
		// do {
		//     $cost++;
		//     $start = microtime(true);
		//     $a = password_hash("test", PASSWORD_BCRYPT, ["cost" => $cost]);
		//     $end = microtime(true);
		// } while (($end - $start) < $timeTarget);
		
		// Pass test Phase 
		// $password = "NERdliuziygdez234TCsdvsv@dz€ze";
		// $hash = password_hash($password, PASSWORD_BCRYPT, ["cost" => $cost]);

		// if(password_verify ($password ,$hash)) {
		// 	return 'passOK';
		// }else {
		// 	return 'passFalse';
		// }

		// return password_hash("yonni", PASSWORD_BCRYPT, ["cost" => $cost]);
		// return password_hash("clement", PASSWORD_BCRYPT, ["cost" => $cost]);

		// return "Valeur de 'cost' la plus appropriée : " . $cost. "   hash: ".$a; 
	    Yii::$app->response->format = Response::FORMAT_JSON;
		$article = Article::find()->where(['=','id',intval($id)])->one();
		if(is_null($article)) {
        	throw new NotFoundHttpException("Article not found", 404);
		};
		return $article;
	}
	// GET all item currently to sell
	public function actionTosell(){
		// return 'lol';
		$return = Article::find()->where(['=','be_sold','1'])->all();
		return $return;
	}
	
	// GET all item currently not to sell;
	public function actionNotosell(){
		return 'lol';
	}
	
	// GET an array of one item selected by its id

	public function actionPhotourl($id){
		return $id;
	}


}
