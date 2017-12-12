<?php
include_once('parse/simple_html_dom.php');

class ParseController extends Controller
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
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('category', 'book', 'html', 'htmltobook', 'updateurl', 'litres', 'readru', 'labirint', 'english'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	/*
	update book, book_html set 
	book.is_bestseller = book_html.is_bestseller,
	book.mark_reviews = book_html.mark_reviews,
	book.count_reviews = book_html.count_reviews
	where book.donor_id = book_html.donor_id
	*/

	public function actionEnglish()
	{
		/*$products = Book::model()->findAll(array(
			'condition'=>"language = 'Английский'",
			'order' => 'is_bestseller DESC, date_sync DESC, mark_reviews DESC, id ASC',
			'limit' => 5000
		));
		echo 'do = '.count($products);
		$sch = 0;
		foreach ($products as $row)
		{
			$link = new CategoryBook;
			$link->category_id = 1132527;
			$link->book_id = $row->id;
			$link->save();
			$sch++;
		}
		echo '<br>posle = '.$sch;*/

		$products = Book::model()->findAll(array(
			'condition'=>"id in (select book_id from category_book where category_id = 1132527)",
			'order' => 'is_bestseller DESC, date_sync DESC, mark_reviews DESC, id ASC',
			'limit' => 5000,
			'offset' => 10000,
		));
		echo 'do = '.count($products);
		$sch = 0;
		foreach ($products as $row)
		{
			$category_new = Category::model()->find(array(
				'condition'=>"parent_id = 1132527 and name = '{$row->language}'",
			));
			if (!$category_new)
			{
				$category_new = new Category;
				$category_new->name = $row->language;
				$category_new->parent_id = 1132527;
				$category_new->save();
				$category_new->url = CWord::str2url($category_new->name);
				$category_new->url = $category_new->url.'-'.$category_new->id;
				$category_new->save();
			}
			$link = new CategoryBook;
			$link->category_id = $category_new->id;
			$link->book_id = $row->id;
			$link->save();
			$sch++;
		}
		echo '<br>posle = '.$sch;
	}

	public function actionLabirint()
	{
		$str = '';
		$sch = 0;
		$in = 0;
		echo '-----begin-----<br>';
		$fl=fopen("import/labirint.xml", "r");
		while(!feof($fl))
		{
			$line = fgets($fl);
			if (strpos('1'.$line, '<offer'))
			{
				$str = $line;
				$in = 1;
			}
			else
				$str .= $line;
			if (strpos('1'.$line, '</offer') && $in)
			{
				$in = 0;
				$offer = new SimpleXMLElement($str);
				$donor_id = (string) $offer['id'];

				$model = new Labirint;
				$model->name = $offer->name;
				$model->author = $offer->author;
				$model->price = (double) $offer->price;
				$model->donor_url = $offer->url;
				$model->donor_id = (string) $offer['id'];
				$model->save();
				$sch++;
			}
		}
		fclose($fl);
		echo $sch;
		echo '<br>-----end-----<br>';
	}

	public function actionReadru()
	{
		$str = '';
		$sch = 0;
		$in = 0;
		echo '-----begin-----<br>';
		$fl=fopen("import/readru.xml", "r");
		while(!feof($fl))
		{
			$line = fgets($fl);
			if (strpos('1'.$line, '<offer'))
			{
				$str = $line;
				$in = 1;
			}
			else
				$str .= $line;
			if (strpos('1'.$line, '</offer') && $in)
			{
				$in = 0;
				$offer = new SimpleXMLElement($str);
				$donor_id = (string) $offer['id'];
				// $book = Readru::model()->find('donor_id = :donor_id', array(':donor_id' => $donor_id));
				// if (!$book)
				// {
					$model = new Readru;
					$model->name = $offer->name;
					$model->author = $offer->author;
					$model->price = (double) $offer->price;
					$model->donor_url = $offer->url;
					$model->donor_id = (string) $offer['id'];
					$model->save();
					$sch++;
				// }
			}
		}
		fclose($fl);
		echo $sch;
		echo '<br>-----end-----<br>';
	}
	
	public function actionLitres()
	{
		$str = '';
		$sch = 0;
		$in = 0;
		echo '-----begin-----<br>';
		$fl=fopen("import/litres.xml", "r");
		while(!feof($fl))
		{
			$line = fgets($fl);
			if (strpos('1'.$line, '<offer'))
			{
				$str = $line;
				$in = 1;
			}
			else
				$str .= $line;
			if (strpos('1'.$line, '</offer') && $in)
			{
				$in = 0;
				$offer = new SimpleXMLElement($str);
				$donor_id = (string) $offer['id'];
				$book = Litres::model()->find('donor_id = :donor_id', array(':donor_id' => $donor_id));
				if (!$book)
				{
					$model = new Litres;
					$model->name = $offer->name;
					$model->author = $offer->author;
					$model->price = (double) $offer->price;
					$model->donor_url = $offer->url;
					$model->donor_id = (string) $offer['id'];
					if ($offer->downloadable)
						$model->downloadable = 1;
					$model->save();
					$sch++;
				}
			}
		}
		fclose($fl);
		echo $sch;
		echo '<br>-----end-----<br>';
	}
	
	public function actionUpdateUrl()
	{
		$sch = 0;
		while ($sch < 10)
		{
			$books = Bestseller::model()->findAll(array('condition' => 'url is NULL', 'order' => 'id ASC', 'limit' => 1000));
			echo 'count = '.count($books).'<br>';
			foreach ($books as $row)
			{
				$row->url = CWord::str2url($row->name.'-'.($row->author ? $row->author : $row->id));
				$row->save();
			}
			$sch++;
		}
		echo 'good';
	}
	
	public function actionHtmltobook()
	{
		$html = Book_html::model()->findAll(array(
			'limit' => 1000,
		));
		echo '----------------begin------------<br>';
		echo 'count = '.count($html).'<br>';
		foreach ($html as $row)
		{
			$model = Book::model()->findByAttributes(array('donor_id' => $row->donor_id));
			if ($model)
			{
				$model->is_bestseller = $row->is_bestseller;
				$model->mark_reviews = $row->mark_reviews;
				$model->count_reviews = $row->count_reviews;
				$model->save();
				$row->delete();
			}
			else
				$row->delete();
		}
		echo '----------------end------------<br>';
	}

	public function actionHtml()
	{
		$start = $_GET['start'];
		$connection = Yii::app()->db;
		$html = new simple_html_dom();
		echo '---------------------begin----------------<br>';
		$html->load_file('html/book.html');
		$items = $html->find('#bTilesModeShow div.bOneTile');
		echo 'count page = '.count($items).'<br>';
		foreach ($items as $row)
		{
			$id = $row->find('div.js_saleblock span.iteminfo', 0)->js_itemid;
			$review_dom = $row->find('a.eOneTile_Stars', 0);
			$mark_reviews = NULL;
			$count_reviews = NULL;
			if ($review_dom)
			{
				$count_reviews = $review_dom->find('i', 0)->plaintext;
				$class = $review_dom->find('div[class=bStars]', 0)->class;
				if (strpos($class, '5'))
					$mark_reviews = 5;
				if (strpos($class, '4'))
					$mark_reviews = 4;
				if (strpos($class, '3'))
					$mark_reviews = 3;
				if (strpos($class, '2'))
					$mark_reviews = 2;
				if (strpos($class, '1'))
					$mark_reviews = 1;
			}
			if ($start)
			{
				/*$command = $connection->createCommand(
				"
					UPDATE book SET is_bestseller = 1, mark_reviews = ".($mark_reviews ? $mark_reviews : "NULL").", count_reviews = ".($count_reviews ? "'".$count_reviews."'" : "NULL")." WHERE donor_id = {$id}
				"
				);
				$command->query();*/
				
				$model = Book_html::model()->findByAttributes(array('donor_id' => $id));
				if (!$model)
				{
					$model = new Book_html;
					$model->donor_id = $id;
				}
				$model->is_bestseller = 1;
				$model->mark_reviews = $mark_reviews;
				$model->count_reviews = $count_reviews;
				$model->save();
			}
			if (!$start)
			{
				echo 'model='.$model->id.'------'.'count_reviews='.$count_reviews.'------'.'mark_reviews='.$mark_reviews;
				break;
			}
		}
		echo '<br>---------------------end----------------';
		$html->clear();
		unset($html);
	}
	
	public function actionBook()
	{
		$str = '';
		$sch = 0;
		$in = 0;
		echo '-----begin-----<br>';
		$fl=fopen("import/book.xml", "r");
		while(!feof($fl))
		{
			$line = fgets($fl);
			if (strpos('1'.$line, '<offer'))
			{
				$str = $line;
				$in = 1;
			}
			else
				$str .= $line;
			if (strpos('1'.$line, '</offer') && $in)
			{
				$in = 0;
				$offer = new SimpleXMLElement($str);
				$donor_id = (string) $offer['id'];
				$book = Book::model()->find('donor_id = :donor_id', array(':donor_id' => $donor_id));
				if (!$book)
				{
					$model = new Book;
					$model->name = $offer->name;
					$model->author = $offer->author;
					$model->description_short = $offer->description;
					$model->type_book = $offer['type'];
					$model->price = (double) $offer->price;
					$model->baseprice = (double) $offer->baseprice;
					$model->picture = $offer->picture[0];
					$model->language = $offer->language;
					$model->publisher = $offer->publisher;
					$model->page_extent = $offer->page_extent;
					$model->ISBN = $offer->ISBN;
					$model->year = (int) $offer->year;
					$model->binding = $offer->binding;
					$model->donor_url = $offer->url;
					$model->donor_id = (string) $offer['id'];
					$model->save();
					foreach ($offer->categoryId as $categoryId) {
						$link = new CategoryBook;
						$link->category_id = (int) $categoryId;
						$link->book_id = $model->id;
						$link->save();
					}
					// echo $model->name.' '.$model->author.' '.$model->donor_id.' '.$offer['type'].'<br>';
					// echo (string) $offer['id'].' ';
					$sch++;
				}
			}
		}
		fclose($fl);
		echo $sch;
		echo '<br>-----end-----<br>';
		/*$offers = simplexml_load_file('import/book.xml');
		$sch = 0;
		echo '-----begin-----<br>';
		foreach ($offers->offer as $offer) {
			$donor_id = (string) $offer['id'];
			$book = Book::model()->find('donor_id = :donor_id', array(':donor_id' => $donor_id));
			if (!$book)
			{
				$model = new Book;
				$model->name = $offer->name;
				$model->author = $offer->author;
				$model->description_short = $offer->description;
				$model->type_book = $offer['type'];
				$model->price = (double) $offer->price;
				$model->baseprice = (double) $offer->baseprice;
				$model->picture = $offer->picture[0];
				$model->language = $offer->language;
				$model->publisher = $offer->publisher;
				$model->page_extent = $offer->page_extent;
				$model->ISBN = $offer->ISBN;
				$model->year = (int) $offer->year;
				$model->binding = $offer->binding;
				$model->donor_url = $offer->url;
				$model->donor_id = (string) $offer['id'];
				$model->save();
				foreach ($offer->categoryId as $categoryId) {
					$link = new CategoryBook;
					$link->category_id = (int) $categoryId;
					$link->book_id = $model->id;
					$link->save();
				}
				// echo $model->name.' '.$model->author.' '.$model->donor_id.' '.$offer['type'].'<br>';
				$sch++;
			}
		}
		echo $sch;
		echo '<br>-----end-----<br>';*/
	}
	
	public function actionCategory()
	{
		$categories = simplexml_load_file('import/category.xml');
		$sch = 0;
		foreach ($categories->category as $category) {
			$model = new Category;
			$model->id = $category['id'];
			$model->name = $category;
			if ($category['parentId'])
				$model->parent_id = (int) $category['parentId'];
			$model->save();
			$sch++;
		}
		echo $sch;
	}
}
