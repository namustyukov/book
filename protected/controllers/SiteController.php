<?php
class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	
	public function actionXml()
	{
		/*$categories = Category::model()->findAll(array(
			'order' => 'id ASC'
		));
		echo '<url><loc>http://bookone.ru/</loc></url>
';
		foreach ($categories as $row)
		{
			echo '<url><loc>http://bookone.ru/category/'.$row->url.'</loc></url>
';
		}*/
		/*$books = Book::model()->findAll(array(
			'order' => 'mark_reviews DESC, id ASC',
			'condition' => 'is_bestseller = 1',
			'limit' => 3000,
			'offset' => 9000,
		));
		foreach ($books as $row)
		{
			if (!$row->url)
				$row->url = CWord::str2url($row->name.($row->author ? '-'.$row->author : ''));
			echo '<url><loc>http://bookone.ru/book/'.$row->id.'/'.$row->url.'</loc></url>
';
		}*/
		// нехудожественная лит. Book::getBookList(64000, 5000, 1137924, NULL, NULL);
		// художественная Book::getBookList(60000, 5000, 1140879, NULL, NULL);
		// детям Book::getBookList(50000, 5000, 1137436, NULL, NULL);
		// бизнес Book::getBookList(25000, 5000, 1137234, NULL, NULL);
		// учебная Book::getBookList(45000, 5000, 1139697, NULL, NULL);
		// иностр Book::getBookList(15000, 5000, 1132527, NULL, NULL);
		$books = Book::getBookList(45000, 5000, 1139697, NULL, NULL);
		foreach ($books as $row)
		{
			if (!$row->is_bestseller && $row->language == 'Русский')
			{
				if (!$row->url)
					$row->url = CWord::str2url($row->name.($row->author ? '-'.$row->author : ''));
				echo '<url><loc>http://bookone.ru/book/'.$row->id.'/'.$row->url.'</loc></url>
	';
			}
		}
		Yii::app()->end();
	}

	public function actionOut()
	{
		$shop = $_GET['shop'];
		$id = $_GET['id'];
		if ($shop == 'ozon')
		{
			$model = Book::model()->findByPk($id);
			$url = str_replace('from=prt_xml_facet', 'partner=namustyukov', $model->donor_url);
		}
		elseif ($shop == 'litres')
		{
			$model = Litres::model()->findByPk($id);
			$url = $model->donor_url.'?lfrom=200720323';
		}
		elseif ($shop == 'readru')
		{
			$model = Readru::model()->findByPk($id);
			$url = $model->donor_url.'?pp=4574';
		}
		elseif ($shop == 'labirint')
		{
			$model = Labirint::model()->findByPk($id);
			$url = $model->donor_url.'?p=16404';
		}
		Header ("Location:".$url);
		Yii::app()->end();
	}

	public function actionAjaxsubscription()
	{
	    $subscription_category = $_POST['subscription_category'];
		$subscription_email = $_POST['subscription_email'];

		$model = new Subscription;
		$model->category = $subscription_category;
		$model->email = $subscription_email;
		$model->save();

		echo 'good';
		Yii::app()->end();
	}

	public function actionAjaxcreatemessage()
	{
	    $message_name = $_POST['message_name'];
		$message_email = $_POST['message_email'];
		$message_message = $_POST['message_message'];
		$url = $_POST['url'];

		$model = new Feedback;
		$model->name = $message_name;
		$model->email = $message_email;
		$model->message = $message_message;
		$model->url = $url;
		$model->save();

		$data='';
		$data.="URL: ".$url."<br />";
		$data.="Имя: ".$message_name."<br />";
		$data.="E-mail: ".$message_email."<br />";
		$data.="Текст:<br />".$message_message;
		$to  = "bookone <bookoneru@mail.ru>";
		$subject = "Сообщение от пользователя | BOOKONE.RU";
		$message = $data;
		$headers  = "Content-type: text/html; charset=utf8 \r\n";
		$headers .= "From: BOOKONE.RU <bookone.ru>\r\n";
		mail($to, $subject, $message, $headers);
		echo 'good';
		Yii::app()->end();
	}
	
	public function actionAjaxsearch()
	{
	    $category = (int) $_POST['category'];
		$category_sub = (int) $_POST['category_sub'];
		$text = $_POST['text'] ? $_POST['text'] : '';
		$data = '';
		$category = $category_sub != -100 ? $category_sub : ($category != -100 ? $category : NULL);
		$books = Book::getSearchBooks($text, $category);
		foreach ($books as $row)
		{
			if (!$row->url)
				$row->url = CWord::str2url($row->name.($row->author ? '-'.$row->author : ''));
			$data .= '<a href="/book/'.$row->id.'/'.$row->url.'">
				<div class="text-search-help-row" title="'.str_replace('"', '', $row->fullname).'">
					<div class="text-search-help-img"><img src="'.$row->picture.'"></div>
					<div class="text-search-help-text">
						<div class="text-search-help-name">'.$row->name.'</div>
						<div class="text-search-help-author">'.$row->author.'</div>
					</div>
				</div>
			</a>';
		}
		if (!$data)
			$data = '<div class="text-search-help-empty">Нет указанной книги</div>';
		echo $data;
		Yii::app()->end();
	}
	
	public function actionAjaxgetitem()
	{
		$id = $_POST['id'];
		$model_book = Book::setData($id);
		$data = '';
		$data .= '<div class="products-item-img">
						<img src="'.Yii::app()->request->baseUrl.'/img/'.$model_book->picture_my.'" alt="'.$model_book->name.'">
					</div>
					<div class="products-item-title">
						'.$model_book->name.'
					</div>
					<div class="products-item-author">
						'.$model_book->author.'
					</div>
					<div class="products-item-rating">
						<ul>';
							for ($i = 0 ; $i < 5 ; $i++)
								$data .= ($model_book->mark_reviews && $i < $model_book->mark_reviews) ? '<li class="__active"></li>' : '<li></li>';
		$data .= '		</ul>
						<div class="products-item-rating-review">
							<span>'.($model_book->count_reviews ? $model_book->count_reviews : '0 отзывов').'</span>
						</div>
					</div>
					<div class="products-item-price">';
					if ($model_book->baseprice > $model_book->price) {
						$data .= '<div class="products-item-price-old">'.number_format($model_book->baseprice, 0, ',', ' ').' руб.</div>';
					}else{
						$data .= '<div class="products-item-price-no-diff"></div>';
					}
		$data .= '		<div class="products-item-price-new">'.number_format($model_book->price, 0, ',', ' ').' <span>руб.</span></div>
						<div class="products-item-price-buy"><span>Оформить заявку</span></div>
					</div>
					<div class="products-item-compare">
						<span>Сравнение цен всех магазинов</span>
					</div>
					<div class="products-item-label '.((($model_book->baseprice - $model_book->price) > 0 && $model_book->is_bestseller) ? '__best' : ($model_book->is_bestseller ? '__bestseller' : (($model_book->baseprice - $model_book->price) > 0 ? '__discount' : ''))).'"></div>';
		echo $data;
		Yii::app()->end();
	}
	
	public function actionAjaxbooks()
	{
		$begin = $_POST['begin'];
		$data = '';
		$category_text = CategoryText::model()->findByAttributes(array('category_id' => 111, 'begin' => $begin));
		if ($category_text)
			$data = $category_text->text;
		else
		{
			$books = Book::getBookList($begin, 32, 1140879, NULL, NULL);
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
				$category_text_model->category_id = 111;
				$category_text_model->begin = $begin;
				$category_text_model->text = $data;
				$category_text_model->save();
			}
		}
		echo $data;
		Yii::app()->end();
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionIndex()
	{
		$category_text = CategoryText::model()->findByAttributes(array('category_id' => 111, 'begin' => 0));
		if (!$category_text)
		{
			$books = Book::getBookList(0, 32, 1140879, NULL, NULL);
			foreach ($books as $row)
			{
				if (!$row->url)
					$row->url = CWord::str2url($row->name.($row->author ? '-'.$row->author : ''));
			}
		}
		$this->pageTitle = "BOOKONE.RU - крупнейший каталог книг с описанием, отзывами и рыночной стоимостью";
		$this->meta_k = "книга, найти книгу, книга бестселлер, магазин книг, лучшие книги ".date('Y').", новинки книг ".date('Y')."";
		$this->meta_d = "BOOKONE.RU - это удобный инструмент поиска книги в каталоге из 550 тыс. изданий, среди которых печатные издания, аудиокниги, электронные книги.";
		$this->render('index',array(
			'books' => $books,
			'category_text' => $category_text,
		));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if (!defined('CRYPT_BLOWFISH')||!CRYPT_BLOWFISH)
			throw new CHttpException(500,"This application requires that PHP was compiled with Blowfish support for crypt().");

		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}
