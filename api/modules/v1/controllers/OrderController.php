<?php

namespace api\modules\v1\controllers;

//COMMON IMPORT
use Yii;
use yii\rest\ActiveController;

//EXCEPTIONS
use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;

// use yii\helpers\ArrayHelper;

//MODELS
use common\models\Order;

class OrderController extends ActiveController {

	public $modelClass = 'common\models\Order';

	// protected function verbs() {
	// 	return [
 //            'adfromcsv' => ['POST'],
	// 		'savewsuscomputer' => ['POST'],
	// 		'trackinglog' => ['POST'],
 //            'test' => ['GET'],
	// 	];
	// }

	public function actions() {
	    $actions = parent::actions();

	    unset($actions['view']);

	    return $actions;
	}

	public function actionView($id = 0) {
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$order = Order::find()->with('customer')->where(['=','id',intval($id)])->one();
		// var_dump($order);
		if(!isset($order) || $order === []) {
        	throw new NotFoundHttpException("Order not found", 404);
		};
		return $order;
	}

	//get all orders of a choosen customer
	public function actionCustomerid($id) {
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$order = Order::find()->where(['=','id_customer',intval($id)])->all();
		if(!isset($order) || $order === []) {
        	throw new NotFoundHttpException("No Orders founded for the client with id[$id]", 404);
		};
		return $order;
	}

	public function actionDate($year, $month = null, $day = null) {
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$query = Order::find();
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

		$orders = $query->all();
		$return = sizeof($orders) == 0 ? false : $orders;

		return $return;
	}
}
