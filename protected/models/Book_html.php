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
 
class Book_html extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'book_html';
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
			array('description, description_short', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, author, description, description_short, type_book, type_book_id, binding, price, baseprice, picture, picture_my, language, language_id, publisher, publisher_id, page_extent, ISBN, year, is_new, is_bestseller, like_count, not_like_count, mark_reviews, count_reviews, url, date_sync, donor_url, donor_id', 'safe', 'on'=>'search'),
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
