<?php

class CityController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */

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
				'actions'=>array('index','view', 'ajaxheaderlist', 'ajaxgeturl'),
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

	public function actionAjaxgeturl()
	{
		$id = Yii::app()->request->getPost('id', null);
		$url = Yii::app()->request->getPost('url', null);

		$city = $this->loadModel($id);

		if ($city) {
			Yii::app()->session['city'] = $city->id;
			Yii::app()->request->cookies['city'] = new CHttpCookie('city', $city->id);

			if (!preg_match('/(bookone\.ru\/category)|(bookone\.ru\/book)/i', $url)) {
				$url = "http://bookone.ru/{$city->simbol_name}";
			}

			echo $url;
		} else {
			echo $url;
		}

		Yii::app()->end();
	}

	public function actionAjaxheaderlist()
	{
		$list = City::model()->findAll(array('order' => 'gorod ASC'));

		$html = '
			<div class="city_popup_row">
				<div class="city_popup_letter">A</div>
				<div class="city_popup_list">
		';
		$currentLetter = 'А';

		foreach ($list as $key => $item) {
			$checkLetter = mb_strtoupper(mb_substr($item->gorod, 0, 1, 'UTF-8'), 'UTF-8');

			if ($checkLetter != $currentLetter) {
				$currentLetter = $checkLetter;
				$html .= '
						</div>
					</div>
					<div class="city_popup_row">
						<div class="city_popup_letter">'.$currentLetter.'</div>
						<div class="city_popup_list">
				';
			}

			$html .= '<span data-id="'.$item->id.'">'.$item->gorod.'</span>';
		}

		$html .= '
				</div>
			</div>
		';

		echo $html;
		Yii::app()->end();
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new City;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['City']))
		{
			$model->attributes=$_POST['City'];
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

		if(isset($_POST['City']))
		{
			$model->attributes=$_POST['City'];
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
		$list = City::model()->findAll(array('order' => 'gorod ASC'));

		$this->pageTitle = "Список городов";
		$this->meta_k = "города, список, книги в городах, россия, купить в городе";
		$this->meta_d = "Список городов книжного портала bookone.ru";
		
		$this->render('index',array(
			'list' => $list,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new City('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['City']))
			$model->attributes=$_GET['City'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return City the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=City::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param City $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='city-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
