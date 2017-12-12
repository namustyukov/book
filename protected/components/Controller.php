<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to 'column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='main';
	public $meta_d = false;
	public $meta_k = false;
	public $pageTitle = false;
	public $menu=array();
	public $breadcrumbs=array();
	public $city;
	
	function __construct($id){
		parent::__construct($id);

		$city = isset($_GET['gorod']) ? $_GET['gorod'] : '';

		if ($city)
		{
			$this->city = City::model()->find('simbol_name=:simbol_name', array(':simbol_name' => $city));

			if ($this->city) {
				Yii::app()->session['city'] = $this->city->id;
				Yii::app()->request->cookies['city'] = new CHttpCookie('city', $this->city->id);
			} else {
				throw new ExceptionClass('404 Not found');
			}
		}
		else
		{
			$this->city = false;
			if (isset(Yii::app()->session['city']))
				$this->city = City::model()->findbyPk(Yii::app()->session['city']);
			elseif (Yii::app()->request->cookies['city']->value)
				$this->city = City::model()->findbyPk(Yii::app()->request->cookies['city']->value);
			if (!$this->city)
			{
				$criteria = new CDbCriteria();
				$criteria->condition='id=:id';
				$criteria->params=array(':id' => 425);
				$city_first = City::model()->find($criteria);
				$this->city = $city_first;
			}
		}
	}
}