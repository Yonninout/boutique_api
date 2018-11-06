<?php

namespace api\modules\v1\controllers;

use Yii;
use yii\rest\Controller;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;

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
	    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$article = Article::find()->where(['=','id',intval($id)])->one();
		// return $id;
		if(is_null($article)) {
        	throw new NotFoundHttpException("Article not found", 404);
		}else {
			
		}
		return $article;
	}

}
