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

	public function actionDate($year, $month = null, $day = null) {
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$query = Customer::find();
		if (!checkdate(1,1,$year) ) {
			throw new BadRequestHttpException(
        		"Incorrect value of year :: $year given", 
        		400);
		} else {
			$query->byYear($year);
		}

		if (!is_null($month)) {
			if(!checkdate($month,1,$year)){
        	throw new BadRequestHttpException(
        		"Incorrect value of month :: $month given. Expect to be between 1 and 12", 
        		400);
			} else {
				$query->byMonth($month);
			}
		}
		if(!is_null($day)){
			if(!checkdate($month,$day,$year)){
				$month_request = date('F',mktime(0, 0, 0, intval($month), 1,0));
        	throw new BadRequestHttpException(
        		"Incorrect value of day :: $day given. Expected that the day to exist in ".$month_request, 
        		400);
			} else {
				$query->byDay($day);
			}
		}

		$customers = $query->all();
		$return = sizeof($customers) == 0 ? false : $customers;

		return $return;
	}
}