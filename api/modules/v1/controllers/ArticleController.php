<?php

namespace api\modules\v1\controllers;

use Yii;
use yii\rest\Controller;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;

class ArticleController extends ActiveController {

	public $modelClass = 'common\models\Article';
}
