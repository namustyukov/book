<?php

include_once('parse/simple_html_dom.php');

class CompanyController extends Controller
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
				'actions'=>array('admin','delete','company','parseCompany'),
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
		$other = Company::model()->findAll($criteria);

		$criteria = new CDbCriteria();
		$criteria->condition = "city_id = ".$this->city->id;
		$countCompany = Company::model()->count($criteria);

		$this->pageTitle = "Книжный магазин {$model->name} в городе {$this->city->gorod}";
		$this->meta_k = "магазин {$model->name}, купить книгу {$this->city->gorod}, адрес {$model->name}, телефон {$model->name}, сайт {$model->name}";
		$this->meta_d = "Книжный магазин {$model->name} в городе {$this->city->gorod} - адрес, телефон, сайт и рейтинг среди других магазинов";

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
		$model=new Company;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Company']))
		{
			$model->attributes=$_POST['Company'];
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

		if(isset($_POST['Company']))
		{
			$model->attributes=$_POST['Company'];
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
		$shops = Company::model()->findAll(array(
			'condition' => 'city_id = :city_id',
			'params' => array(
				':city_id' => $this->city->id,
			),
			'order' => 'rating ASC',
		));

		$this->pageTitle = "Книжные магазины в городе {$this->city->gorod}";
		$this->meta_k = "купить книгу, {$this->city->gorod}, магазины книг {$this->city->gorod}, книжные магазины, список магазинов";
		$this->meta_d = "Список книжных магазинов в городе {$this->city->gorod} - адреса и телефоны";

		$this->render('index',array(
			'shops' => $shops,
			'countCompany' => count($shops),
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Company('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Company']))
			$model->attributes=$_GET['Company'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModelUrl()
	{
		if(isset($_GET['url']) && $this->city)
			$model=Company::model()->find('url=:url and city_id=:city_id', array(':url'=>$_GET['url'], ':city_id'=>$this->city->id));
		if(isset($_GET['id']))
			$model=Company::model()->findByPk($_GET['id']);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Company the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Company::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Company $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='company-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionParseCompany()
	{
		$category = '/biblioteki/';
		$categoryId = 2;
		$cities = City::model()->findAll(array(
			'condition' => 'rating is NULL'
		));

		// update `city` set rating=NULL, region_id=NULL
		// echo 'categories = '.count($categories).'<br>';
		echo '-----------begin----------<br>';
		echo 'count = '.count($cities).'<br>';
		
		foreach ($cities as $city)
		{
			$url = $city->donor_url.$category;
			$page_id = $city->region_id ? $city->region_id : 1;
			for ($i=$page_id; $i < $page_id + 10; $i++)
			{
				$url_page = $url.'page-'.$i.'/';

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url_page);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				curl_setopt($ch, CURLOPT_ENCODING, "");
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
				curl_setopt($ch, CURLOPT_TIMEOUT, 120);
				curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:56.0) Gecko/20100101 Firefox/56.0');  // useragent
				$content = curl_exec( $ch );
				$content = $content ? $content : '';
				curl_close($ch);

				$html_item = new simple_html_dom();
				$html_item->load($content);

				if ($html_item->find('.addresses-list', 0))
				{
					if (count($html_item->find('.addresses-list .list-item')))
					{
						foreach ($html_item->find('.addresses-list .list-item') as $item)
						{
							$href = trim($item->find('h3 a', 0)->href);
							$name = trim($item->find('h3 a', 0)->plaintext);

							$address = '';
							$phone = '';
							$worktime = '';
							$site = '';

							foreach ($item->find('.row') as $row)
							{
								if ($row->find('.left', 0)->plaintext == 'Адрес:')
									$address = trim($row->find('.right', 0)->plaintext);

								if ($row->find('.left', 0)->plaintext == 'Телефон:')
									$phone = trim($row->find('.right', 0)->plaintext);

								if ($row->find('.left', 0)->plaintext == 'Часы работы:')
									$worktime = trim($row->find('.right', 0)->plaintext);

								if ($row->find('.left', 0)->plaintext == 'Сайт:')
								{
									$site = trim($row->find('.right span.make-link', 0)->attr['data-link']);
									$site = base64_decode($site);
								}
							}

							if (mb_strpos($name, 'иблиот')) { // библиотека
								$model = new Biblioteki;
								$model->name = $name;
								$model->donor_site = $href;
								$model->address = $address;
								$model->phone = $phone;
								$model->worktime = $worktime;
								$model->site = $site;
								$model->city_id = $city->id;
								$model->category_id = $categoryId;
								$model->save();
							}
						}
						$city->region_id = $i + 1;
					}
					else
					{
						$city->region_id = null;
						break;
					}
				}
				else
				{
					$city->region_id = null;
					break;
				}

				$html_item->clear();
				unset($html_item);

			}
			if (!$city->region_id)
				$city->rating = 1;
			$city->save();
			echo $url.'<br>';
			echo '<script type="text/javascript">
				location.reload();
			</script>';

			break;
		}
		echo '-----------end----------<br>';
	}
}
