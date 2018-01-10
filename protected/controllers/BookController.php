<?php
include_once('parse/simple_html_dom.php');

function dateToInt($str)
{
  $keyMonth = array(
    'января' => '01',
    'февраля' => '02',
    'марта' => '03',
    'апреля' => '04',
    'мая' => '05',
    'июня' => '06',
    'июля' => '07',
    'августа' => '08',
    'сентября' => '09',
    'октября' => '10',
    'ноября' => '11',
    'декабря' => '12',
  );
  $dateArr = explode(' ', $str);
  $dateArr[1] = $keyMonth[$dateArr[1]];
  return strtotime(implode('.', $dateArr));
}

class BookController extends Controller
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
				'actions'=>array('index','view', 'updateurl', 'ajaxsavemyabout', 'ajaxreviewupdate', 'ajaxgetimg', 'ajaxviewupdate', 'ajaxreviewmore', 'ajaxgetshop', 'ajaxgetdesc', 'ajaxgetmarketlink'),
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
	
	public function actionUpdateUrl()
	{
		/*$sch = 0;
		while ($sch < 10)
		{
			$books = Book::model()->findAll(array('condition' => 'url is NULL', 'order' => 'id ASC', 'limit' => 1000));
			foreach ($books as $row)
			{
				$row->url = CWord::str2url($row->name);
				$row->url = $row->id.'-'.$row->url;
				$row->save();
			}
			$sch++;
		}
		echo 'good';*/
	}

	public function actionAjaxsavemyabout()
	{
		$html = $_POST['html'];
		$book_id = $_POST['book_id'];

		$model = Book::model()->findByPk($book_id);
		$model->my_about = $html;
		$model->save();

		echo 'ok';
		Yii::app()->end();
	}

	public function actionAjaxgetmarketlink()
	{
		$type = $_POST['type'];
		$book_id = $_POST['book_id'];

		$model = Book::model()->findByPk($book_id);

		$html = '
			<p>Для оформления покупки Вам необходимо перейти на сайт OZON.RU</p>
			<a href="/out?shop=ozon&id='.$model->id.'" target="_blank" class="out_link_button">
				Перейти
			</a>
		';

		echo $html;
		Yii::app()->end();
	}

	public function actionAjaxgetdesc()
	{
		$id = $_POST['id'];
		$model = Book::model()->findByPk($id);
		$description = (mb_strlen($model->description,'utf8') > mb_strlen($model->description_short,'utf8')) ? $model->description : $model->description_short;
		$description = str_replace('<br />', 'br_teg', $description);
		$description = str_replace('<br>', 'br_teg', $description);
		$description = str_replace('</li>', 'br_teg</li>', $description);
		$description = str_replace('<div', 'br_teg<div', $description);
		$description = str_replace('</div', 'br_teg</div', $description);
		$description = str_replace('<p', 'br_teg<p', $description);
		$description = str_replace('</p', 'br_teg</p', $description);
		$description = strip_tags($description);
		$description = preg_replace("/br_teg[\n\s]+br_teg/i", 'br_tegbr_teg', $description);
		$description = preg_replace("/br_teg[\n\s]+br_teg/i", 'br_tegbr_teg', $description);
		$description = preg_replace("/br_teg[\n\s]+br_teg/i", 'br_tegbr_teg', $description);
		$description = str_replace('br_tegbr_tegbr_teg', 'br_tegbr_teg', $description);
		$description = str_replace('br_tegbr_tegbr_teg', 'br_tegbr_teg', $description);
		$description = str_replace('br_tegbr_tegbr_teg', 'br_tegbr_teg', $description);
		$description = str_replace('br_tegbr_tegbr_teg', 'br_tegbr_teg', $description);
		$description = str_replace('br_tegbr_tegbr_teg', 'br_tegbr_teg', $description);
		$description = str_replace('br_teg', '<br />', $description);
		echo $description;
		Yii::app()->end();
	}

	public function actionAjaxgetshop()
	{
		$id = $_POST['id'];
		$model = Book::model()->findByPk($id);
		$fam = '';
		if ($model->author)
		{
			$author_arr = explode(",", $model->author);
			$author_main = str_replace ( '.' , ' ' , $author_arr[0] );
			$fio_arr = explode(' ', $author_main);
			$fam = trim($fio_arr[0]);
			foreach ($fio_arr as $row)
				if (mb_strlen(trim($row), 'UTF-8') > mb_strlen(trim($fam), 'UTF-8'))
					$fam = trim($row);
		}
		// $readru = Readru::model()->find('name = :name and author like :author', array(':name' => $model->name, ':author' => '%'.$fam.'%'));
		$labirint = Labirint::model()->find('name = :name and author like :author', array(':name' => $model->name, ':author' => '%'.$fam.'%'));
		$data = '';
		/*if ($readru)
		{
			$data .= '<li class="__readru">
				<a href="/out?shop=readru&id='.$readru->id.'" target="_blank">Read.ru</a> - <span>'.number_format($readru->price, 0, ',', ' ').'</span> р.
			</li>';
		}*/
		if ($labirint)
		{
			$data .= '<li class="__labirint">
				<a href="/out?shop=labirint&id='.$labirint->id.'" target="_blank">Лабиринт</a> - <span>'.number_format($labirint->price, 0, ',', ' ').'</span> р.
			</li>';
		}
		echo $data;
		Yii::app()->end();
	}

	public function actionAjaxviewupdate()
	{
		$id = $_POST['id'];
		$model = Book::setData($id);
		echo CJSON::encode(array('price' => number_format($model->price, 0, ',', ' '), 'baseprice' => number_format($model->baseprice, 0, ',', ' ')));
		Yii::app()->end();
	}
	
	public function actionAjaxgetimg()
	{
		$id = $_POST['id'];
		$model = Book::model()->findByPk($id);
		if ($model)
			$data = '<img src="'.$model->picture.'" alt="'.$model->name.'">';
		echo $data;
		Yii::app()->end();
	}

	public function actionAjaxreviewmore()
	{
		$book_id = $_POST['book_id'];
		$begin = $_POST['begin'];
		$reviews = Review::getList($begin, 10, $book_id);
		$data = '';
		foreach ($reviews as $row)
		{
			$data .= '<div class="product-review-item">
				<div class="review-item-head">
					<div class="review-item-head-rating">
						<ul>';
							for ($i = 0 ; $i < 5 ; $i++)
								$data .= ($row->mark && $i < $row->mark) ? '<li class="__active"></li>' : '<li></li>';
			$data .= '	</ul>
					</div>
					<div class="review-item-head-name">';
						$date=explode(".",date('d.m.Y', $row->date_create));
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
						};
			$data .= '	<span>'.$row->fio.'</span> | <small>'.($date[0]*1).' '.$m.' '.$date[2].'</small>
					</div>
				</div>
				<div class="review-item-content">
					<div class="review-item-content-wrapper">
						<p>'.$row->text.'</p>
					</div>
					<div class="review-item-content-wrapper_more __hidden">
						<span>Показать весь текст</span>
					</div>
				</div>
			</div>';
		}
		echo $data;
		Yii::app()->end();
	}

	public function actionAjaxreviewupdate()
	{
		$id = $_POST['id'];
		$model = Book::model()->findByPk($id);
		$review_arr = array();
		$html_review = new simple_html_dom();
		$html_review->load_file('http://www.ozon.ru/reviews/'.$model->donor_id.'/');
		foreach ($html_review->find('div[itemprop=review]') as $review)
		{
			$review_model = new Review;
			$review_model->book_id = $id;
			$author_dom = $review->find('span[itemprop=author]', 0);
			$author_dom->find('a', 0)->outertext = '';
			$fio = $author_dom->innertext;
			$review_model->fio = iconv("windows-1251", "UTF-8", trim($fio));
			$date = $review->find('span[itemprop=datePublished]', 0)->content;
			$date = iconv("windows-1251", "UTF-8", trim($date));
			$review_model->date_create = dateToInt($date);
			$mark = $review->find('meta[itemprop=ratingValue]', 0)->content;
			$review_model->mark = $mark;
			$text = $review->find('p[itemprop=reviewBody]', 0)->plaintext;
			$review_model->text = iconv("windows-1251", "UTF-8", trim($text));
			$review_model->save();
			$review_arr[] = $review_model;
		}
		$html_review->clear();
		unset($html_review);

		$reviews = Review::getList(0, 10, $id);
		$data = '';
		if (count($reviews))
		{
			foreach ($reviews as $row)
			{
				$data .= '<div class="product-review-item">
					<div class="review-item-head">
						<div class="review-item-head-rating">
							<ul>';
								for ($i = 0 ; $i < 5 ; $i++)
									$data .= ($row->mark && $i < $row->mark) ? '<li class="__active"></li>' : '<li></li>';
				$data .= '	</ul>
						</div>
						<div class="review-item-head-name">';
							$date=explode(".",date('d.m.Y', $row->date_create));
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
							};
				$data .= '	<span>'.$row->fio.'</span> | <small>'.($date[0]*1).' '.$m.' '.$date[2].'</small>
						</div>
					</div>
					<div class="review-item-content">
						<div class="review-item-content-wrapper">
							<p>'.$row->text.'</p>
						</div>
						<div class="review-item-content-wrapper_more __hidden">
							<span>Показать весь текст</span>
						</div>
					</div>
				</div>';
			}
		}
		else
			$data .= '<div class="product-review-list-none">Пока нет ни одного отзыва</div>';
		echo CJSON::encode(array('html' => $data, 'review_count' => count($review_arr)));
		Yii::app()->end();
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView()
	{
		// $model = Book::setData($_GET['id']);
		$model = $this->loadModel();
		if (!$model->url)
			$model->url = CWord::str2url($model->name.($model->author ? '-'.$model->author : ''));
		if ($model->url != $_GET['url'])
		{
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: http://bookone.ru/book/".$model->id."/".$model->url);
			die();
		}

		$fam = '';
		if ($model->author)
		{
			$author_arr = explode(",", $model->author);
			$author_main = str_replace ( '.' , ' ' , $author_arr[0] );
			$fio_arr = explode(' ', $author_main);
			$fam = trim($fio_arr[0]);
			foreach ($fio_arr as $row)
				if (mb_strlen(trim($row), 'UTF-8') > mb_strlen(trim($fam), 'UTF-8'))
					$fam = trim($row);
		}
		$litres = Litres::model()->find('name = :name and author like :author', array(':name' => $model->name, ':author' => '%'.$fam.'%'));
		$books = Book::getBookList(0, 12, $model->category_book[0]->category_id, NULL, NULL);
		if (count($books) < 11)
			$books = Book::getBookList(0, 12, $model->category_book[0]->category->to_parent->id, NULL, NULL);
		if (count($books) < 11)
			$books = Book::getBookList(0, 12, $model->category_book[0]->category->to_parent->id, NULL, NULL);
		foreach ($books as $row)
		{
			if (!$row->url)
				$row->url = CWord::str2url($row->name.($row->author ? '-'.$row->author : ''));
		}

		$teg_name = str_replace ( '"' , '' , $model->name );

		$shopOnline = ShopOnline::model()->findAll(array(
			'order' => 'rating ASC'
		));

		$this->pageTitle = $teg_name." ".($model->author ? $model->author : "")." - содержание и отзывы книги, места продаж";
		// $this->meta_k = "".mb_strtolower($teg_name, 'UTF-8')." книга, ".mb_strtolower($teg_name, 'UTF-8')." отзывы, купить книгу ".mb_strtolower($teg_name, 'UTF-8')."";
		$this->meta_d = "".$teg_name." ".($model->author ? "- ".$model->author."" : "")." - аннотация книги, отзывы и рецензии читателей, а так же способы купить книгу в вашем городе.";
		
		$this->render('view',array(
			'model' => $model,
			'litres' => $litres,
			'books' => $books,
			'teg_name' => $teg_name,
			'shopOnline' => $shopOnline,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Book;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Book']))
		{
			$model->attributes=$_POST['Book'];
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

		if(isset($_POST['Book']))
		{
			$model->attributes=$_POST['Book'];
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
		$dataProvider=new CActiveDataProvider('Book');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Book('search'); // need Book
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Book']))
			$model->attributes=$_GET['Book'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Book the loaded model
	 * @throws CHttpException
	 */
	public function loadModel()
	{
		$model = Book::model()->findByPk($_GET['id']);
		if ($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	public function loadModelUrl()
	{
		if(isset($_GET['url']))
			$model = Book::model()->findByAttributes(array('url' => $_GET['url']));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Book $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='book-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
