<?php
include_once('parse/simple_html_dom.php');

/**
 * This is the model class for table "book".
 *
 * The followings are the available columns in table 'book':
 * @property integer $id
 * @property string $name
 * @property string $author
 * @property string $description
 * @property string $description_short
 * @property string $type_book
 * @property integer $type_book_id
 * @property double $price
 * @property double $baseprice
 * @property string $picture
 * @property string $language
 * @property integer $language_id
 * @property string $publisher
 * @property integer $publisher_id
 * @property string $page_extent
 * @property string $ISBN
 * @property integer $year
 * @property integer $is_new
 * @property integer $is_bestseller
 * @property integer $like_count
 * @property integer $not_like_count
 * @property double $mark_reviews
 * @property string $url
 * @property integer $date_sync
 * @property string $donor_url
 * @property integer $donor_id
 */
$category_list_book_model;
function repeat($model)
{
	global $category_list_book_model;
	foreach ($model->to_kids as $kid)
	{
		$category_list_book_model[] = $kid->id;
		if (count($kid->to_kids))
			repeat($kid);
	}
} 

function categoryArr($category)
{
	global $category_list_book_model;
	$category_list_book_model = array();
	if ($category && $category != -100)
	{
		$category_list_book_model[] = $category;
		$category_model = Category::model()->findByPk($category);
		foreach ($category_model->to_kids as $kid)
		{
			$category_list_book_model[] = $kid->id;
			if (count($kid->to_kids))
				repeat($kid);
		}
	}
	return $category_list_book_model;
} 
 
class Book extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'book';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type_book_id, language_id, publisher_id, year, is_new, is_bestseller, like_count, not_like_count, date_sync', 'numerical', 'integerOnly'=>true),
			array('price, baseprice, mark_reviews', 'numerical'),
			array('name, author, url, donor_url, ISBN', 'length', 'max'=>500),
			array('type_book, language, binding, count_reviews', 'length', 'max'=>100),
			array('picture, picture_my', 'length', 'max'=>200),
			array('publisher', 'length', 'max'=>300),
			array('page_extent, donor_id', 'length', 'max'=>20),
			array('description, description_short, my_about', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, author, description, description_short, my_about, type_book, type_book_id, binding, price, baseprice, picture, picture_my, language, language_id, publisher, publisher_id, page_extent, ISBN, year, is_new, is_bestseller, like_count, not_like_count, mark_reviews, count_reviews, url, date_sync, donor_url, donor_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'category_book' => array(self::HAS_MANY, 'CategoryBook', 'book_id'),
			'review' => array(self::HAS_MANY, 'Review', 'book_id', 'order'=>'review.date_create DESC'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'author' => 'Author',
			'description' => 'Description',
			'description_short' => 'Description Short',
			'my_about' => 'My about',
			'type_book' => 'Type Book',
			'type_book_id' => 'Type Book',
			'price' => 'Price',
			'baseprice' => 'Baseprice',
			'picture' => 'Picture',
			'picture_my' => 'Picture_my',
			'language' => 'Language',
			'language_id' => 'Language',
			'publisher' => 'Publisher',
			'publisher_id' => 'Publisher',
			'page_extent' => 'Page Extent',
			'ISBN' => 'Isbn',
			'year' => 'Year',
			'binding' => 'Binding',
			'is_new' => 'Is New',
			'is_bestseller' => 'Is Bestseller',
			'like_count' => 'Like Count',
			'not_like_count' => 'Not Like Count',
			'mark_reviews' => 'Mark Reviews',
			'count_reviews' => 'Count_reviews',
			'url' => 'Url',
			'date_sync' => 'Date Sync',
			'donor_url' => 'Donor Url',
			'donor_id' => 'Donor',
		);
	}
	
	public function setDataUrl($id)
	{
		$model = Book::model()->findByPk($id);
		if (!$model->url)
		{
			$model->url = CWord::str2url($model->name.($model->author ? '-'.$model->author : ''));
			$model->save();
		}
		return $model;
	}
	
	public function setData($id)
	{
		$model = Book::model()->findByPk($id);
		$is_change = 0;
		if (!$model->url)
		{
			$model->url = CWord::str2url($model->name.($model->author ? '-'.$model->author : ''));
			$is_change = 1;
		}
		/*if (!$model->picture_my && $model->picture)
		{
			$name = '';
			if (strpos($model->picture, '.jp'))
			{
				$name = 'image_'.$model->id.'.jpg';
				copy ( $model->picture, 'img/'.$name );
			}
			else
			{
				$name = 'image_'.$model->id.'.png';
				copy ( $model->picture, 'img/'.$name );
			}
			if ($name)
			{
				$model->picture_my = $name;
				$is_change = 1;
			}
		}*/
		if (1) // !$model->date_sync
		{
			$html = new simple_html_dom();
			$html->load_file($model->donor_url);
			//description
			$description_dom = $html->find('div.eProductDescriptionText_text', 0);
			if ($description_dom)
			{
				// ex. http://www.ozon.ru/context/detail/id/1943819/
				$description = trim(preg_replace('/<!--(.*?)-->/', '', $description_dom->innertext));
				if ($description)
					$model->description = iconv("windows-1251", "UTF-8", $description);
				//isNew & isBestseller
				$isNew = 0;
				$isBestseller = 0;
				foreach ($html->find('div.eMarketMessages_Tag') as $elem)
				{
					if (iconv("windows-1251", "UTF-8", $elem->plaintext) == 'Новинка')
						$isNew = 1;
					if (iconv("windows-1251", "UTF-8", $elem->plaintext) == 'Бестселлер')
						$isBestseller  = 1;
				}
				$model->is_new = $isNew;
				if ($isBestseller)
					$model->is_bestseller = $isBestseller;
				//mark_reviews
				$mark_reviews = (int) trim($html->find('div[itemprop=ratingValue]', 0)->plaintext);
				if ($mark_reviews > 0)
					$model->mark_reviews = $mark_reviews;
				//count_reviews
				$count_reviews = (int) trim($html->find('div[itemprop=reviewCount]', 0)->plaintext);
				if ($count_reviews > 0)
				{
					$ost = $count_reviews % 100;
					$reviews_text = '';
					if ($ost>10 && $ost<20) $reviews_text = "отзывов";
					else
					{
						$ost_des=$ost%10;
						if ($ost_des==0) $reviews_text="отзывов";
						else
						if ($ost_des==1) $reviews_text="отзыв";
						else
						if ($ost_des>=2 && $ost_des<=4) $reviews_text="отзыва";
						else
						if ($ost_des>=5 && $ost_des<=9) $reviews_text="отзывов";
						else $reviews_text="отзывов";
					}
					$model->count_reviews = $count_reviews.' '.$reviews_text;
				}
				//price
				$pricetext = $html->find('div.bSale_BasePriceCover', 0);
				if ($pricetext)
					$pricetext->find('span', 0)->outertext = '';
				$price = (float) str_replace(chr(194).chr(160), '', iconv("windows-1251", "UTF-8", trim($pricetext->innertext)));
				if ($price > 0 && ($price / $model->price) >= 0.01)
					$model->price = $price;
				$model->date_sync = time();
				$is_change = 1;
			}
			else
			{
				//description
				$description_dom = $html->find('div.mDetail_SidePadding table td', 0);
				if ($description_dom)
				{
					// ex. http://www.ozon.ru/context/detail/id/5563516/
					$description_dom->find('div.eDetail_SectionHeader', 0)->outertext = '';
					$description = trim(preg_replace('/<!--(.*?)-->/', '', $description_dom->innertext));
					if ($description)
						$model->description = iconv("windows-1251", "UTF-8", $description);
					//isNew & isBestseller
					$isNew = 0;
					$isBestseller = 0;
					foreach ($html->find('div.eMarketMessages_Tag') as $elem)
					{
						if (iconv("windows-1251", "UTF-8", $elem->plaintext) == 'Новинка')
							$isNew = 1;
						if (iconv("windows-1251", "UTF-8", $elem->plaintext) == 'Бестселлер')
							$isBestseller  = 1;
					}
					$model->is_new = $isNew;
					if ($isBestseller)
						$model->is_bestseller = $isBestseller;
					//mark_reviews
					$mark_reviews = (int) trim($html->find('div[itemprop=ratingValue]', 0)->plaintext);
					if ($mark_reviews > 0)
						$model->mark_reviews = $mark_reviews;
					//count_reviews
					$count_reviews = (int) trim($html->find('div[itemprop=reviewCount]', 0)->plaintext);
					if ($count_reviews > 0)
					{
						$ost = $count_reviews % 100;
						$reviews_text = '';
						if ($ost>10 && $ost<20) $reviews_text = "отзывов";
						else
						{
							$ost_des=$ost%10;
							if ($ost_des==0) $reviews_text="отзывов";
							else
							if ($ost_des==1) $reviews_text="отзыв";
							else
							if ($ost_des>=2 && $ost_des<=4) $reviews_text="отзыва";
							else
							if ($ost_des>=5 && $ost_des<=9) $reviews_text="отзывов";
							else $reviews_text="отзывов";
						}
						$model->count_reviews = $count_reviews.' '.$reviews_text;
					}
					//price
					$pricetext = $html->find('div.bSale_BasePriceCover span.eOzonPrice_main', 0);
					$price = (float) str_replace(chr(194).chr(160), '', iconv("windows-1251", "UTF-8", trim($pricetext->innertext)));
					if ($price > 0 && ($price / $model->price) >= 0.01)
						$model->price = $price;
					$model->date_sync = time();
					$is_change = 1;
				}
			}
			$html->clear();
			unset($html);
		}
		if ($is_change)
		{
			if ($model->price > $model->baseprice)
				$model->baseprice = $model->price;
			$model->save();
		}
		return $model;
	}
	
	public function getSearchBooks($text, $category)
	{
		$categories = categoryArr($category);
		$table = '';
		$sql = '';
		/*echo implode(', ', $categories);
		exit;*/
		if ($category == 1132527)
		{
			$sql = " and language <> 'Русский' and language is not null and language <> ''";
		}
		elseif ($category == 1179342)
		{
			$sql = " and language = 'Английский'";
		}
		elseif (count($categories))
		{
			$table = ', category_book';
			$sql = ' and book.id = category_book.book_id and category_book.category_id in ('.implode(', ', $categories).')';
		}
		$connection=Yii::app()->db;
		$command=$connection->createCommand(
		"
			select distinct book.*, concat(book.name, ' - ', book.author) as fullname
			from book ".$table."
			where concat(book.name, ' ', book.author) like '%{$text}%'
			".$sql."
			order by is_bestseller DESC, instr(count_reviews, 'отз') DESC, count_reviews DESC, mark_reviews DESC, name ASC
			limit 10
		"
		);
		
		$dataReader=$command->query(); 
		$rows = array();
		foreach($dataReader as $key=>$row) {
			$rows[$key] = (object) $row;
		}
		return $rows;
	}
	
	public function getBookList($begin, $count, $category, $sort, $condition)
	{
		$order = '';
		$sql = '';
		if ($condition == 'rus')
			$sql = " and book.language = 'Русский' ";
		if ($sort == 'promo')
			$order = "diff DESC, ";
		else
			$order = "is_bestseller DESC, instr(count_reviews, 'отз') DESC, count_reviews DESC, mark_reviews DESC, diff DESC, ";
		$categories = categoryArr($category);
		$connection=Yii::app()->db;
		$command=$connection->createCommand(
		"
			select distinct book.*, (book.baseprice - book.price)/book.baseprice as diff
			from book, category_book
			where book.id = category_book.book_id
			and category_book.category_id in (".implode(', ', $categories).")
			".$sql."
			order by ".$order." book.id ASC
			limit {$begin}, {$count}
		"
		);
		
		$dataReader=$command->query(); 
		$rows = array();
		foreach($dataReader as $key=>$row) {
			$rows[$key] = (object) $row;
		}
		return $rows;
	}
	
	public function getBookListCount($category, $sort, $condition)
	{
		$order = '';
		$sql = '';
		if ($condition == 'rus')
			$sql = " and book.language = 'Русский' ";
		if ($sort == 'promo')
			$order = 'diff DESC, ';
		$categories = categoryArr($category);
		$connection=Yii::app()->db;
		$command=$connection->createCommand(
		"
			select count(distinct book.id) as total_count
			from book, category_book
			where book.id = category_book.book_id
			and category_book.category_id in (".implode(', ', $categories).")
			".$sql."
		"
		);
		
		$dataReader=$command->query(); 
		$rows = array();
		foreach($dataReader as $key=>$row) {
			$rows[$key] = (object) $row;
		}
		return $rows[0]->total_count;
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('author',$this->author,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('description_short',$this->description_short,true);
		$criteria->compare('type_book',$this->type_book,true);
		$criteria->compare('type_book_id',$this->type_book_id);
		$criteria->compare('price',$this->price);
		$criteria->compare('baseprice',$this->baseprice);
		$criteria->compare('picture',$this->picture,true);
		$criteria->compare('picture_my',$this->picture_my,true);
		$criteria->compare('language',$this->language,true);
		$criteria->compare('language_id',$this->language_id);
		$criteria->compare('publisher',$this->publisher,true);
		$criteria->compare('publisher_id',$this->publisher_id);
		$criteria->compare('page_extent',$this->page_extent,true);
		$criteria->compare('ISBN',$this->ISBN,true);
		$criteria->compare('year',$this->year);
		$criteria->compare('is_new',$this->is_new);
		$criteria->compare('is_bestseller',$this->is_bestseller);
		$criteria->compare('like_count',$this->like_count);
		$criteria->compare('not_like_count',$this->not_like_count);
		$criteria->compare('mark_reviews',$this->mark_reviews);
		$criteria->compare('count_reviews',$this->count_reviews);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('date_sync',$this->date_sync);
		$criteria->compare('donor_url',$this->donor_url,true);
		$criteria->compare('donor_id',$this->donor_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Book the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
