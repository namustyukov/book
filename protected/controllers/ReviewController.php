<?php

class ReviewController extends Controller
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
				'actions'=>array('index','view', 'ajaxcreate'),
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

	public function actionAjaxcreate()
	{
		$review_name = $_POST['review_name'];
		$review_mark = $_POST['review_mark'];
		$review_message = $_POST['review_message'];
		$book_id = $_POST['book_id'];

		$model = new Review;
		$model->text = $review_message;
		$model->fio = $review_name;
		$model->mark = $review_mark;
		$model->book_id = $book_id;
		$model->date_create = time();

		$data = array();
		if ($model->save())
		{
			$html = '';
			$html .= '<div class="product-review-item">
						<div class="review-item-head">
							<div class="review-item-head-rating">
								<ul>';
									for ($i = 0 ; $i < 5 ; $i++)
										$html .= ($model->mark && $i < $model->mark) ? '<li class="__active"></li>' : '<li></li>';
			$html .= '			</ul>
							</div>
							<div class="review-item-head-name">';
								$date=explode(".",date('d.m.Y', $model->date_create));
								switch ($date[1]){
									case 1: $m='января'; break;
									case 2: $m='февраля'; break;
									case 3: $m='марта'; break;
									case 4: $m='апреля'; break;
									case 5: $m='мая'; break;
									case 6: $m='июня'; break;
									case 7: $m='июля'; break;
									case 8: $m='августа'; break;
									case 9: $m='сентября'; break;
									case 10: $m='октября'; break;
									case 11: $m='ноября'; break;
									case 12: $m='декабря'; break;
								}
			$html .= '			<span>'.$model->fio.'</span> | <small>'.($date[0]*1).' '.$m.' '.$date[2].'</small>
							</div>
						</div>
						<div class="review-item-content">
							<div class="review-item-content-wrapper">
								<p>'.strip_tags($model->text).'</p>
							</div>
							<div class="review-item-content-wrapper_more __hidden">
								<span>Показать весь текст</span>
							</div>
						</div>
					</div>';
			$data['html'] = $html;
		}
		else
			$data['error'] = 'error';

		echo CJSON::encode($data);
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
		$model=new Review;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Review']))
		{
			$model->attributes=$_POST['Review'];
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

		if(isset($_POST['Review']))
		{
			$model->attributes=$_POST['Review'];
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
		$dataProvider=new CActiveDataProvider('Review');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Review('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Review']))
			$model->attributes=$_GET['Review'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Review the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Review::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Review $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='review-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
