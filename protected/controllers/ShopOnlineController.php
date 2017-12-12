<?php

class ShopOnlineController extends Controller
{
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView()
	{
		$model = $this->loadModelUrl();
		$count = ShopOnline::model()->count();

		$shopOnline = ShopOnline::model()->findAll(array(
			'condition' => 'id <> '.$model->id,
			'order' => 'rating ASC'
		));

		$this->pageTitle = "{$model->name} в городе {$this->city->gorod} - книги, товары и услуги, способы оплаты и доставки";
		$this->meta_k = "{$model->name}, рейтинг, {$this->city->gorod}, {$model->site}, книги, доставка, способы оплаты, условия покупки";
		$this->meta_d = "Книжный интернет-магазин {$model->name} в городе {$this->city->gorod} - товары и услуги, способы оплаты, доставка и пункты выдачи.";

		$this->render('view',array(
			'model' => $model,
			'count' => $count,
			'shopOnline' => $shopOnline,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new ShopOnline;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ShopOnline']))
		{
			$model->attributes=$_POST['ShopOnline'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ShopOnline']))
		{
			$model->attributes=$_POST['ShopOnline'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$shopOnline = ShopOnline::model()->findAll(array(
			'order' => 'rating ASC',
		));

		$this->pageTitle = "Книжные онлайн магазины в городе {$this->city->gorod}";
		$this->meta_k = "купить онлайн, {$this->city->gorod}, онлайн магазин {$this->city->gorod}, книжный магазин";
		$this->meta_d = "Список книжных онлайн магазинов с доставкой в город {$this->city->gorod}";

		$this->render('index',array(
			'shopOnline'=>$shopOnline,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ShopOnline('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ShopOnline']))
			$model->attributes=$_GET['ShopOnline'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ShopOnline the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ShopOnline::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModelUrl()
	{
		if(isset($_GET['url']))
			$model=ShopOnline::model()->find('url=:url', array(':url'=>$_GET['url']));
		if(isset($_GET['id']))
			$model=ShopOnline::model()->findByPk($_GET['id']);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ShopOnline $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='shop-online-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
