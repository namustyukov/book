<?php
/* @var $this ShopOnlineController */
/* @var $model ShopOnline */

$this->breadcrumbs=array(
	'Shop Onlines'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ShopOnline', 'url'=>array('index')),
	array('label'=>'Create ShopOnline', 'url'=>array('create')),
	array('label'=>'View ShopOnline', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ShopOnline', 'url'=>array('admin')),
);
?>

<h1>Update ShopOnline <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>