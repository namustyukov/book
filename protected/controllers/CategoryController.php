<?php

class CategoryController extends Controller
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
				'actions'=>array('index','view', 'ajaxgetsub', 'updateurl', 'list', 'ajaxbooks', 'ajaxsavetext'),
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

	public function actionAjaxsavetext()
	{
		$total_count = $_POST['total_count'];
		$category_id = $_POST['category_id'];
		$begin = $_POST['begin'];
		$text = $_POST['text'];

		$category_text = CategoryText::model()->findByAttributes(array('category_id' => $category_id, 'begin' => $begin));
		if (!$category_text)
		{
			$category_text = new CategoryText;
			$category_text->category_id = $category_id;
			$category_text->begin = $begin;
		}
		$category_text->text = $text;
		$category_text->book_count = $total_count;
		$category_text->save();
		echo 'success';
		Yii::app()->end();
	}

	public function actionAjaxgetsub()
	{
		$id = $_POST['id'];
		$category_sub = Category::model()->findAll(array(
			'condition' => 'parent_id = '.$id,
			'order' => 'name ASC',
		));
		$data = '<option value="-100" selected="selected">Все подкатегории</option>';
		foreach ($category_sub as $row)
		{
			$data .= '<option value="'.$row->id.'">'.$row->name.'</option>';
		}
		echo $data;
		Yii::app()->end();
	}
	
	public function actionUpdateUrl()
	{
		/*$categories = Category::model()->findAll(array('condition' => 'url is NULL', 'order' => 'parent_id ASC'));
		foreach ($categories as $row)
		{
			$row->url = CWord::str2url($row->name);
			$model = Category::model()->findByAttributes(array('url' => $row->url));
			if ($model)
				$row->url = $row->url.'-'.$row->id;
			$row->save();
		}
		echo 'good';*/
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
		$model=new Category;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Category']))
		{
			$model->attributes=$_POST['Category'];
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

		if(isset($_POST['Category']))
		{
			$model->attributes=$_POST['Category'];
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
		$dataProvider=new CActiveDataProvider('Category');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	public function actionAjaxbooks()
	{
		$category = $_POST['category'];
		$begin = $_POST['begin'];
		$data = '';
		$category_text = CategoryText::model()->findByAttributes(array('category_id' => $category, 'begin' => $begin));
		if ($category_text)
			$data = $category_text->text;
		else
		{
			$books = Book::getBookList($begin, 36, $category, NULL, NULL);
			foreach ($books as $row)
			{
				if (!$row->url)
					$row->url = CWord::str2url($row->name.($row->author ? '-'.$row->author : ''));
			}
			foreach ($books as $row)
			{
				$data .= '<a href="/book/'.$row->id.'/'.$row->url.'">
					<div class="products-item '.(($row->date_sync || $row->is_bestseller) ? '' : '__load').'" id="start_'.$row->id.'">
						<div class="products-item-img">
							<img src="'.$row->picture.'" alt="'.$row->name.'">
						</div>
						<div class="products-item-title">
							'.$row->name.'
						</div>
						<div class="products-item-author">
							'.$row->author.'
						</div>
						<div class="products-item-rating">
							<ul>';
								for ($i = 0 ; $i < 5 ; $i++)
									$data .= ($row->mark_reviews && $i < $row->mark_reviews) ? '<li class="__active"></li>' : '<li></li>';
			$data .= '		</ul>
							<div class="products-item-rating-review">
								<span>'.($row->count_reviews ? $row->count_reviews : '0 отзывов').'</span>
							</div>
						</div>
						<div class="products-item-price">';
						if ($row->baseprice > $row->price) {
							$data .= '<div class="products-item-price-old">'.number_format($row->baseprice, 0, ',', ' ').' руб.</div>';
						}else{
							$data .= '<div class="products-item-price-no-diff"></div>';
						}
			$data .= '		<div class="products-item-price-new">'.number_format($row->price, 0, ',', ' ').' <span>руб.</span></div>
							<div class="products-item-price-buy"><span>Оформить заявку</span></div>
						</div>
						<div class="products-item-compare">
							<span>Сравнение цен всех магазинов</span>
						</div>
						<div class="products-item-label '.(($row->diff > 0 && $row->is_bestseller) ? '__best' : ($row->is_bestseller ? '__bestseller' : ($row->diff > 0 ? '__discount' : ''))).'"></div>
					</div>
				</a>';
			}
			if (count($books))
			{
				$category_text_model = new CategoryText;
				$category_text_model->category_id = $category;
				$category_text_model->begin = $begin;
				$category_text_model->text = $data;
				$category_text_model->save();
			}
		}
		echo $data;
		Yii::app()->end();
	}
	
	public function actionList()
	{
		$model = $this->loadModelUrl();

		if (isset($_GET['page']) && $_GET['page'] == 1)
		{
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: http://bookone.ru/category/{$model->url}");
			die();
		}

		$page = isset($_GET['page']) ? $_GET['page'] : 1;
		$begin = ($page - 1) * 36;

		$category_text = CategoryText::model()->findByAttributes(array('category_id' => $model->id, 'begin' => $begin));
		if (!$category_text)
		{
			$books = Book::getBookList($begin, 36, $model->id, NULL, NULL);
			foreach ($books as $row)
			{
				if (!$row->url)
					$row->url = CWord::str2url($row->name.($row->author ? '-'.$row->author : ''));
			}
			$total_count = Book::getBookListCount($model->id, NULL, NULL);
		}
		else
		{
			if ($category_text->book_count > 0)
				$total_count = $category_text->book_count;
			else
			{
				$total_count = Book::getBookListCount($model->id, NULL, NULL);
				$category_text->book_count = $total_count;
				$category_text->save();
			}
		}

		if (!$model->to_parent)
			$categories = Category::model()->findAll(array('condition' => 'parent_id is NULL', 'order' => 'name ASC'));
		else
			$categories = $model->to_parent->to_kids;

		$teg_name = str_replace ( '"' , '' , $model->name );

		$this->pageTitle = "Книги из каталога ".$teg_name." | ".$total_count." книг".($page == 1 ? '' : ' | Страница '.$page);
		$this->meta_k = mb_strtolower($teg_name, 'UTF-8').", литературный жанр, сборник книг, лучшие книги ".date('Y')."".($page == 1 ? "" : ", страница ".$page);
		$this->meta_d = "Найдено ".$total_count." книг в каталоге ".$teg_name.".".($page == 1 ? '' : ' | Страница '.$page);

		$this->render('list', array(
			'books' => $books,
			'categories' => $categories,
			'total_count' => $total_count,
			'current_model' => $model,
			'category_text' => $category_text,
			'page' => $page,
			'begin' => $begin,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Category('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Category']))
			$model->attributes=$_GET['Category'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Category the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Category::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	public function loadModelUrl()
	{
		if(isset($_GET['url']))
			$model = Category::model()->findByAttributes(array('url' => $_GET['url']));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Category $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='category-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
