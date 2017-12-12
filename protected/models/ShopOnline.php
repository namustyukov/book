<?php

/**
 * This is the model class for table "shop_online".
 *
 * The followings are the available columns in table 'shop_online':
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property string $goods_type
 * @property string $buy_condition
 * @property string $delivery
 * @property string $payment
 * @property string $address
 * @property string $worktime
 * @property string $phone
 * @property string $site
 * @property string $delivery_out
 * @property string $delivery_from
 * @property integer $rating
 * @property string $logo
 */
class ShopOnline extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'shop_online';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rating', 'numerical', 'integerOnly'=>true),
			array('name, url, payment, worktime, phone, site', 'length', 'max'=>200),
			array('goods_type, buy_condition, delivery, delivery_out', 'length', 'max'=>500),
			array('delivery_from, logo', 'length', 'max'=>100),
			array('address, description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, url, goods_type, buy_condition, delivery, payment, address, description, worktime, phone, site, delivery_out, delivery_from, rating, logo', 'safe', 'on'=>'search'),
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
			'url' => 'Url',
			'goods_type' => 'Goods Type',
			'buy_condition' => 'Buy Condition',
			'delivery' => 'Delivery',
			'payment' => 'Payment',
			'address' => 'Address',
			'worktime' => 'Worktime',
			'phone' => 'Phone',
			'site' => 'Site',
			'delivery_out' => 'Delivery Out',
			'delivery_from' => 'Delivery From',
			'rating' => 'Rating',
			'description' => 'Description',
			'logo' => 'Logo',
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
		$criteria->compare('url',$this->url,true);
		$criteria->compare('goods_type',$this->goods_type,true);
		$criteria->compare('buy_condition',$this->buy_condition,true);
		$criteria->compare('delivery',$this->delivery,true);
		$criteria->compare('payment',$this->payment,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('worktime',$this->worktime,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('site',$this->site,true);
		$criteria->compare('delivery_out',$this->delivery_out,true);
		$criteria->compare('delivery_from',$this->delivery_from,true);
		$criteria->compare('rating',$this->rating);
		$criteria->compare('logo',$this->logo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function beforeSave() {
		if (!$this->url) $this->url = CWord::str2url($this->name);

		if (strlen($this->logo) < 1) {
			// загружаем изображение
			$this->logo = CUploadedFileEx::getInstance($this,'logo');

			// если загрузили
			if ($this->logo<>NULL) {
				// задаём имя новому файлу
				$this->logo->setName($this->url.'_'.rand(1, 10000));

				// сохраняем файл
				$this->logo->saveAs('img/' . $this->logo->getName());
			}else{
				unset($this->logo);
			}
		}
		return parent::beforeSave();
	}

	public function afterSave() {
		$connection = Yii::app()->db;
		$command = $connection->createCommand(
			"SELECT id,
			(
				IF(LENGTH(name) > 0, 1, 0) +
				IF(LENGTH(url) > 0, 1, 0) +
				IF(LENGTH(goods_type) > 0, 1, 0) +
				IF(LENGTH(buy_condition) > 0, 1, 0) +
				IF(LENGTH(delivery) > 0, 1, 0) +
				IF(LENGTH(payment) > 0, 1, 0) +
				IF(LENGTH(address) > 0, 1, 0) +
				IF(LENGTH(worktime) > 0, 1, 0) +
				IF(LENGTH(phone) > 0, 1, 0) +
				IF(LENGTH(site) > 0, 1, 0) +
				IF(LENGTH(delivery_out) > 0, 1, 0) +
				IF(LENGTH(delivery_from) > 0, 1, 0) +
				IF(LENGTH(description) > 0, 1, 0) +
				IF(LENGTH(logo) > 0, 1, 0) +
				LENGTH(payment) / 30 +
				LENGTH(goods_type) / 30 +
				LENGTH(address) / 150
			) as info,
			LENGTH(description)
			FROM shop_online
			order by 2 DESC, 3 DESC
			"
		);
		$dataReader = $command->query(); 
		$rows = array();
		foreach($dataReader as $key => $row) {
			$rows[$key] = (object) $row;
			$command_upd = $connection->createCommand("update shop_online set rating = ".($key + 1)." where id = {$rows[$key]->id}");
			$command_upd->query();
		}

		return parent::afterSave();
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ShopOnline the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
