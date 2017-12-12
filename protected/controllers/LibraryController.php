<?php

class LibraryController extends Controller
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

		if ($model->city_id != $this->city->id) {
			$this->city = City::model()->findByPk($model->city_id);
		}

		$minRating = $model->rating - 6;
		$maxRating = $model->rating + 6;

		$criteria = new CDbCriteria();
		$criteria->condition = 'rating >= :min AND rating <= :max AND city_id = :city AND id != :id';
		$criteria->params = array(
			':min' => $minRating,
			':max' => $maxRating,
			':city' => $this->city->id,
			':id' => $model->id,
		);
		$criteria->order = 'rating ASC, id ASC';
		$criteria->limit = 6;
		$other = Library::model()->findAll($criteria);

		$criteria = new CDbCriteria();
		$criteria->condition = "city_id = ".$this->city->id;
		$countCompany = Library::model()->count($criteria);

		$this->pageTitle = "Библиотека {$model->name} в городе {$this->city->gorod}";
		$this->meta_k = "библиотека {$model->name}, взять книгу {$this->city->gorod}, адрес {$model->name}, телефон {$model->name}, сайт {$model->name}";
		$this->meta_d = "Библиотека {$model->name} в городе {$this->city->gorod} - адрес, телефон, сайт и рейтинг среди других библиотек";

		$this->render('view',array(
			'model' => $model,
			'other' => $other,
			'countCompany' => $countCompany,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Library;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Library']))
		{
			$model->attributes=$_POST['Library'];
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

		if(isset($_POST['Library']))
		{
			$model->attributes=$_POST['Library'];
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
		$libs = Library::model()->findAll(array(
			'condition' => 'city_id = :city_id',
			'params' => array(
				':city_id' => $this->city->id,
			),
			'order' => 'rating ASC',
		));

		$this->pageTitle = "Библиотеки в городе {$this->city->gorod}";
		$this->meta_k = "библиотеки, {$this->city->gorod}, библиотеки {$this->city->gorod}, список библиотек";
		$this->meta_d = "Список библиотек в городе {$this->city->gorod} - адреса и телефоны";

		$this->render('index',array(
			'libs' => $libs,
			'countCompany' => count($libs),
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Library('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Library']))
			$model->attributes=$_GET['Library'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModelUrl()
	{
		if(isset($_GET['url']) && $this->city)
			$model=Library::model()->find('url=:url and city_id=:city_id', array(':url'=>$_GET['url'], ':city_id'=>$this->city->id));
		if(isset($_GET['id']))
			$model=Library::model()->findByPk($_GET['id']);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Library the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Library::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Library $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='library-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
