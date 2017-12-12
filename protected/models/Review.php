<?php

/**
 * This is the model class for table "review".
 *
 * The followings are the available columns in table 'review':
 * @property integer $id
 * @property string $fio
 * @property string $text
 * @property integer $mark
 * @property integer $book_id
 * @property integer $date_create
 */
class Review extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'review';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mark, book_id, date_create', 'numerical', 'integerOnly'=>true),
			array('fio', 'length', 'max'=>500),
			array('text', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fio, text, mark, book_id, date_create', 'safe', 'on'=>'search'),
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
			'fio' => 'Fio',
			'text' => 'Text',
			'mark' => 'Mark',
			'book_id' => 'Book',
			'date_create' => 'Date Create',
		);
	}

	public function getList($begin, $count, $book_id)
	{
		$connection=Yii::app()->db;
		$command=$connection->createCommand(
		"
			select distinct review.*
			from review
			where book_id = {$book_id}
			order by date_create DESC
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
		$criteria->compare('fio',$this->fio,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('mark',$this->mark);
		$criteria->compare('book_id',$this->book_id);
		$criteria->compare('date_create',$this->date_create);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Review the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
