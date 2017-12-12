<?php
/* @var $this CategoryBookController */
/* @var $model CategoryBook */

$this->breadcrumbs=array(
	'Category Books'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CategoryBook', 'url'=>array('index')),
	array('label'=>'Create CategoryBook', 'url'=>array('create')),
	array('label'=>'Update CategoryBook', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CategoryBook', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CategoryBook', 'url'=>array('admin')),
);
?>

<h1>View CategoryBook #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'category_id',
		'book_id',
	),
)); ?>
