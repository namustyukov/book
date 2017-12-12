<?php
/* @var $this ShopOnlineController */
/* @var $model ShopOnline */

$this->breadcrumbs=array(
	'Shop Onlines'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ShopOnline', 'url'=>array('index')),
	array('label'=>'Manage ShopOnline', 'url'=>array('admin')),
);
?>

<h1>Create ShopOnline</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>