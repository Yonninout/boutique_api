<?php

namespace api\modules\v1\controllers;

use Yii;
use yii\rest\Controller;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\web\Response;

use yii\helpers\ArrayHelper;

use common\models\Customer;

class CustomerController extends ActiveController {

	public $modelClass = 'common\models\Customer';

	public function actions() {
	    $actions = parent::actions();

	    return $actions;
	}


}
