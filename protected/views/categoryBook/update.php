<?php
/* @var $this CategoryBookController */
/* @var $model CategoryBook */

$this->breadcrumbs=array(
	'Category Books'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CategoryBook', 'url'=>array('index')),
	array('label'=>'Create CategoryBook', 'url'=>array('create')),
	array('label'=>'View CategoryBook', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CategoryBook', 'url'=>array('admin')),
);
?>

<h1>Update CategoryBook <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>