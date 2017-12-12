<?php

/**
 * This is the model class for table "biblioteki".
 *
 * The followings are the available columns in table 'biblioteki':
 * @property integer $id
 * @property string $name
 * @property string $full_name
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property string $site
 * @property string $worktime
 * @property integer $rating
 * @property string $online
 * @property string $date_found
 * @property string $certificate
 * @property string $guarantee
 * @property string $payment
 * @property string $price
 * @property string $promo
 * @property string $production_way
 * @property string $about
 * @property string $logo
 * @property integer $city_id
 * @property integer $category_id
 * @property string $donor_site
 * @property string $url
 * @property string $koord_x
 * @property string $koord_y
 * @property string $date_modify
 */
class Library extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'biblioteki';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('rating, city_id, category_id', 'numerical', 'integerOnly'=>true),
			array('name, email, site, worktime, date_found, url', 'length', 'max'=>100),
			array('full_name, address, phone, online, certificate, guarantee, payment, promo, production_way, logo, donor_site', 'length', 'max'=>300),
			array('price', 'length', 'max'=>500),
			array('koord_x, koord_y', 'length', 'max'=>50),
			array('about', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, full_name, address, phone, email, site, worktime, rating, online, date_found, certificate, guarantee, payment, price, promo, production_way, about, logo, city_id, category_id, donor_site, url, koord_x, koord_y, date_modify', 'safe', 'on'=>'search'),
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
			'full_name' => 'Full Name',
			'address' => 'Address',
			'phone' => 'Phone',
			'email' => 'Email',
			'site' => 'Site',
			'worktime' => 'Worktime',
			'rating' => 'Rating',
			'online' => 'Online',
			'date_found' => 'Date Found',
			'certificate' => 'Certificate',
			'guarantee' => 'Guarantee',
			'payment' => 'Payment',
			'price' => 'Price',
			'promo' => 'Promo',
			'production_way' => 'Production Way',
			'about' => 'About',
			'logo' => 'Logo',
			'city_id' => 'City',
			'category_id' => 'Category',
			'donor_site' => 'Donor Site',
			'url' => 'Url',
			'koord_x' => 'Koord X',
			'koord_y' => 'Koord Y',
			'date_modify' => 'Date Modify',
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
		$criteria->compare('full_name',$this->full_name,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('site',$this->site,true);
		$criteria->compare('worktime',$this->worktime,true);
		$criteria->compare('rating',$this->rating);
		$criteria->compare('online',$this->online,true);
		$criteria->compare('date_found',$this->date_found,true);
		$criteria->compare('certificate',$this->certificate,true);
		$criteria->compare('guarantee',$this->guarantee,true);
		$criteria->compare('payment',$this->payment,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('promo',$this->promo,true);
		$criteria->compare('production_way',$this->production_way,true);
		$criteria->compare('about',$this->about,true);
		$criteria->compare('logo',$this->logo,true);
		$criteria->compare('city_id',$this->city_id);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('donor_site',$this->donor_site,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('koord_x',$this->koord_x,true);
		$criteria->compare('koord_y',$this->koord_y,true);
		$criteria->compare('date_modify',$this->date_modify,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function afterSave() {
		$city_id = $this->city_id;

		$connection = Yii::app()->db;
		$command = $connection->createCommand(
			"SELECT id,
			(
				IF(LENGTH(name) > 0, 1, 0) +
				IF(LENGTH(address) > 0, 1, 0) +
				IF(LENGTH(phone) > 0, 1, 0) +
				IF(LENGTH(worktime) > 0, 2, 0) +
				IF(LENGTH(site) > 0, 2, 0)
			) as info
			FROM biblioteki
			WHERE biblioteki.city_id = {$city_id}
			order by 2 DESC, 1 ASC
			"
		);
		$dataReader = $command->query(); 
		$rows = array();
		foreach($dataReader as $key => $row) {
			$rows[$key] = (object) $row;
			$command_upd = $connection->createCommand("update biblioteki set rating = ".($key + 1)." where id = {$rows[$key]->id}");
			$command_upd->query();
		}

		return parent::afterSave();
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Biblioteki the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
